<?php

$content = 'match';
$web_root = $_SERVER['DOCUMENT_ROOT'];

$whatToLoad = 'matches, player-statistics';

require $web_root . "/realmadrid/head.php";?>

<body id="wrapper">
<?php
$selectType = "tournament";
require $web_root . "/realmadrid/sideba.php";?>

<main id="page-content-wrapper" class="container-fluid">
    <?php
    $match = null;

    if (isset($_GET["matchID"])) {
        $matchID = $_GET["matchID"];
        $date = str_replace("%", " ", $matchID);

        $match = $realMadrid->getMatch($date);

        $id = $match->getDate();
    }

    if ($match != null) {
        ?>
        <div class="col-lg-12">
        <section class="panel panel-primary" id="match-info">

            <?php
            if ($match->getLocation() == 'Away'):
                $homeTeam = $match->getOpposition();
                $awayTeam = 'Real Madrid';
            else:
                $awayTeam = $match->getOpposition();
                $homeTeam = 'Real Madrid';
            endif;
            ?>
            <header class="panel-heading">
                <h1 id="teams"><?php echo $homeTeam . ' vs. ' . $awayTeam; ?></h1>
            </header>
            <div class="panel-body">
            <h1 id="result"><?php echo $match->getResult() ?></h1>

            <p id="date"><?php echo $match->getDate(); ?></p>

            <p id="tournament"><?php echo $match->getTournamentName() ?></p>
            </div>
        </section>
        </div>
        <?php include "lineup.php";
    } else {
        echo "Something wrong happened. Sorryyy";
    }?>
    <div class="col-lg-5">
        <section class="panel panel-primary" id="goals">
            <header class="panel-heading">
                <h2>Goals</h2>
            </header>

            <div class="panel-body">
                <?php
                $counter = 0;
                foreach ($match->getEvents() as &$events) {

                    if (isset($events["goalscorer"])) {
                        $counter++;

                        echo "<p><b> Min. " . $events["minute"] . " - " . $events["goalscorer"] . " </b><br>
                    Assisted by " . $events["assist"] . "<br>
                    Third assist: " . $events["thirdAssist"] . "<br>
                    Location: " . $events["goalLocation"] . "<br>
                    Type of goal: " . $events["type"] . "<br></p>";
                    }
                }

                if ($counter == 0) echo "None";
                ?>
            </div>
        </section>

        <section class="panel panel-primary" id="cards">
            <header class="panel-heading">
                <h2>Cards</h2>
            </header>

            <div class="panel-body">
                <?php
                $counter = 0;
                foreach ($match->getEvents() as &$events) {

                    if (isset($events["cause"])) {
                        $counter++;
                        echo "<p><b>Min. " . $events["minute"] . " - " . $events["player"] . "</b><br>
                        Type: " . $events["type"] . " card " . "<br>
                        Cause: " . $events["cause"] . "<br></p>";

                    }
                }
                if ($counter == 0) echo "None";
                ?>
            </div>
        </section>

        <section class="panel panel-primary" id="substitutions">
            <header class="panel-heading"><h2>Substitutions</h2></header>

            <div class="panel-body">
                <?php
                $counter = 0;
                foreach ($match->getEvents() as &$events) {

                    if (isset($events["playerOn"])) {
                        $counter++;
                        echo "<p><b>Min. " . $events["minute"] . "</b><br>
                        Player off: " . $events["playerOff"] . "<br>
                        Player on: " . $events["playerOn"] . "<br></p>";

                    }
                }
                if ($counter == 0) echo "None";
                ?>
            </div>
        </section>
    </div>


</main>

<?php
require $web_root . "/realmadrid/js-libraries.php";
?>

</body>
</html>