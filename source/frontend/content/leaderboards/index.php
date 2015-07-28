<?php $content = null;
$web_root = $_SERVER['DOCUMENT_ROOT'];

$whatToLoad = 'leaderboards';

require $web_root . "/realmadrid/head.php"; ?>

<body id="wrapper">
<?php
$selectType = "tournament";
require $web_root . "/realmadrid/sideba.php";?>

<main id="page-content-wrapper" class="container-fluid">
    <div class="panel panel-primary">
        <header class="panel-heading">
            <h1 id="headline">Leaderboards - All tournaments</h1>
        </header>
        <div class="panel-body">

            <select id="select-leaderboard" class="form-control input-large" onchange="selectLeaderboard()">
                <option value="matches">Most matches played</option>
                <option value="subbed-on">Most times substituted on</option>
                <option value="subbed-off">Most times substituted off</option>
                <option value="minutes">Most minutes played</option>
                <option value="goals">Most goals</option>
                <option value="assists">Most assists</option>
                <option value="third-assists">Most third assists</option>
                <option value="yellow-cards">Most yellow cards</option>
                <option value="red-cards">Most red cards</option>
            </select>

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
        </div>
    </div>
</main>

<?php $content = 'leaderboards';
require $web_root . "/realmadrid/js-libraries.php"; ?>
<script>$("#home").toggleClass("selected", true);</script>

</body>
</html>

