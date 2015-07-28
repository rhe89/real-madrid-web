<?php
/**
 * Created by IntelliJ IDEA.
 * User: Roar
 * Date: 22.07.15
 * Time: 22.05
 */

class LeaderboardContainer {
    private $leaderboards, $season, $tournaments;

    public function __construct($season, $tournaments)
    {
        $this->season = $season;
        $this->tournaments = $tournaments;

        $this->leaderboards["Yellow"] = self::loadLeaderboardCards("Yellow");
        $this->leaderboards["Red"] = self::loadLeaderboardCards("Red");
        $this->leaderboards["goalscorer"] = self::loadLeaderboardGoals("goalscorer");
        $this->leaderboards["assist"] = self::loadLeaderboardGoals("assist");
        $this->leaderboards["thirdAssist"] = self::loadLeaderboardGoals("thirdAssist");
        $this->leaderboards["playerOn"] = self::loadLeaderboardSubstitutions("playerOn");
        $this->leaderboards["playerOff"] = self::loadLeaderboardSubstitutions("playerOff");
        $this->leaderboards["matches"] = self::loadLeaderboardMatches("matches");
        $this->leaderboards["minutes"] = self::loadLeaderboardMinutes("minutes");
    }

    public function getLeaderboard($tournamentName, $stat, $getTotal) {
        if ($getTotal) {
            return $this->leaderboards[$stat];
        } else {
            return $this->tournaments[$tournamentName]->getLeaderboard($stat);
        }
    }

    public function loadLeaderboardCards($cardType)
    {
        $sql = getArray("
        SELECT matches.tournamentName, player, COUNT(player) as count
        FROM cards
          INNER JOIN matches ON cards.date = matches.date
          WHERE type = '$cardType' AND cards.seasonID = '$this->season'
        GROUP BY player, tournamentName
        ORDER BY count DESC;");

        self::makeLeaderboardList($sql, $cardType);

        $sql = getArray("
        SELECT player, COUNT(player) as count
        FROM cards
          INNER JOIN matches ON cards.date = matches.date
          WHERE type = '$cardType' AND cards.seasonID = '$this->season'
        GROUP BY player
        ORDER BY count DESC;");

        return self::makeLeaderboardListTotal($sql, $cardType);

    }

    public function loadLeaderboardGoals($stat)
    {
        $sql = getArray("
        SELECT matches.tournamentName, $stat as player, COUNT( '$stat') as count
        FROM goals
          INNER JOIN matches ON goals.date = matches.date
        WHERE '$stat' != 'None' AND goals.seasonID = '$this->season'
        GROUP BY $stat, tournamentName
        ORDER BY count DESC;");

        self::makeLeaderboardList($sql, $stat);

        $sql = getArray("
        SELECT $stat as player, COUNT( '$stat') as count
        FROM goals
          INNER JOIN matches ON goals.date = matches.date AND goals.seasonID = '$this->season'
        WHERE '$stat' != 'None'
        GROUP BY $stat
        ORDER BY count DESC;");

        return self::makeLeaderboardListTotal($sql);
    }

    public function loadLeaderboardSubstitutions($stat) {
        $sql = getArray("
        SELECT matches.tournamentName, $stat as player, COUNT( '$stat') as count
        FROM substitutions
          INNER JOIN matches ON substitutions.date = matches.date
        WHERE substitutions.seasonID = '$this->season'
        GROUP BY $stat, tournamentName
        ORDER BY count DESC;");

        self::makeLeaderboardList($sql, $stat);

        $sql = getArray("
        SELECT $stat as player, COUNT( '$stat') as count
        FROM substitutions
          INNER JOIN matches ON substitutions.date = matches.date
        WHERE substitutions.seasonID = '$this->season'
        GROUP BY $stat
        ORDER BY count DESC;");

        return self::makeLeaderboardListTotal($sql);
    }

    public function loadLeaderboardMatches($stat) {
        $sql = getArray("
        SELECT matches.tournamentName, name as player, count(name) as count
        FROM player_match
          INNER JOIN matches ON player_match.date = matches.date
        WHERE player_match.seasonID = '$this->season'
        GROUP BY name, tournamentName
        ORDER BY count DESC;");

        self::makeLeaderboardList($sql, $stat);

        $sql = getArray("
        SELECT name as player, count(name) as count
        FROM player_match
          INNER JOIN matches ON player_match.date = matches.date
        WHERE player_match.seasonID = '$this->season'
        GROUP BY name
        ORDER BY count DESC;");

        return self::makeLeaderboardListTotal($sql);

    }

    public function loadLeaderboardMinutes($stat)
    {
        $sql = getArray("
        SELECT matches.tournamentName, name as player, sum(minutesPlayed) as count
        FROM player_match
          INNER JOIN matches ON player_match.date = matches.date
        WHERE player_match.seasonID = '$this->season'
        GROUP BY name, tournamentName
        ORDER BY count DESC;");

        self::makeLeaderboardList($sql, $stat);

        $sql = getArray("
        SELECT name as player, sum(minutesPlayed) as count
        FROM player_match
          INNER JOIN matches ON player_match.date = matches.date
        WHERE player_match.seasonID = '$this->season'
        GROUP BY name
        ORDER BY count DESC;");

        return self::makeLeaderboardListTotal($sql);
    }

    private function makeLeaderboardListTotal($list) {
        $leaderboard = array();
        $counter = 0;
        foreach ($list as &$element) {
            $leaderboard[$counter]["pos"] = $counter+1;
            $leaderboard[$counter]["name"] = $element["player"];
            $leaderboard[$counter++]["number"] = $element["count"];
        }
        return $leaderboard;
    }

    private function makeLeaderboardList($list, $stat) {
        foreach ($this->tournaments as &$tournament) {
            $leaderboard = array();
            $counter = 0;
            foreach ($list as &$element) {
                if ($element["tournamentName"] == $tournament->getTournamentName()) {
                    $leaderboard[$counter]["pos"] = $counter+1;
                    $leaderboard[$counter]["name"] = $element["player"];
                    $leaderboard[$counter++]["number"] = $element["count"];
                }
            }
            $tournament->addLeaderboard($stat, $leaderboard);
        }
    }


}