<?php

class RealMadrid
{
    private $tournamentContainer, $nationContainer, $leaderboardContainer,
            $oppositionContainer, $matchContainer, $positionContainer, $playerStats;
    private $firstTeam, $castilla;
    private $season;

    public function __construct($season, $whatToLoad)
    {
        $this->season = $season;

        $this->tournamentContainer = new TournamentContainer($season);
        self::loadPlayers();

        self::loadData($whatToLoad);

    }

    public function loadData($whatToLoad) {

        if (strpos($whatToLoad,'matches') !== false) {
            if ($this->matchContainer == null) {
                $this->matchContainer = new MatchContainer($this->season, $this->tournamentContainer->getTournaments());
            }
        }

        if (strpos($whatToLoad,'oppositions') !== false) {
            if ($this->oppositionContainer == null) {
                $this->oppositionContainer = new OppositionContainer($this->season, $this->tournamentContainer->getTournaments());
            }
        }

        if (strpos($whatToLoad,'leaderboards') !== false) {
            if ($this->leaderboardContainer == null) {
                $this->leaderboardContainer = new LeaderboardContainer($this->season, $this->tournamentContainer->getTournaments());
            }
        }


        if (strpos($whatToLoad,'player-statistics') !== false) {
            if ($this->playerStats == null) {
                $matches = $this->matchContainer->getMatchList("", true);
                $this->playerStats = new PlayerStatsLoader($this->season, $matches, $this->firstTeam, $this->castilla);
            }
        }
    }

    public function getSeason() {
        return $this->season;
    }

    public function loadPlayers()
    {
        $this->firstTeam = new FirstTeam($this->season, "firstteam");
        $this->firstTeam->loadPlayers();
        $this->castilla = new Castilla($this->season, "castilla");
        $this->castilla->loadPlayers();
    }

    public function getSquad($squadID) {
        if ($squadID == 'firstteam') return self::getFirstTeam();
        else if ($squadID == 'castilla') return self::getCastilla();
        else return null;
    }

    public function getFirstTeam() {
        return $this->firstTeam;
    }

    public function getCastilla() {
        return $this->castilla;
    }

    public function getTournaments() {
        return $this->tournamentContainer->getTournaments();
    }

    public function getPlayer($playerName) {
        if ($this->firstTeam->containsPlayer($playerName)) return $this->firstTeam->getPlayer($playerName);
        else if ($this->castilla->containsPlayer($playerName)) return $this->castilla->getPlayer($playerName);
        else return null;
    }

    public function getMatchList($tournamentName, $getTotal) {
        return $this->matchContainer->getMatchList($tournamentName, $getTotal);
    }

    public function getMatch($date) {
        return $this->matchContainer->getMatch($date);
    }

    public function getOppositionsList($tournamentName, $getTotal)
    {
        return $this->oppositionContainer->getOppositionsList($tournamentName, $getTotal);
    }

    public function getNext5Matches($tournamentName, $getTotal)
    {
        return $this->oppositionContainer->getNext5Matches($tournamentName, $getTotal);
    }

    public function getLast5Matches($tournamentName, $getTotal) {
        return $this->matchContainer->getLast5Matches($tournamentName, $getTotal);
    }

    public function getNations() {
        return $this->nationContainer->getNations();
    }

    public function getPositions() {
        return $this->positionContainer->getPositions();
    }

    public function getNationalityStats($tournamentName, $nationality, $getTotal) {
        return $this->nationContainer->getNationalityStats($tournamentName, $nationality, $getTotal);
    }

    public function getPositionStats($tournamentName, $position, $getTotal) {
        return $this->positionContainer->getPositionStats($tournamentName, $position, $getTotal);
    }

    public function getLeaderboard($tournamentName, $stat, $getTotal)
    {
        return $this->leaderboardContainer->getLeaderboard($tournamentName, $stat, $getTotal);
    }

    public function getMiscStat($tournamentName, $stat, $getTotal)
    {
        return $this->matchContainer->getMiscStat($tournamentName, $stat, $getTotal);
    }

    public function getGoals($tournamentName, $getTotal)
    {
        return $this->tournamentContainer->getGoals($tournamentName, $getTotal);
    }

    public function getGoalsAgainst($tournamentName, $getTotal)
    {
        return $this->tournamentContainer->getGoalsAgainst($tournamentName, $getTotal);
    }

    public function getMatchCount($tournamentName, $getTotal)
    {
        return $this->tournamentContainer->getMatchCount($tournamentName, $getTotal);
    }

    public function getWins($tournamentName, $getTotal)
    {
        return $this->tournamentContainer->getWins($tournamentName, $getTotal);
    }

    public function getDraws($tournamentName, $getTotal)
    {
        return $this->tournamentContainer->getDraws($tournamentName, $getTotal);
    }

    public function getLosses($tournamentName, $getTotal)
    {
        return $this->tournamentContainer->getLosses($tournamentName, $getTotal);
    }
}





