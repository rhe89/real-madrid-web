<?php
/**
 * Created by IntelliJ IDEA.
 * User: Roar
 * Date: 22.07.15
 * Time: 23.12
 */

class PositionContainer {
    private $season, $positions, $firstTeam;

    public function __construct($season, $firstTeam)
    {
        $this->season = $season;
        $this->firstTeam = $firstTeam;

        self::loadPositions();
    }

    private function loadPositions()
    {
        $sql = getArray("
        SELECT position
        FROM positions
        ORDER BY positionID;");

        foreach ($sql as &$position) {
            $this->positions[$position["position"]] = $position["position"];
        }
    }

    public function getPositions() {
        return $this->positions;
    }

    public function getPositionStats($tournamentName, $position, $getTotal) {
        $positionStats = array();
        $playersInPosition = array();
        foreach ($this->firstTeam->getSquad() as &$player) {
            if ($player->position == $position) {
                $playersInPosition[$player->name] = $player;
            }
        }

        $games = 0;
        $goals = 0;
        $assists = 0;
        $thirdAssists = 0;
        $yellowCards = 0;
        $redCards = 0;
        $players = count($playersInPosition);

        foreach ($playersInPosition as &$player) {
            $games += $player->getStat("matches", $tournamentName, $getTotal);
            $goals += $player->getStat("goals", $tournamentName, $getTotal);
            $assists += $player->getStat("assists", $tournamentName, $getTotal);
            $thirdAssists += $player->getStat("thirdAssists", $tournamentName, $getTotal);
            $yellowCards += $player->getStat("yellowCards", $tournamentName, $getTotal);
            $redCards += $player->getStat("redCards", $tournamentName, $getTotal);
        }
        $positionStats["players"] = $players;
        $positionStats["matches"] = $games;
        $positionStats["goals"] = $goals;
        $positionStats["assists"] = $assists;
        $positionStats["thirdAssists"] = $thirdAssists;
        $positionStats["yellowCards"] = $yellowCards;
        $positionStats["redCards"] = $redCards;

        return $positionStats;
    }
}