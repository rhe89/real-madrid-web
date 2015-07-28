<section class="<?php echo$hidden?>" id="<?php echo$id?>">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="no-mobile-col">#</th>
            <th>Name</th>
            <th>Matches</th>
            <th class="no-mobile-col font-awesome center-td-content" id="subbed-on-icon">&#xf062;</th>
            <th class="no-mobile-col font-awesome center-td-content" id="subbed-off-icon">&#xf063;</th>
            <th class="no-mobile-col center-td-content">Minutes</th>
            <th class="font-awesome center-td-content" id="yellow-card-icon">&#xf0c8;</th>
            <th class="font-awesome center-td-content" id="red-card-icon">&#xf0c8;</th>
            <th class="font-awesome center-td-content" id="goal-icon">&#xf1e3;</th>
            <th class="no-mobile-col center-td-content">Assists</th>
            <th class="no-mobile-col center-td-content">Third assists</th>
            <th class="no-mobile-col center-td-content">Min. per goal</th>
            <th class="no-mobile-col center-td-content">Min. per assists</th>
            <th class="no-mobile-col center-td-content">Min. per goal point</th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($firstTeamSquad as &$player):
            if ($player->loanedOut != 1):
                $matches = $player->getStat("matches", $tournamentName, $getTotal);
                $substitutedOn = $player->getStat("substitutedOn", $tournamentName, $getTotal);
                $substitutedOff = $player->getStat("substitutedOff", $tournamentName, $getTotal);
                $minPlayed = $player->getStat("minutes", $tournamentName, $getTotal);
                $yellowCards = $player->getStat("yellowCards", $tournamentName, $getTotal);
                $redCards = $player->getStat("redCards", $tournamentName, $getTotal);
                $goals = $player->getStat("goals", $tournamentName, $getTotal);
                $assists = $player->getStat("assists", $tournamentName, $getTotal);
                $thirdAssists = $player->getStat("thirdAssists", $tournamentName, $getTotal);
                if ($goals == 0) {
                    $minGoal = 0;
                } else {
                    $minGoal = number_format($minPlayed / $goals, 1);
                }
                if ($assists == 0) {
                    $minAssists = 0;
                } else {
                    $minAssists = number_format($minPlayed / $assists, 1);
                }
                if ($goals + $assists == 0) {
                    $minGoalPoint = 0;
                } else {
                    $minGoalPoint = number_format($minPlayed / ($goals + $assists), 1);
                }

                $id = $player->name;
                ?>

                <tr class="player-row" id="<?php echo $id?>">
                    <td class="no-mobile-col"><span><?php echo $player->kitNumber?></span></td>
                    <td><span><?php echo $player->name?></span></td>
                    <td class="center-td-content"><span><?php echo $matches?></span></td>
                    <td class="no-mobile-col center-td-content"><span><?php echo $substitutedOn?></span></td>
                    <td class="no-mobile-col center-td-content"><span><?php echo $substitutedOff?></span></td>
                    <td class="no-mobile-col center-td-content"><span><?php echo $minPlayed?></span></td>
                    <td class="center-td-content"><span><?php echo $yellowCards?></span></td>
                    <td class="center-td-content"><span><?php echo $redCards?></span></td>
                    <td class="center-td-content"><span><?php echo $goals?></span></td>
                    <td class="no-mobile-col center-td-content"><span><?php echo $assists?></span></td>
                    <td class="no-mobile-col center-td-content"><span><?php echo $thirdAssists?></span></td>
                    <td class="no-mobile-col center-td-content"><span><?php echo $minGoal?></span></td>
                    <td class="no-mobile-col center-td-content"><span><?php echo $minAssists?></span></td>
                    <td class="no-mobile-col center-td-content"><span><?php echo $minGoalPoint?></span></td>
                </tr>
            <?php
            endif;
        endforeach;
        ?>
        </tbody>
    </table>
</section>
