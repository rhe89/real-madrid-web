<?php
/**
Contains miscellaneous match statistics
 */

class MiscStatsContainer {
    private $season, $statistics, $matches, $tournaments;

    public function __construct($season, $tournaments, $matches)
    {
        $this->season = $season;
        $this->matches = $matches;
        $this->tournaments = $tournaments;

        $this->statistics["currentForm"] = "";
        $this->statistics["withoutLoss"] = array();
        $this->statistics["withoutLossTotal"] = array();
        $this->statistics["winsInARowTotal"] = array();
        $this->statistics["winsInARow"] = array();
        $this->statistics["biggestWin"] = null;
        $this->statistics["biggestLoss"] = null;


        self::loadCurrentForm();
        self::loadMatchesLostInARow();
        self::loadMatchesWithoutLoss();
        self::loadMatchesWithoutVictory();
        self::loadMatchesWonInARow();
        self::loadBiggestLoss();
        self::loadBiggestWin();

        foreach ($this->tournaments as &$tournament) {
            $tournament->loadMiscStats();
        }

    }

    public function getMiscStat($tournamentName, $stat, $getTotal) {
        if ($getTotal) {
            return $this->statistics[$stat];
        } else {
            return $this->tournaments[$tournamentName]->getMiscStat($stat);
        }
    }

    private function loadCurrentForm() {
        if ($this->matches != null) {
            $counter = 0;
            $currentForm = "";
            $reversed = array_reverse($this->matches, true);
            if (count($reversed) <= 0) return;
            foreach ($reversed as &$match) {
                if ($counter < 10) {
                    if ($match->getGoalsFor() > $match->getGoalsAgainst()) $currentForm .= " W";
                    else if ($match->getGoalsAgainst() > $match->getGoalsFor()) $currentForm .= " L";
                    else $currentForm .= " D";
                    $counter++;
                }
            }

            $this->statistics["currentForm"] = $currentForm;
        }
    }

    //TODO Handle nullPointers better

    private function loadMatchesWithoutLoss() {
        if ($this->matches != null) {
            $reversed = array_reverse($this->matches, true);
            $lastMatch = end($this->matches);
            $firstMatch = reset($this->matches);
            $mostMatchesWithoutLossInARow = ["from" => 0, "to" => 0, "number" => 0];

            if (count($reversed) <= 0 || $lastMatch == null || $firstMatch == null) return;

            $maxWithoutLossCounter = 0;
            $currMaxWithoutLoss = 0;
            $firstWithoutLoss = null;
            $lastWithoutLoss = null;
            foreach ($this->matches as &$match) {
                if ($match->getGoalsFor() >= $match->getGoalsAgainst()) {
                    if ($currMaxWithoutLoss == 0) {
                        $firstWithoutLoss = $match;
                    }
                    $currMaxWithoutLoss++;
                    $lastWithoutLoss = $match;
                } else {
                    if ($currMaxWithoutLoss > $maxWithoutLossCounter) {
                        $maxWithoutLossCounter = $currMaxWithoutLoss;
                        if ($lastWithoutLoss != null && $firstWithoutLoss != null) {
                            $mostMatchesWithoutLossInARow = ["from" => $firstWithoutLoss->getDate(), "to" => $lastWithoutLoss->getDate(), "number" => $maxWithoutLossCounter];
                        }
                    }
                    $currMaxWithoutLoss = 0;
                }
            }

            if ($currMaxWithoutLoss != 0 && $currMaxWithoutLoss > $maxWithoutLossCounter) {
                $mostMatchesWithoutLossInARow = ["from" => $firstWithoutLoss->getDate(), "to" => $lastMatch->getDate(), "number" => $currMaxWithoutLoss];
            }

            $lastWithoutLoss = null;
            $firstWithoutLoss = null;
            $maxWithoutLossCounter = 0;

            $prevMatch = null;
            $allWithoutLoss = true;


            if ($lastMatch->getGoalsFor() >= $lastMatch->getGoalsAgainst()) {
                foreach ($reversed as &$match) {
                    if ($match->getGoalsFor() >= $match->getGoalsAgainst()) {
                        if ($lastWithoutLoss == null)
                            $lastWithoutLoss = $match;
                        $maxWithoutLossCounter++;
                    } else {
                        $allWithoutLoss = false;
                        if ($prevMatch != null) {
                            $firstWithoutLoss = $prevMatch;
                        }
                        break;
                    }
                    $prevMatch = $match;
                }
            }
            if ($allWithoutLoss) {
                $currentMatchesWithoutLossInARow = ["from" => $firstMatch->getDate(), "to" => $lastMatch->getDate(), "number" => $maxWithoutLossCounter];
            } else {
                $currentMatchesWithoutLossInARow = ["from" => $firstWithoutLoss->getDate(), "to" => $lastWithoutLoss->getDate(), "number" => $maxWithoutLossCounter];
            }

            $this->statistics["withoutLoss"] = $currentMatchesWithoutLossInARow;
            $this->statistics["withoutLossTotal"] = $mostMatchesWithoutLossInARow;
        }

    }

