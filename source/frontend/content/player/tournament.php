
<section class="tournament <?php echo$hidden?>" id="<?php$id?>">
    <img id="player-img" src="<?php echo$player->imgURL?>">
    <div class="col-lg-12">
        <div class="panel panel-primary" id="player-stats">
            <header class="panel-heading">
                <h2>Match statistics</h2>
            </header>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr class="headline no-hover">
                        <th>Matches</th>
                        <th class="no-mobile-col font-awesome center-td-content" id="subbed-on-icon">&#xf062;</th>
                        <th class="no-mobile-col font-awesome center-td-content" id="subbed-off-icon">&#xf063;</th>
                        <th class="no-mobile-col center-td-content">Minutes</th>
                        <th class="font-awesome center-td-content" id="yellow-card-icon">&#xf0c8;</th>
                        <th class="font-awesome center-td-content" id="red-card-icon">&#xf0c8;</th>
                        <th class="font-awesome center-td-content" id="goal-icon">&#xf1e3;</th>
                        <th class="center-td-content">Assists</th>
                        <th class="center-td-content no-mobile-col">Third assists</th>
                        <th class="center-td-content no-mobile-col">Min. per goal</th>
                        <th class="center-td-content no-mobile-col">Min. per assist</th>
                        <th class="center-td-content no-mobile-col">Min. per goal point</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
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
                    }?>
                    <tr>
                        <td><?php echo$matches?></td>
                        <td class="center-td-content no-mobile-col"><?php echo$substitutedOn?></td>
                        <td class="center-td-content center-td-content no-mobile-col"><?php echo$substitutedOff?></td>
                        <td class="center-td-content no-mobile-col"><?php echo$minPlayed?></td>
                        <td class="center-td-content"><?php echo$yellowCards?></td>
                        <td class="center-td-content"><?php echo$redCards?></td>
                        <td class="center-td-content"><?php echo$goals?></td>
                        <td class="center-td-content"><?php echo$assists?></td>
                        <td class="center-td-content no-mobile-col"><?php echo$thirdAssists?></td>
                        <td class="center-td-content no-mobile-col"><?php echo$minGoal?></td>
                        <td class="center-td-content no-mobile-col"><?php echo$minAssists?></td>
                        <td class="center-td-content no-mobile-col"><?php echo$minGoalPoint?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="panel panel-primary">
            <header class="panel-heading">
                <h2>Player info</h2>
            </header>
            <div class="panel-body">
                <div class="media">
                    <div class="media-body" id="player-info">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Name: <?php echo$player->name ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Age: <?php echo$player->age ?> years</td>
                            </tr>
                            <tr>
                                <td>Contract length: <?php echo$player->contractExp ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Position: <?php echo$player->position ?></td>
                            </tr>
                            <tr>
                                <td>Preferred foot: <?php echo$player->prefFoot ?></td>
                            </tr>
                            <tr>
                                <td>Arrived from: <?php echo$player->transferClub ?></td>
                            </tr>
                            <tr>
                                <td>Transfer fee: <?php echo$player->transferFee ?>€ mill.</td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                    Scored in <b><?php echo$player->getStat("matchesWithGoal", $tournamentName, $getTotal)?></b> of
                                    <b><?php echo$matches ?></b> matches played.
                                </td>
                            </tr>
                            <tr>
                                <td>Provided an assist in <b><?php echo$player->getStat("matchesWithAssist", $tournamentName, $getTotal)?></b> of
                                    <b><?php echo$matches ?></b> matches played.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Was third last on a goal in <b><?php echo$player->getStat("matchesWithThirdAssist", $tournamentName, $getTotal)?></b> of
                                    <b><?php echo$matches ?></b> matches played.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Scored <b><?php echo$player->getStat("subbedOnAndScored", $tournamentName, $getTotal)?></b> of
                                    <b><?php echo$substitutedOn ?></b> times substituted on.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="media-right">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="panel panel-primary">
            <header class="panel-heading">
                <h2>Detailed match statistics</h2>
            </header>
            <div class="panel-body">
                <select class="form-control" id="select-event" onchange="selectEvent()">
                    <option value="matches">Matches played</option>
                    <option value="goals">Goals</option>
                    <option value="assists">Assists</option>
                    <option value="third-assists">Third assists</option>
                    <option value="yellow-cards">Yellow cards</option>
                    <option value="red-cards">Red cards</option>
                </select>

                <?php include "tournament-events.php";?>
            </div>
        </div>
    </div>
</section>

