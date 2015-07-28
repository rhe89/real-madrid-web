<?php
class Opposition {
    private $date, $time, $tournamentName, $location, $opposition;

    public function __construct($date, $time, $tournamentName, $location, $opposition)
    {
        $this->date = $date;
        $this->time = date('G:i', strtotime($time));
        $this->tournamentName = $tournamentName;
        $this->location = $location;
        $this->opposition = $opposition;
    }

    /**
     * @return String The date the match was played
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return String The time the match was played
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return String The tournament the match was played in
     */
    public function getTournamentName()
    {
        return $this->tournamentName;
    }

    /**
     * @return String The location of where the match took place
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return String The opposition Real Madrid met
     */
    public function getOpposition()
    {
        return $this->opposition;
    }
}

