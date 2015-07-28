<?php
class Match {
  private $date, $time, $tournamentName, $location, $opposition, $goalsFor, $goalsAgainst;
  private $lineUp;
  private $events;
  public function __construct($date, $time, $tournamentName, $location, $opposition, $goalsFor, $goalsAgainst)
  {
    $this->date = $date;
    $this->time = date('G:i', strtotime($time));
    $this->tournamentName = $tournamentName;
    $this->location = $location;
    $this->opposition = $opposition;
    $this->goalsFor = $goalsFor;
    $this->goalsAgainst = $goalsAgainst;
    $this->events = array();

  }

  public function setLineUp($lineUp) {
    $this->lineUp = $lineUp;
  }

  public function setEvents($events) {
    array_push($this->events, $events);
  }

  public function getEvents() {
    return $this->events;
  }

  public function getLineUp() {
    return $this->lineUp;
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

  /**
   * @return Integer The goals scored in the match
   */
  public function getGoalsFor()
  {
    return $this->goalsFor;
  }

  /**
   * @return Integer The goals conceded in the match
   */
  public function getGoalsAgainst()
  {
    return $this->goalsAgainst;
  }

  public function getResult() {
    if ($this->location == "Away") return $this->goalsAgainst . " - " . $this->goalsFor;
    else return $this->goalsFor . " - " . $this->goalsAgainst;
  }

  /**
   * @return String The outcome of the match (win, draw, loss) depending on the result
   */
  public function getOutcome() {
    if ($this->goalsFor > $this->getGoalsAgainst()) {
      return "Win";
    } else if ($this->goalsFor < $this->getGoalsAgainst()) {
      return "Loss";
    } else {
      return "Draw";
    }
  }
}

