<?php

$testing = true;

require $web_root . "/../backend/sql/getSQLdata.php";
require $web_root . "/../backend/data-structure/errorHandling.php";
require $web_root . "/../backend/data-structure/containers/Squad.php";
require $web_root . "/../backend/data-structure/entities/Player.php";
require $web_root . "/../backend/data-structure/entities/Tournament.php";
require $web_root . "/../backend/data-structure/entities/Oppositio.php";
require $web_root . "/../backend/data-structure/entities/Match.php";
require $web_root . "/../backend/data-structure/containers/TournamentContainer.php";
require $web_root . "/../backend/data-structure/containers/MatchContainer.php";
require $web_root . "/../backend/data-structure/containers/OppositionContainer.php";
require $web_root . "/../backend/data-structure/containers/LeaderboardContainer.php";
require $web_root . "/../backend/data-structure/containers/PlayerStatsLoader.php";
require $web_root . "/../backend/data-structure/containers/MiscStatsContainer.php";
require $web_root . "/../backend/data-structure/containers/NationContainer.php";
require $web_root . "/../backend/data-structure/containers/PositionContainer.php";
require $web_root . "/../backend/data-structure/RealMadrid.php";

session_start();

$realMadrid = isset($_SESSION['realmadrid']) ? $_SESSION['realmadrid'] : null;

if ($realMadrid != null && isset($_GET['season']))  {
    if ($_GET['season'] == '2014_2015' || $_GET['season'] == '2015_2016') {
        if ($realMadrid->getSeason() != $_GET['season']) {
            $realMadrid = new RealMadrid($_GET['season'], $whatToLoad);
            $_SESSION["realmadrid"] = $realMadrid;
        }
    } else {
        echo "<script>alert('Invalid season')</script>";
        echo "<script>document.location = 'http://localhost:8888/realmadrid/index.php?season=2015_2016'</script>";
    }
}  else if ($realMadrid == null) {
    $realMadrid = new RealMadrid('2014_2015', $whatToLoad);
    $_SESSION["realmadrid"] = $realMadrid;
    $token = md5(rand(1000,9999));
    $_SESSION['token'] = $token;

} else {
    $realMadrid = $_SESSION["realmadrid"];
    $realMadrid->loadData($whatToLoad);
    $token = $_SESSION['token'];
}
