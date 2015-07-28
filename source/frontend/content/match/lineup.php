<div class="col-lg-7">
<section class="panel panel-primary" id="line-up">
    <header class="panel-heading">
        <h2>Lineup</h2>
    </header>
    <?php
    $lineUp = $match->getLineUp();
    $player1 = $realMadrid->getPlayer($lineUp["player1"]);
    $player2 = $realMadrid->getPlayer($lineUp["player2"]);
    $player3 = $realMadrid->getPlayer($lineUp["player3"]);
    $player4 = $realMadrid->getPlayer($lineUp["player4"]);
    $player5 = $realMadrid->getPlayer($lineUp["player5"]);
    $player6 = $realMadrid->getPlayer($lineUp["player6"]);
    $player7 = $realMadrid->getPlayer($lineUp["player7"]);
    $player8 = $realMadrid->getPlayer($lineUp["player8"]);
    $player9 = $realMadrid->getPlayer($lineUp["player9"]);
    $player10 = $realMadrid->getPlayer($lineUp["player10"]);
    $player11 = $realMadrid->getPlayer($lineUp["player11"]);
    $player12 = isset($lineUp['substitute1']) ? $realMadrid->getPlayer($lineUp["substitute1"]) : false;
    $player13 = isset($lineUp['substitute2']) ? $realMadrid->getPlayer($lineUp["substitute2"]) : false;
    $player14 = isset($lineUp['substitute3']) ? $realMadrid->getPlayer($lineUp["substitute3"]) : false;


    ;?>
    <section id="pitch" class="panel-body">
        <div class=" col-lg-12">
        <table id="lineup-table">
            <tr class="no-hover">
                <td class="space"></td>
            </tr>
            <tr class="no-hover">
                <td class="space"></td>
                <td></td>
                <td class="position" id="position8">
                    <p><?php echo $player9->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player9->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player9->name)?>.jpeg'>
                </td>
                <td></td>
                <td class="position" id="position10">
                    <p><?php echo $player10->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player10->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player10->name)?>.jpeg'>
                </td>
                <td></td>
                <td class="position" id="position9">
                    <p><?php echo $player11->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player11->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player11->name)?>.jpeg'>
                </td>
                <td></td>
                <td class="space"></td>
            </tr>
            <tr class="no-hover"><td class="space"></td></tr>
            <tr class="no-hover">
                <td class="space"></td>
                <td></td>
                <td class="position" id="position5">
                    <p><?php echo $player8->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player8->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player8->name)?>.jpeg'>
                </td>
                <td></td>
                <td class="position" id="position6">
                    <p><?php echo $player7->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player7->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player7->name)?>.jpeg'>
                </td>
                <td></td>
                <td class="position" id="position7">
                    <p><?php echo $player6->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player6->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player6->name)?>.jpeg'>
                </td>
                <td></td>
                <td class="space"></td>
            </tr>
            <tr class="no-hover"><td class="space"></td></tr>
            <tr class="no-hover">
                <td class="space"></td>
                <td class="position" id="position1">
                    <p><?php echo $player5->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player5->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player5->name)?>.jpeg'>
                </td>
                <td></td>
                <td class="position" id="position2">
                    <p><?php echo $player4->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player4->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player4->name)?>.jpeg'>
                </td>
                <td></td>
                <td class="position" id="position3">
                    <p><?php echo $player3->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player3->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player3->name)?>.jpeg'>
                </td>
                <td></td>
                <td class="position" id="position4">
                    <p><?php echo $player2->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player2->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player2->name)?>.jpeg'></td>
                <td class="space"></td>
            </tr>
            <tr class="no-hover"><td class="space"></td></tr>
            <tr class="no-hover">
                <td class="space"></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="position" id="position0">
                    <p><?php echo $player1->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player1->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player1->name)?>.jpeg'>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td class="space"></td>
            </tr>
            <tr class="no-hover">
                <td class="space"></td>
            </tr>
        </table>

        <table id="substitutes-table">
            <tr class="no-hover">
                <td class="substitute" id="position11">
                    <?php if($player12):?>
                    <p><?php echo $player12->name?></p>
                    <img class="player-img" id="<?php $id = str_replace(" ", "", $player12->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player12->name)?>.jpeg'>
                    <?php endif;?>
                </td>
                <td class="substitute" id="position12">
                    <?php if($player13):?>
                        <p><?php echo $player13->name?></p>
                        <img class="player-img" id="<?php $id = str_replace(" ", "", $player13->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player13->name)?>.jpeg'>
                    <?php endif;?>
                </td>
                <td class="substitute" id="position13">
                    <?php if($player14):?>
                        <p><?php echo $player14->name?></p>
                        <img class="player-img" id="<?php $id = str_replace(" ", "", $player14->name); echo $id?>" src='/realmadrid/img/players/headshots/<?php echo str_replace(' ', '', $player14->name)?>.jpeg'>
                    <?php endif;?>
                </td>
        </table>
        </div>
    </section>

    <?php /*
    foreach ($lineUp as &$player):
        if ($player{0} != 2) {
            $id = str_replace(" ", "", $player);
            $playerObj = $realMadrid->getFirstTeam()->getPlayer($player);
            if ($playerObj != null) {
                $date = $match->getDate();
                $playerStats = $playerObj->getMatchStats($date);

                ?>

                <div class="stats hidden" id="stats-<?php echo $id ?>">
                    <table>
                        <tr class="no-hover">
                            <td>Minutes</td>
                            <td>Goals</td>
                            <td>Assists</td>
                            <td>Third assists</td>
                            <td>Yellow cards</td>
                            <td>Red cards</td>
                        </tr>
                        <tr class="no-hover">
                            <td><?php echo $playerStats["minutesPlayed"]?></td>
                            <td><?php echo $playerStats["goals"]?></td>
                            <td><?php echo $playerStats["assists"]?></td>
                            <td><?php echo $playerStats["thirdAssists"]?></td>
                            <td><?php echo $playerStats["yellowCards"]?></td>
                            <td><?php echo $playerStats["redCards"]?></td>
                        </tr>
                    </table>
                </div>
            <?php }
        }
    endforeach;*/?>

</section>
</div>