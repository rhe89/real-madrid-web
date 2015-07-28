<?php
$stylesheet = 'player';
$web_root = $_SERVER['DOCUMENT_ROOT'];
$content = null;

$whatToLoad = 'player-statistics';

require $web_root . "/realmadrid/head.php"; ?>

<body id="wrapper">
<?php $selectType = "tournament";
require $web_root . "/realmadrid/sideba.php";?>

<main id="page-content-wrapper" class="player container-fluid">
    <?php $player = null;

    if (isset($_GET["playerID"])):
        $playerID = $_GET["playerID"];
        $playerName = str_replace("%20", " ", $playerID);
        $player = $realMadrid->getFirstTeam()->getPlayer($playerName);


        if ($player == null) $player = $realMadrid->getCastilla()->getPlayer($playerName);
    endif;

    if ($player != null):?>
        <?php
        $tournamentName = "";
        $id = "total";
        $hidden = "";
        $getTotal = true;
        include "tournament.php";

        $tournamentName = "La Liga";
        $id = "laLiga";
        $hidden = "hidden";
        $getTotal = false;

        include "tournament.php";
        $tournamentName = "Champions League";
        $id = "championsLeague";
        $hidden = "hidden";
        $getTotal = false;

        include "tournament.php";

        $tournamentName = "Copa del Rey";
        $id = "copaDelRey";
        $hidden = "hidden";
        $getTotal = false;
        include "tournament.php";

        else: echo "Something wrong happened. Sorryyyy";

        endif;
        ?>
</main>
<?php $content = 'player';
require $web_root . "/realmadrid/js-libraries.php"; ?>
</body>

</html>

