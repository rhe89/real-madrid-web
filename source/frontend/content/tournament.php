
<section class="tournament-stats container col-lg-12 <?php echo $hidden?>" id="<?php echo $id?>">

    <div class="col-lg-6">
        <section class="panel panel-primary ">
            <header class="panel-heading">
                <h2>Last 5 matches</h2>
            </header>

            <table class="table panel-body">
                <tbody>
                <?php
                $counter = 0;
                foreach ($realMadrid->getLast5Matches($tournamentName, $getTotal) as &$match):
                    $counter++;
                    $location = "H";
                    if ($match->getLocation() == "Away") $location = "A";
                    else if ($match->getLocation() == "Neutral") $location = "N";
                    ?>
                    <tr class="match-row" id="<?php echo $match->getDate()?>">
                        <td class="no-mobile-col"><span><?php echo $match->getTournamentName()?></span></td>
                        <td><span><?php echo $match->getDate()?></span></td>
                        <td class="no-mobile-col"><span><?php echo $match->getTime()?></span></td>

                        <td><span><?php echo $match->getOpposition() . " (" . $location . ") "?></span></td>
                        <td><span><?php echo $match->getResult()?></span></td>
                    </tr>
                <?php endforeach;
                if ($counter == 0):?>
                    <tr>
                        <td>No matches played!</td>
                    </tr>
                <?php endif;?>
                </tbody>
            </table>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="panel panel-primary ">
            <header class="panel-heading">
                <h2>Next 5 matches</h2>
            </header>
                <table class="table panel-body">
                    <tbody>
                    <?php
                    $counter = 0;
                    foreach ($realMadrid->getNext5Matches($tournamentName, $getTotal) as &$match):
                        $counter++;
                        $location = "H";
                        if ($match->getLocation() == "Away") $location = "A";
                        else if ($match->getLocation() == "Neutral") $location = "N";
                        ?>
                        <tr>
                            <td class="no-mobile-col"><?php echo $match->getTournamentName()?></td>
                            <td><?php echo $match->getDate()?></td>
                            <td class="no-mobile-col"><?php echo $match->getTime()?></td>
                            <td class="no-mobile-col"><?php echo $match->getLocation()?></td>
                            <td><?php echo $match->getOpposition() . " (" . $location . ") "?></td>
                        </tr>
                    <?php endforeach;
                    if ($counter == 0):?>
                        <tr>
                            <td>No more matches to play!</td>
                        </tr>
                    <?php endif;?>
                    </tbody>
                </table>
        </section>
    </div>
    <div class="col-lg-12">
        <section class="panel panel-primary ">
            <header class="panel-heading">
                <h2>Team performance</h2>
            </header>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Matches played</th>
                        <th>Won</th>
                        <th>Drawn</th>
                        <th>Lost</th>
                        <th class="no-mobile-col">Goals scored</th>
                        <th class="no-mobile-col">Goals allowed</th>
                        <th class="no-mobile-col">Goal difference</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $realMadrid->getMatchCount($tournamentName, $getTotal)?></td>
                        <td><?php echo $realMadrid->getWins($tournamentName, $getTotal)?></td>
                        <td><?php echo $realMadrid->getDraws($tournamentName, $getTotal)?></td>
                        <td><?php echo $realMadrid->getLosses($tournamentName, $getTotal)?></td>
                        <td class="no-mobile-col"><?php echo $realMadrid->getGoals($tournamentName, $getTotal)?></td>
                        <td class="no-mobile-col"><?php echo $realMadrid->getGoalsAgainst($tournamentName, $getTotal)?></td>
                        <td class="no-mobile-col"><?php echo $realMadrid->getGoals($tournamentName, $getTotal) - $realMadrid->getGoalsAgainst($tournamentName, $getTotal)?></td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td>Recent form (last 10 matches)</td>
                        <td><?php echo $realMadrid->getMiscStat($tournamentName, "currentForm", $getTotal); ?></td>
                    </tr>
                    <tr>
                        <?php $withoutLossTotal = $realMadrid->getMiscStat($tournamentName, "withoutLossTotal", $getTotal);?>
                        <td>Most matches without loss:</td>
                        <td><?php
                            if ($withoutLossTotal["number"] == 0) {
                                echo 0;
                            } else {
                                echo $withoutLossTotal["number"] . " (from " . $withoutLossTotal["from"] . " to " . $withoutLossTotal["to"]  .  ")";
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <?php $withoutLoss = $realMadrid->getMiscStat($tournamentName, "withoutLoss", $getTotal);?>
                        <td>Current number of matches without loss:</td>
                        <td><?php
                            if ($withoutLoss["number"] == 0) {
                                echo 0;
                            } else {
                                echo $withoutLoss["number"] . " (from " . $withoutLoss["from"] . ")";
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <?php $winsInARowTotal = $realMadrid->getMiscStat($tournamentName, "winsInARowTotal", $getTotal);?>
                        <td>Most matches won in a row:</td>
                        <td><?php
                            if ($winsInARowTotal["number"] == 0) {
                                echo 0;
                            } else {
                                echo $winsInARowTotal["number"] . " (from " . $winsInARowTotal["from"] . " to " . $winsInARowTotal["to"]  .  ")";
                            }
                            ?></td>
                    </tr>

                    <tr>
                        <?php $winsInARow = $realMadrid->getMiscStat($tournamentName, "winsInARow", $getTotal);?>
                        <td>Current number of matches won in a row</td>
                        <td><?php
                            if ($winsInARow["number"] == 0) {
                                echo 0;
                            } else {
                                echo $winsInARow["number"] . " (from " . $winsInARow["from"] . ")";
                            }?></td>
                    </tr>

                    <tr id="match-date">
                        <td>Biggest win</td>
                        <?php
                        $biggestWin = $realMadrid->getMiscStat($tournamentName, "biggestWin", $getTotal);
                        if ($biggestWin != null) {?>
                            <td><?php echo $biggestWin->getGoalsFor() . " - " . $biggestWin -> getGoalsAgainst() . " vs. " . $biggestWin->getOpposition() . " (" . $biggestWin->getDate() . ")"; ?></td>
                        <?php } else { ?>
                            <td>N/A (opposition, location)</td>
                        <?php } ?>
                    </tr>

                    <tr id="match-date">
                        <td>Biggest defeat</td>
                        <?php
                        $biggestLoss = $realMadrid->getMiscStat($tournamentName, "biggestLoss", $getTotal);
                        if ($biggestLoss != null) {?>
                            <td><?php echo $biggestLoss->getGoalsFor() . " - " . $biggestLoss -> getGoalsAgainst() . " vs. " . $biggestLoss->getOpposition() . " (" . $biggestLoss->getDate() . ")"; ?></td>
                        <?php } else { ?>
                            <td>N/A (opposition, location)</td>
                        <?php } ?>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</section>
