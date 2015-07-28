<?php
/**
 * Created by IntelliJ IDEA.
 * User: Roar
 * Date: 22.07.15
 * Time: 22.35
 */

class OppositionContainer {
    private $allOppositions, $homeOppositions, $awayOppositions, $tournaments, $season;

    public function __construct($season, $tournaments)
    {
        $this->tournaments = $tournaments;
        $this->season = $season;
        $this->loadAllOppositions();
    }

    private function loadAllOppositions()
    {
        $oppositions = getArray("
        SELECT *
        FROM oppositions WHERE seasonID = '$this->season'
        ORDER BY date ASC;");

        if (count($oppositions) > 0) {
            foreach ($oppositions as &$opposition) {
                $newOpposition = new Opposition($opposition["date"],
                    $opposition["time"],
                    $opposition["tournamentName"],
                    $opposition["location"],
                    $opposition["opposition"]);
                if ($opposition["location"] == 'Home') {
                    $this->homeOppositions[$opposition["date"]] = $newOpposition;
                } else if ($opposition["location"] == 'Away') {
                    $this->awayOppositions[$opposition["date"]] = $newOpposition;
                }
                $this->allOppositions[$opposition["date"]] = $newOpposition;
                $this->tournaments[$opposition["tournamentName"]]->addOpposition($newOpposition);
            }
        }

    }

    public function getOppositionsList($tournamentName, $getTotal) {
        if ($getTotal) {
            return $this->allOppositions;
        } else return $this->tournaments[$tournamentName]->getAllOppositions();
    }

    public function getNext5Matches($tournamentName, $getTotal)
    {

        if ($getTotal) {

            $toRet = array();
            $counter = 0;
            foreach ($this->allOppositions as &$opposition) {
                if ($counter < 5) {
                    array_push($toRet, $opposition);
                    $counter++;
                }
            }
            return $toRet;
        } else {
            return $this->tournaments[$tournamentName]->getNext5Matches();
        }
    }
}