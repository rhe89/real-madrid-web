<?php

class Squad {
    protected $squadName;
    protected $squad, $loanedOut;
    protected $sql;
    protected $season;

    protected function __construct($season, $squadName) {
        $this->season = $season;
        $this->squadName = $squadName;
        $this->squad = array();
    }

//****************************************** SQUAD INFO ********************************************
    public function loadPlayers() {
        $seasonNumber = substr($this->season, 2, 2);

        $playerList = getArray("SELECT name, fullName, birthdate, nationality, positions.position, kitNumber, prefFoot,
                            contractExp, transferFee, transferClub, imgSrc, kitNumber, onLoan, loanedOut, squad
                            FROM players
                            INNER JOIN positions ON positions.positionID = players.position
                            WHERE lastSeason >= '$seasonNumber' AND firstSeason <= '$seasonNumber' AND squad = '$this->squadName'
                            ORDER BY loanedOut, positionID, kitNumber");

        foreach ($playerList as &$playerInfo) {
            $name = $playerInfo["name"];
            $fullName = $playerInfo["fullName"];
            $birthdate = $playerInfo["birthdate"];
            $nationality = $playerInfo["nationality"];
            $position = $playerInfo["position"];
            $kitNumber = $playerInfo["kitNumber"];
            $prefFoot = $playerInfo["prefFoot"];
            $contractExp = $playerInfo["contractExp"];
            $transferFee = $playerInfo["transferFee"];
            $transferClub = $playerInfo["transferClub"];
            $loanedOut = $playerInfo["loanedOut"];
            $imgURL = $playerInfo["imgSrc"];
            $squad = $playerInfo["squad"];

            $player = new Player($name, $fullName, $birthdate, $nationality, $position, $kitNumber, $prefFoot, $contractExp,
                $transferFee, $transferClub, $imgURL, $loanedOut, $squad);
            array_push($this->squad, $player);

        }

    }

    function getPlayersInPosition($position) {
        if ($position == 'goalkeepers') return self::getGoalkeepers();
        else if ($position == 'defenders') return self::getDefenders();
        else if ($position == 'midfielders') return self::getMidfielders();
        else if ($position == 'attackers') return self::getAttackers();
        else return null;
    }
    function getGoalkeepers() {
        $toRet = array();

        foreach($this->squad as &$player) {
            if ($player->position == "Goalkeeper" && !$player->loanedOut) array_push($toRet, $player);
        }

        return $toRet;
    }

    function getDefenders() {
        $toRet = array();

        foreach($this->squad as &$player) {
            if ($player->position == "Full back" || $player->position == "Defender" && !$player->loanedOut) array_push($toRet, $player);
        }
        return $toRet;
    }

    function getMidfielders() {
        $toRet = array();

        foreach($this->squad as &$player) {
            if ($player->position == "Midfielder" && !$player->loanedOut) array_push($toRet, $player);
        }
        return $toRet;
    }

    function getAttackers() {
        $toRet = array();

        foreach($this->squad as &$player) {
            if ($player->position == "Attacker" && !$player->loanedOut) array_push($toRet, $player);
        }
        return $toRet;
    }


    function getPlayer($name) {
        foreach ($this->squad as $player) {
            if ($player->name == $name) {
                return $player;
            }
        }
    }

    function containsPlayer($name) {
        foreach ($this->squad as $player) {
            if ($player->name == $name) {
                return true;
            }
        }
        return false;
    }

    public function getSquad() {
        return $this->squad;
    }

    function getSquadName() {
        return $this->squadName;
    }

}


class FirstTeam extends Squad {

    public function __construct($season, $squadName) {
        parent :: __construct($season, $squadName);
    }
}


class Castilla extends Squad {

    public function __construct($season, $squadName) {

        parent::__construct($season, $squadName);

    }
}