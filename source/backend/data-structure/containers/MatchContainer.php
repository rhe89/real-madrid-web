<?php
/**
 * Created by IntelliJ IDEA.
 * User: Roar
 * Date: 22.07.15
 * Time: 22.22
 */

class MatchContainer {

    private $season, $tournaments, $allMatches, $homeMatches, $awayMatches, $miscStatsContainer;

    public function __construct($season, $tournaments)
    {
        $this->season = $season;
        $this->tournaments = $tournaments;
        self::loadAllMatches();
        $this->miscStatsContainer = new MiscStatsContainer($season, $tournaments, $this->allMatches);
    }

    private function loadAllMatches()
    {
        $matches = getArray("
        SELECT *
        FROM matches
        WHERE matches.seasonID = '$this->season'
        ORDER BY date ASC;");

        $lineUps = getArray("
        SELECT * FROM lineups");

        if (count($matches) > 0) {
            foreach ($matches as &$match) {

                $newMatch = new Match($match["date"],
                    $match["time"],
                    $match["tournamentName"],
                    $match["location"],
                    $match["opposition"],
                    $match["goalsFor"],
                    $match["goalsAgainst"]);

                if (count($matches) > 0) {
                    foreach ($lineUps as &$lineUp) {
                        if ($lineUp["date"] == $match["date"])
                            $newMatch->setLineUp($lineUp);
                    }
                }
                if ($match["location"] == 'Home') {
                    $this->homeMatches[$match["date"]] = $newMatch;
                } else if ($match["location"] == 'Away') {
                    $this->awayMatches[$match["date"]] = $newMatch;
                }
                $this->allMatches[$match["date"]] = $newMatch;
                $this->tournaments[$match["tournamentName"]]->addMatch($newMatch);
            }
        }
    }

    public function getMatchList($tournamentName, $getTotal) {
        if ($getTotal) {
            return $this->allMatches;
        } else return $this->tournaments[$tournamentName]->getAllMatches();
    }

    public function getMatch($date) {
        return $this->allMatches[$date];
    }

    public function getLast5Matches($tournamentName, $getTotal) {
        if ($getTotal) {
            $toRet = array();
            $matches = array_reverse($this->allMatches, true);
            $counter = 0;
            foreach ($matches as &$match) {
                if ($counter < 5) {
                    array_push($toRet, $match);
                    $counter++;
                }
            }
            return array_reverse($toRet, true);
        } else {
            return $this->tournaments[$tournamentName]->getLast5Matches();
        }

    }

    public function getMiscStat($tournamentName, $stat, $getTotal) {
        return $this->miscStatsContainer->getMiscStat($tournamentName, $stat, $getTotal);
    }

}