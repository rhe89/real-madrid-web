<?php
/**
 * Created by IntelliJ IDEA.
 * User: Roar
 * Date: 22.07.15
 * Time: 21.50
 */

class PlayerStatsLoader {

    private $matches, $firstTeam, $castilla, $season;

    public function __construct($season, $matches, $firstTeam, $castilla)
    {
        $this->matches = $matches;
        $this->season = $season;
        $this->firstTeam = $firstTeam;
        $this->castilla = $castilla;

        self::loadGoals();
        self::loadCards();
        self::loadSubstitutions();
        self::loadMatchStats();
        self::loadMatchesWithGoals();
        self::loadMatchesWithAssists();
        self::loadMatchesWithThirdAssists();
        self::loadMatchesWhereSubbedOnAndScored();
    }

    public function loadGoals()
    {
        $goals = getArray("
          SELECT matches.tournamentName, matches.opposition, goals.date, minute, type, goals.location as goalLocation, touches, goalscorer, assist, thirdAssist, bodypart from goals
          INNER JOIN matches ON goals.date = matches.date
          WHERE matches.seasonID = '$this->season';");

        if ($goals == null || count($goals) <= 0) return;

        foreach ($goals as &$goal) {
            $this->matches[$goal["date"]]->setEvents($goal);
            $goalscorer = self::getPlayer($goal["goalscorer"]);
            if ($goalscorer != null) $goalscorer->addGoal($goal["tournamentName"], $goal);

            $assistString = $goal["assist"];
            if ($assistString != "None") {
                $assist = self::getPlayer($goal["assist"]);
                if ($assist != null) $assist->addAssist($goal["tournamentName"], $goal);
            }
            $thirdAssistString = $goal["thirdAssist"];
            if ($thirdAssistString != "None") {
                $thirdAssist = self::getPlayer($goal["thirdAssist"]);
                if ($thirdAssist != null) $thirdAssist->addThirdAssist($goal["tournamentName"], $goal);
            }
        }
    }

    public function loadCards()
    {
        $cards = getArray("
          SELECT * from cards
          INNER JOIN matches ON cards.date = matches.date
          WHERE matches.seasonID = '$this->season';");

        if ($cards == null || count($cards) <= 0) return;

        foreach ($cards as &$card) {
            $this->matches[$card["date"]]->setEvents($card);
            $player = self::getPlayer($card["player"]);

            if ($player != null) {
                if ($card["type"] == "Yellow") $player->addYellowCard($card["tournamentName"], $card);
                if ($card["type"] == "Red") $player->addRedCard($card["tournamentName"], $card);
            }
        }
    }

    public function loadSubstitutions()
    {
        $substitutions = getArray("
          SELECT * FROM substitutions
          INNER JOIN matches ON substitutions.date = matches.date
          WHERE substitutions.seasonID = '$this->season';");

        if ($substitutions == null || count($substitutions) <= 0) return;

        foreach ($substitutions as &$substitution) {
            $this->matches[$substitution["date"]]->setEvents($substitution);

            $subbedOn = self::getPlayer($substitution["playerOn"]);

            if ($subbedOn != null) $subbedOn->addSubstitutedOn($substitution["tournamentName"], $substitution);

            $subbedOff = self::getPlayer($substitution["playerOff"]);

            if ($subbedOff != null) $subbedOff->addSubstitutedOff($substitution["tournamentName"], $substitution);
        }
    }

    public function loadMatchStats()
    {
        $matchStats = getArray("
          SELECT * FROM playermatchstats
          WHERE playermatchstats.seasonID = '$this->season';");

        if ($matchStats == null || count($matchStats) <= 0) return;

        foreach ($matchStats as &$match) {
            $player = self::getPlayer($match["name"]);

            if ($player != null) {
                $player->addMatch($match["tournamentName"], $match);
                $player->addMinutesPlayed($match["tournamentName"], intval($match["minutesPlayed"]));
            }
        }
    }

    private function loadMatchesWithGoals()
    {
        $matchesWithGoal = getArray("
        SELECT tournamentName, goalscorer, count(DISTINCT goals.date) as stat
        FROM goals
          INNER JOIN player_match ON player_match.date = goals.date
          WHERE goals.seasonID = '$this->season'
        GROUP BY goalscorer, tournamentName;");

        if ($matchesWithGoal == null || count($matchesWithGoal) <= 0) return;

        foreach ($matchesWithGoal as $matchWithGoal) {
            $player = self::getPlayer($matchWithGoal["goalscorer"]);

            if ($player != null) $player->addMatchesWithGoal($matchWithGoal["tournamentName"], $matchWithGoal["stat"]);
        }
    }

    private function loadMatchesWithAssists()
    {
        $matchesWithAssist = getArray("
        SELECT tournamentName, assist, count(DISTINCT goals.date) as stat
        FROM goals
          INNER JOIN player_match ON player_match.date = goals.date
          WHERE goals.seasonID = '$this->season'
        GROUP BY assist, tournamentName;");

        if ($matchesWithAssist == null || count($matchesWithAssist) <= 0) return;

        foreach ($matchesWithAssist as $matchWithAssist) {
            $player = self::getPlayer($matchWithAssist["assist"]);

            if ($player != null) $player->addMatchesWithAssist($matchWithAssist["tournamentName"], $matchWithAssist["stat"]);
        }
    }

    private function loadMatchesWithThirdAssists()
    {
        $matchesWithThirdAssist = getArray("
        SELECT tournamentName, thirdAssist, count(DISTINCT goals.date) as stat
        FROM goals
          INNER JOIN player_match ON player_match.date = goals.date
          WHERE goals.seasonID = '$this->season'
        GROUP BY thirdAssist, tournamentName;");

        if ($matchesWithThirdAssist == null || count($matchesWithThirdAssist) <= 0) return;

        foreach ($matchesWithThirdAssist as $matchWithThirdAssist) {
            $player = self::getPlayer($matchWithThirdAssist["thirdAssist"]);

            if ($player != null) $player->addMatchesWithThirdAssist($matchWithThirdAssist["tournamentName"], $matchWithThirdAssist["stat"]);
        }
    }

    private function loadMatchesWhereSubbedOnAndScored()
    {
        $subbedOnAndScored = getArray("
        SELECT goals.goalscorer, tournamentName, count(DISTINCT substitutions.date) as stat
        FROM goals, substitutions
          INNER JOIN player_match on player_match.date = substitutions.date
        WHERE substitutions.playerOn = goals.goalscorer
              AND substitutions.date = goals.date
              AND goals.seasonID = '$this->season'
        GROUP BY goalscorer, tournamentName;");

        if ($subbedOnAndScored == null || count($subbedOnAndScored) <= 0) return;

        foreach ($subbedOnAndScored as $match) {
            $player = self::getPlayer($match["goalscorer"]);

            if ($player != null) $player->addSubstitutedOnAndScored($match["tournamentName"]);
        }
    }

    public function getPlayer($playerName) {
        if ($this->firstTeam->containsPlayer($playerName)) return $this->firstTeam->getPlayer($playerName);
        else if ($this->castilla->containsPlayer($playerName)) return $this->castilla->getPlayer($playerName);
        else return null;
    }

}