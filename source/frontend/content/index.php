<?php
$content = null;
$web_root = $_SERVER['DOCUMENT_ROOT'];

$whatToLoad = 'matches, oppositions';

require $web_root . "/realmadrid/head.php";


?>

<body id="wrapper">

<?php
$selectType = "tournament";
require $web_root . "/realmadrid/sideba.php";?>

<main id="page-content-wrapper" class="container">
    <?php
    $tournamentName = "none";
    $getTotal = true;
    $id = "total";
    $hidden = "";
    include "tournament.php";

    $tournamentName = "La Liga";
    $getTotal = false;
    $id = "laLiga";
    $hidden = "hidden";
    include "tournament.php";

    $tournamentName = "Champions League";
    $getTotal = false;
    $id = "championsLeague";
    $hidden = "hidden";
    include "tournament.php";

    $tournamentName = "Copa del Rey";
    $getTotal = false;
    $id = "copaDelRey";
    $hidden = "hidden";
    include "tournament.php";?>

<?php require "js-libraries.php"; ?>
</body>
</html>