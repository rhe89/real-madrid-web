<?php


class Player {
    public $name ,$fullName ,$birthdate ,$nationality ,$position ,$kitNumber , $loanedOut,
        $prefFoot ,$contractExp ,$transferFee ,$transferClub ,$imgURL, $loanExpirationDate,
        $loanClub, $age, $ageWhenContrExpired, $squad;
    public $tournamentStatistics;
    public $events;
    public $tournaments;

    public function __construct($name, $fullName, $birthdate, $nationality, $position, $kitNumber, $prefFoot, $contractExp,
                                $transferFee, $transferClub, $imgURL, $loanedOut, $squad) {
        $this->name = $name;
        $this->fullName = $fullName;
        $this->kitNumber = $kitNumber;
        $this->birthdate = date('d/m/y', strtotime($birthdate));
        $this->nationality = $nationality;
        $this->position = $position;
        $this->prefFoot = $prefFoot;
        $this->contractExp = date('d/m/y', strtotime($contractExp));
        $this->transferFee = $transferFee;
        $this->transferClub = $transferClub;
        $this->squad = $squad;

        $this->imgURL = "/realmadrid".str_replace(' ', '', $imgURL);;
        $this->loanedOut = $loanedOut;

        $this->age = $this->getYearsFromDate($birthdate);
        $this->ageWhenContrExpired = -($this->getYearsFromDate($contractExp) - $this->age);
        self::loadTournamentStatistics();
    }

    function getYearsFromDate ($birth_date) {
        list($y,$m,$d) = explode('-',$birth_date);
        $y_diff  = date("Y") - $y;
        $m_diff = date("m") - $m;
        $d_diff   = date("d") - $d;
        if ($m_diff < 0 || $d_diff < 0) { $y_diff--; }
        return $y_diff;
    }

    function loadTournamentStatistics(){
        $tournaments = getArray("SELECT name FROM tournaments;");

        foreach ($tournaments as &$tournament) {
            $this->tournamentStatistics[$tournament["name"]] = new TournamentStatistics($tournament["name"], $this->name, $this->kitNumber);
        }

        $this->events = [
            "matches" => array(),
            "goalscorer" => array(),
            "assist" => array(),
            "thirdAssist" => array(),
            "Red" => array(),
            "Yellow" => array(),
            "playerOn" => array(),
            "playerOff" => array()
        ];
    }

    public function getStat($statName, $tournamentName, $getTotal) {
        if ($getTotal) {
            $sum = 0;
            foreach ($this->tournamentStatistics as &$playerStat) {
                $sum+= $playerStat->getStat($statName);
            }
            return $sum;
        }
        return $this->tournamentStatistics[$tournamentName]->getStat($statName);
    }

    public function addMatch($tournamentName, $match) {
        array_push($this->events["matches"], $match);
        $this->tournamentStatistics[$tournamentName]->addMatch($match);
    }

    public function addMinutesPlayed($tournamentName, $minutesPlayed) {
        $this->tournamentStatistics[$tournamentName]->addMinutesPlayed($minutesPlayed);
    }

    public function addGoal($tournamentName, $goal) {
        array_push($this->events["goalscorer"], $goal);
        $this->tournamentStatistics[$tournamentName]->addGoal($goal);
    }

    public function addAssist($tournamentName, $assist) {
        array_push($this->events["assist"], $assist);
        $this->tournamentStatistics[$tournamentName]->addAssist($assist);
    }

    public function addThirdAssist($tournamentName, $thirdAssist) {
        array_push($this->events["thirdAssist"], $thirdAssist);
        $this->tournamentStatistics[$tournamentName]->addThirdAssist($thirdAssist);
    }

    public function addYellowCard($tournamentName, $yellowCard) {
        array_push($this->events["Yellow"], $yellowCard);
        $this->tournamentStatistics[$tournamentName]->addYellowCard($yellowCard);
    }

    public function addRedCard($tournamentName, $redCard) {
        array_push($this->events["Red"], $redCard);
        $this->tournamentStatistics[$tournamentName]->addRedCard($redCard);
    }

    public function addSubstitutedOn($tournamentName, $substitutedOn) {
        array_push($this->events["playerOn"], $substitutedOn);
        $this->tournamentStatistics[$tournamentName]->addSubstitutedOn($substitutedOn);
    }

    public function addSubstitutedOff($tournamentName, $substitutedOff) {
        array_push($this->events["playerOff"], $substitutedOff);
        $this->tournamentStatistics[$tournamentName]->addSubstitutedOff($substitutedOff);
    }

    public function addMatchesWithGoal($tournamentName, $nr) {
        $this->tournamentStatistics[$tournamentName]->addMatchesWithGoal($nr);
    }

    public function addMatchesWithAssist($tournamentName, $nr) {
        $this->tournamentStatistics[$tournamentName]->addMatchesWithAssist($nr);
    }

