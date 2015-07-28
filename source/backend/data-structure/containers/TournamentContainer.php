<?php
/**
 * Created by IntelliJ IDEA.
 * User: Roar
 * Date: 22.07.15
 * Time: 23.00
 */

class TournamentContainer {
    private $tournaments, $season;

    //TODO Implement season-feature on tournaments
    public function __construct($season)
    {
        self::loadTournaments();
    }

    private function loadTournaments()
    {
        $tournaments = getArray("
        SELECT *
        FROM tournaments;");

        if (count($tournaments) > 0) {
            foreach ($tournaments as &$tournament) {
                $tournamentName = $tournament["name"];
                $this->tournaments[$tournamentName] = new Tournament($tournamentName);
            }
        }
    }

    public function getTournaments()
    {
        return $this->tournaments;
    }

    public function getGoals($tournamentName, $getTotal) {
        if ($getTotal) {
            $toRet = 0;
            foreach ($this->tournaments as &$tournament) {
                $toRet += $tournament->getGoals();
            }
            return $toRet;
        } else return $this->tournaments[$tournamentName]->getGoals();
    }

    public function getGoalsAgainst($tournamentName, $getTotal) {
        if ($getTotal) {
            $toRet = 0;
            foreach ($this->tournaments as &$tournament) {
                $toRet += $tournament->getGoalsAgainst();
            }
            return $toRet;
        } else return $this->tournaments[$tournamentName]->getGoalsAgainst();
    }

    public function getMatchCount($tournamentName, $getTotal) {
        if ($getTotal) {
            $toRet = 0;
            foreach ($this->tournaments as &$tournament) {
                $toRet += sizeof($tournament->getAllMatches());
            }
            return $toRet;
        } else return sizeof($this->tournaments[$tournamentName]->getAllMatches());
    }

    public function getWins($tournamentName, $getTotal) {
        if ($getTotal) {
            $toRet = 0;
            foreach ($this->tournaments as &$tournament) {
                $toRet += $tournament->getWins();
            }
            return $toRet;
        } else return $this->tournaments[$tournamentName]->getWins();
    }

    public function getDraws($tournamentName, $getTotal) {
        if ($getTotal) {
            $toRet = 0;
            foreach ($this->tournaments as &$tournament) {
                $toRet += $tournament->getDraws();
            }
            return $toRet;
        } else return $this->tournaments[$tournamentName]->getDraws();
    }

    public function getLosses($tournamentName, $getTotal) {
        if ($getTotal) {
            $toRet = 0;
            foreach ($this->tournaments as &$tournament) {
                $toRet += $tournament->getLosses();
            }
            return $toRet;
        } else return $this->tournaments[$tournamentName]->getLosses();
    }


}