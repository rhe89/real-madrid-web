<section class="<?php echo$hidden?>" id="<?php echo$id?>">

    <div class="row">
        <div class="col-lg-6">
            <?php
            $leaderboard = $realMadrid->getLeaderboard($tournamentName, "goalscorer", $getTotal);
            $hidden = "hidden";
            $id = "goals";
            include "leaderboard.php";

            $leaderboard = $realMadrid->getLeaderboard($tournamentName, "assist", $getTotal);
            $hidden = "hidden";
            $id = "assists";
            include "leaderboard.php";

            $leaderboard = $realMadrid->getLeaderboard($tournamentName, "thirdAssist", $getTotal);
            $hidden = "hidden";
            $id = "third-assists";
            include "leaderboard.php";

            $leaderboard = $realMadrid->getLeaderboard($tournamentName, "Yellow", $getTotal);
            $hidden = "hidden";
            $id = "yellow-cards";
            include "leaderboard.php";

            $leaderboard = $realMadrid->getLeaderboard($tournamentName, "Red", $getTotal);
            $hidden = "hidden";
            $id = "red-cards";
            include "leaderboard.php";

            $leaderboard = $realMadrid->getLeaderboard($tournamentName, "playerOn", $getTotal);
            $hidden = "hidden";
            $id = "subbed-on";
            include "leaderboard.php";

            $leaderboard = $realMadrid->getLeaderboard($tournamentName, "playerOff", $getTotal);
            $hidden = "hidden";
            $id = "subbed-off";
            include "leaderboard.php";

            $leaderboard = $realMadrid->getLeaderboard($tournamentName, "matches", $getTotal);
            $hidden = "";
            $id = "matches";
            include "leaderboard.php";

            $leaderboard = $realMadrid->getLeaderboard($tournamentName, "minutes", $getTotal);
            $hidden = "hidden";
            $id = "minutes";
            include "leaderboard.php";
            ?>
        </div>
    </div>
</section>