    public function addMatchesWithThirdAssist($tournamentName, $nr) {
        $this->tournamentStatistics[$tournamentName]->addMatchesWithThirdAssist($nr);
    }

    public function addSubstitutedOnAndScored($tournamentName) {
        $this->tournamentStatistics[$tournamentName]->addSubstitutedOnAndScored();
    }

    public function getEvent($eventName, $tournamentName, $getTotal) {
        if ($getTotal) {
            return $this->events[$eventName];
        }
        return $this->tournamentStatistics[$tournamentName]->getEvent($eventName);
    }

    public function getMatchStats($date) {
        foreach ($this->events["matches"] as &$match) {
            if ($match["date"] == $date) {
                return $match;
            }
        }
        return null;
    }

}

class TournamentStatistics {
    public $playerName, $kitNumber, $tournamentName;
    public $statistics;
    public $events;
    public $playerOffAndScored, $matchesWithGoal, $matchesWithAssist;

    public function __construct($tournamentName, $playerName, $kitNumber)
    {
        $this->tournamentName = $tournamentName;
        $this->playerName = $playerName;
        $this->kitNumber = $kitNumber;
        $this->events = [
            "matches" => array(),
            "goalscorer" => array(),
            "assist" => array(),
            "thirdAssist" => array(),
            "Red" => array(),
            "Yellow" => array(),
            "playerOn" => array(),
            "playerOff" => array()
        ];
        $this->statistics = ["matches" => 0,
            "minutes" => 0,
            "substitutedOn" => 0,
            "substitutedOff" => 0,
            "goals" => 0,
            "assists" => 0,
            "thirdAssists" => 0,
            "yellowCards" => 0,
            "redCards" => 0,
            "minPerGoal" => 0,
            "minPerAssist" => 0,
            "minPerGoalPoint" => 0,
            "matchesWithGoal" => 0,
            "matchesWithAssist" => 0,
            "matchesWithThirdAssist" => 0,
            "subbedOnAndScored" => 0];
    }

    public function loadRemainingStats() {
        $minutes = $this->statistics["minutes"];
        if ($minutes > 0) {
            if ($this->statistics["goals"] == 0) $minPerGoal = 0;
            else $minPerGoal = $minutes / $this->statistics["goals"];

            if ($this->statistics["assists"] == 0) $minPerAssist = 0;
            else $minPerAssist = $minutes / $this->statistics["assists"];

            if ($this->statistics["goals"] + $this->statistics["assists"] == 0) $minPerGoalPoint = 0;
            else $minPerGoalPoint = $minutes / ($this->statistics["goals"] + $this->statistics["assists"]);

            $this->statistics["minPerGoal"] = $minPerGoal;
            $this->statistics["minPerAssist"] = $minPerAssist;
            $this->statistics["minPerGoalPoint"] = $minPerGoalPoint;
        }
    }

    public function addMatch($match) {
        array_push($this->events["matches"], $match);
        $this->statistics["matches"]++;
    }

    public function addMinutesPlayed($minutesPlayed) {
        $this->statistics["minutes"] += $minutesPlayed;
    }

    public function addGoal($goal) {
        array_push($this->events["goalscorer"], $goal);
        $this->statistics["goals"]++;
    }

    public function addAssist($assist) {
        array_push($this->events["assist"], $assist);
        $this->statistics["assists"]++;
    }

    public function addThirdAssist($thirdAssist) {
        array_push($this->events["thirdAssist"], $thirdAssist);
        $this->statistics["thirdAssists"]++;
    }

    public function addYellowCard($yellowCard) {
        array_push($this->events["Yellow"], $yellowCard);
        $this->statistics["yellowCards"]++;
    }

    public function addRedCard($redCard) {
        array_push($this->events["Red"], $redCard);
        $this->statistics["redCards"]++;
    }

    public function addSubstitutedOn($substitutedOn) {
        array_push($this->events["playerOn"], $substitutedOn);
        $this->statistics["substitutedOn"]++;
    }

    public function addSubstitutedOff($substitutedOff) {
        array_push($this->events["playerOff"], $substitutedOff);
        $this->statistics["substitutedOff"]++;
    }

    public function addMatchesWithGoal($nr) {
        $this->statistics["matchesWithGoal"] = $nr;
    }

    public function addMatchesWithAssist($nr) {
        $this->statistics["matchesWithAssist"] = $nr;
    }

    public function addMatchesWithThirdAssist($nr) {
        $this->statistics["matchesWithThirdAssist"] = $nr;
    }

    public function addSubstitutedOnAndScored() {
        $this->statistics["subbedOnAndScored"]++;
    }

    public function getEvent($event) {
        return $this->events[$event];
    }

    public function getStat($index) {
        return $this->statistics[$index];
    }

    public function getTournamentName() {
        return $this->tournamentName;
    }
}
