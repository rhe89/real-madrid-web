<?php
class Tournament
{

    private $tournamentName;
    private $homeMatches, $awayMatches, $allMatches;
    private $homeOppositions, $awayOppositions, $allOppositions;
    private $leaderboards, $miscStats;
    private $goals = 0, $goalsAgainst = 0, $wins = 0, $draws = 0, $losses = 0;

    public function __construct($tournamentName)
    {
        $this->tournamentName = $tournamentName;

        $this->miscStats["currentForm"] = "";
        $this->miscStats["withoutLoss"] = array();
        $this->miscStats["withoutLossTotal"] = array();
        $this->miscStats["winsInARowTotal"] = array();
        $this->miscStats["winsInARow"] = array();
        $this->miscStats["biggestWin"] = null;
        $this->miscStats["biggestLoss"] = null;
    }

    public function addMatch($match) {

        $goals = intval($match->getGoalsFor());
        $goalsAgainst = intval($match->getGoalsAgainst());
        $this->goals += $goals;
        $this->goalsAgainst += $goalsAgainst;
        if ($goals > $goalsAgainst) $this->wins++;
        else if ($goals < $goalsAgainst) $this->losses++;
        else $this->draws++;

        if ($match->getLocation() == 'Home') {
            $this->homeMatches[$match->getDate()] = $match;
        } else if ($match->getLocation() == 'Away') {
            $this->awayMatches[$match->getDate()] = $match;
        }
        $this->allMatches[$match->getDate()] = $match;

    }

    public function addOpposition($opposition) {
        if ($opposition->getLocation() == 'Home') {
            $this->allOppositions[$opposition->getDate()] = $opposition;
        } else if ($opposition->getLocation() == 'Away') {
            $this->allOppositions[$opposition->getDate()] = $opposition;
        }
        $this->allOppositions[$opposition->getDate()] = $opposition;
    }

    public function addLeaderboard($stat, $list) {
        $this->leaderboards[$stat] = $list;
    }

    public function getLeaderboard($stat) {
        return $this->leaderboards[$stat];
    }

    //TODO Handle nullPointers
    public function loadMiscStats() {
        if ($this->allMatches != null) {
            $mostMatchesWonInARow = ["from" => 0, "to" => 0, "number" => 0];
            $mostMatchesWithoutLossInARow = ["from" => 0, "to" => 0, "number" => 0];
            $lastMatch = end($this->allMatches);
            $firstMatch = reset($this->allMatches);
            $reversed = array_reverse($this->allMatches, true);
            $maxWonCounter = 0;
            $currMaxWon = 0;
            $firstWin = null;
            $lastWin = null;

            if (count($reversed) <= 0 || $lastMatch == null || $firstMatch == null) return;


            foreach ($this->allMatches as &$match) {
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


            $maxWithoutLossCounter = 0;
            $currMaxWithoutLoss = 0;
            $firstWithoutLoss = null;
            $lastWithoutLoss = null;
            foreach ($this->allMatches as &$match) {
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


            $currentMaxDiff = 0;
            $biggestWin = null;

            foreach ($this->allMatches as &$match) {
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

            $currentMaxDiff = 0;
            $biggestLoss = null;

            foreach ($this->allMatches as &$match) {
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

            $counter = 0;
            $currentForm = "";
            foreach ($reversed as &$match) {
                if ($counter < 10) {
                    if ($match->getGoalsFor() > $match->getGoalsAgainst()) $currentForm .= " W";
                    else if ($match->getGoalsAgainst() > $match->getGoalsFor()) $currentForm .= " L";
                    else $currentForm .= " D";
                    $counter++;
                }
            }

            $this->miscStats["biggestWin"] = $biggestWin;
            $this->miscStats["biggestLoss"] = $biggestLoss;
            $this->miscStats["currentForm"] = $currentForm;
            $this->miscStats["winsInARowTotal"] = $mostMatchesWonInARow;
            $this->miscStats["winsInARow"] = $currentMatchesWonInARow;
            $this->miscStats["withoutLossTotal"] = $mostMatchesWithoutLossInARow;
            $this->miscStats["withoutLoss"] = $currentMatchesWithoutLossInARow;
        }
    }

    public function getNext5Matches() {

        $toRet = array();
        $counter = 0;
        if (count($this->allOppositions) != 0)
            foreach ($this->allOppositions as &$opposition) {
                if ($counter < 5) {
                    array_push($toRet, $opposition);
                    $counter++;
                }
            }
        return $toRet;
    }

    public function getLast5Matches() {
        $toRet = array();
        if (count($this->allMatches) != 0) {
            $matches = array_reverse($this->allMatches, true);
            $counter = 0;
            foreach ($matches as &$match) {
                if ($counter < 5) {
                    array_push($toRet, $match);
                    $counter++;
                }
            }
        }
        return array_reverse($toRet, true);
    }
    public function getMiscStat($statName) {
        return $this->miscStats[$statName];
    }

    public function getFirstMatch() {
        return reset($this->allMatches);
    }

    /**
     * @return String The name of the tournament
     */
    public function getTournamentName()
    {
        return $this->tournamentName;
    }

    /**
     * @return Integer The goals scored in the tournament
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * @return Integer The goals conceded in the tournament
     */
    public function getGoalsAgainst()
    {
        return $this->goalsAgainst;
    }

    /**
     * @return Array The matches played at home in the tournament
     */
    public function getHomeMatches()
    {
        return $this->homeMatches;
    }

    /**
     * @return Array The matches played away from home in the tournament
     */
    public function getAwayMatches()
    {
        return $this->awayMatches;
    }

    /**
     * @return Array All matches played in the tournament
     */
    public function getAllMatches()
    {
        return $this->allMatches;
    }

    /**
     * @return Array The oppositions remaining in the tournament
     */
    public function getAllOppositions()
    {
        return $this->allOppositions;
    }

    /**
     * @return Array The oppositions remaining in the tournament at home
     */
    public function getHomeOppositions()
    {
        return $this->homeOppositions;
    }

    /**
     * @return Array The oppositions remaining in the tournament away
     */
    public function getAwayOppositions()
    {
        return $this->awayOppositions;
    }

    /**
     * @return Integer The number of matches won in the tournament
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * @return Integer The number of matches drawn in the tournament
     */
    public function getDraws()
    {
        return $this->draws;
    }

    /**
     * @return Integer The number of matches lost in the tournament
     */
    public function getLosses()
    {
        return $this->losses;
    }
}