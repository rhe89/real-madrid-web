<?php
/**
 * Created by IntelliJ IDEA.
 * User: Roar
 * Date: 22.07.15
 * Time: 23.06
 */

class NationContainer {
    
    private $nations, $season, $firstTeam;

    //TODO Create sql-view to implement nationality stats feature
    public function __construct($season, $firstTeam)
    {
        $this->season = $season;
        $this->firstTeam = $firstTeam;
        self::loadNations();

    }

    public function loadNations()
    {
        $sql = getArray("
          SELECT nationality
          FROM nations;");

        foreach ($sql as &$nation) {
            $this->nations[$nation["nationality"]] = $nation["nationality"];
        }
    }

    public function getNations() {
        return $this->nations;
    }

    public function getNationalityStats($tournamentName, $nationality, $getTotal)
    {
        $nationalityStats = array();
        $playersWithNationality = array();
        foreach ($this->firstTeam->getSquad() as &$player) {
            if ($player->nationality == $nationality) {

                $playersWithNationality[$player->name] = $player;
            }
        }

        $games = 0;
        $goals = 0;
        $assists = 0;
        $thirdAssists = 0;
        $yellowCards = 0;
        $redCards = 0;
        $players = count($playersWithNationality);

        foreach ($playersWithNationality as &$player) {
            $games += $player->getStat("matches", $tournamentName, $getTotal);
            $goals += $player->getStat("goals", $tournamentName, $getTotal);
            $assists += $player->getStat("assists", $tournamentName, $getTotal);
            $thirdAssists += $player->getStat("thirdAssists", $tournamentName, $getTotal);
            $yellowCards += $player->getStat("yellowCards", $tournamentName, $getTotal);
            $redCards += $player->getStat("redCards", $tournamentName, $getTotal);
        }
        $nationalityStats["players"] = $players;
        $nationalityStats["matches"] = $games;
        $nationalityStats["goals"] = $goals;
        $nationalityStats["assists"] = $assists;
        $nationalityStats["thirdAssists"] = $thirdAssists;
        $nationalityStats["yellowCards"] = $yellowCards;
        $nationalityStats["redCards"] = $redCards;

        return $nationalityStats;
    }


}