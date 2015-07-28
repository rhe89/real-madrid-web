<?php $web_root = $_SERVER['DOCUMENT_ROOT'];
$content = null;

require $web_root . "/realmadrid/head.php"; ?>

<body id="wrapper">
<?php
$selectType = "squad";
require $web_root . "/realmadrid/sideba.php";?>

<main id="page-content-wrapper" class="container">
    <div class="panel panel-primary">
        <header class="panel-heading">
            <h1 id="headline">Squad - First team</h1>
        </header>
        <div class="panel-body">
            <?php
            $includeNumber = true;
            $loanedOut = 1;
            $team = $realMadrid->getFirstTeam();
            $squad = $team->getSquad();
            $firstTeamSquad = $squad;
            $id = "firstTeam";
            $hidden = "";
            include "table.php";

            $includeNumber = false;
            $loanedOut = 1;
            $team = $realMadrid->getCastilla();
            $squad = $team->getSquad();
            $castilla = $squad;
            $id = "castilla";
            $hidden = "hidden";
            include "table.php";

            $squad = array();

            foreach ($firstTeamSquad as &$player) {

                if ($player->loanedOut == 0) {
                    array_push($squad, $player);
                }
            }

            foreach ($castilla as &$player) {
                if ($player->loanedOut == 0) {
                    array_push($squad, $player);
                }
            }
            $id = "loanedOut";
            $hidden = "hidden";
            $loanedOut = 0;
            include "table.php"; ?>
        </div>
    </div>
    <?php
    $content = 'squad';
    require $web_root . "/realmadrid/js-libraries.php"; ?>
</main>
</body>
</html>