    //TODO Handle nullPointers better

    private function loadMatchesWonInARow() {
        if ($this->matches != null) {
            $mostMatchesWonInARow = ["from" => 0, "to" => 0, "number" => 0];
            $lastMatch = end($this->matches);
            $firstMatch = reset($this->matches);
            $reversed = array_reverse($this->matches, true);
            $maxWonCounter = 0;
            $currMaxWon = 0;
            $firstWin = null;
            $lastWin = null;

            if (count($reversed) <= 0 || $lastMatch == null || $firstMatch == null) return;


            foreach ($this->matches as &$match) {
                if ($match->getGoalsFor() > $match->getGoalsAgainst()) {
                    if ($currMaxWon == 0) {
                        $firstWin = $match;
                    }
                    $currMaxWon++;
                    $lastWin = $match;
                } else {
                    if ($currMaxWon > $maxWonCounter) {
                        $maxWonCounter = $currMaxWon;
                        if ($lastWin != null && $firstWin != null) {
                            $mostMatchesWonInARow = ["from" => $firstWin->getDate(), "to" => $lastWin->getDate(), "number" => $maxWonCounter];
                        }
                    }
                    $currMaxWon = 0;
                }
            }

            if ($currMaxWon != 0 && $currMaxWon > $maxWonCounter) {
                $mostMatchesWonInARow = ["from" => $firstWin->getDate(), "to" => $lastMatch->getDate(), "number" => $currMaxWon];
            }

            $lastWin = null;
            $firstWin = null;
            $prevMatch = null;
            $maxWonCounter = 0;
            $allWon = true;

            if ($lastMatch->getGoalsFor() > $lastMatch->getGoalsAgainst()) {
                foreach ($reversed as &$match) {
                    if ($match->getGoalsFor() > $match->getGoalsAgainst()) {
                        if ($lastWin == null)
                            $lastWin = $match;
                        $maxWonCounter++;
                    } else {
                        $allWon = false;
                        if ($prevMatch != null)
                            $firstWin = $prevMatch;
                        break;
                    }
                    $prevMatch = $match;
                }
            }

            if ($allWon) {
                $currentMatchesWonInARow = ["from" => $firstMatch->getDate(), "to" => $lastMatch->getDate(), "number" => $maxWonCounter];
            } else {
                $currentMatchesWonInARow = ["from" => $firstWin->getDate(), "to" => $lastWin->getDate(), "number" => $maxWonCounter];
            }


            $this->statistics["winsInARowTotal"] = $mostMatchesWonInARow;
            $this->statistics["winsInARow"] = $currentMatchesWonInARow;
        }
    }

    private function loadMatchesWithoutVictory() {

    }

    private function loadMatchesLostInARow() {

    }

    private function loadBiggestWin() {
        if ($this->matches != null) {
            $currentMaxDiff = 0;
            $biggestWin = null;

            foreach ($this->matches as &$match) {
                $diff = $match->getGoalsFor() - $match->getGoalsAgainst();

                if ($diff > $currentMaxDiff) {
                    $biggestWin = $match;
                    $currentMaxDiff = $diff;
                } else if ($diff == $currentMaxDiff) {
                    if ($currentMaxDiff != 0) {
                        if ($match->getGoalsFor() > $biggestWin->getGoalsFor()) {
                            $biggestWin = $match;
                            $currentMaxDiff = $diff;
                        }
                    }
                }
            }
            $this->statistics["biggestWin"] = $biggestWin;
        }
    }

    private function loadBiggestLoss() {
        if ($this->matches != null) {
            $currentMaxDiff = 0;
            $biggestLoss = null;

            foreach ($this->matches as &$match) {
                $diff = $match->getGoalsAgainst() - $match->getGoalsFor();

                if ($diff > $currentMaxDiff) {
                    $biggestLoss = $match;
                    $currentMaxDiff = $diff;
                } else if ($diff == $currentMaxDiff) {
                    if ($currentMaxDiff != 0) {
                        if ($match->getGoalsAgainst() > $biggestLoss->getGoalsAgainst()) {
                            $biggestLoss = $match;
                            $currentMaxDiff = $diff;
                        }
                    }
                }
            }
            $this->statistics["biggestLoss"] = $biggestLoss;
        }

    }
}