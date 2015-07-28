<table class="table table-hover <?php echo$hidden?>" id="<?php echo$id?>">
    <thead>
    <tr>
        <?php if($includeNumber): ?>
            <th class="no-mobile-col">#</th>
        <?php endif;?>
        <th>Name</th>
        <th class="center-td-content no-mobile-col">Birth date</th>
        <th class="no-mobile-col">Age</th>
        <th>Nationality</th>
        <th>Position</th>
        <th class="no-mobile-col">Foot</th>
        <th class="center-td-content no-mobile-col">Contract</th>
        <th class="center-td-content no-mobile-col">Age at exp. date</th>
        <th class="no-mobile-col">Fee</th>
        <th class="no-mobile-col">Transferred from</th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($squad as &$player):
        if ($player->loanedOut != $loanedOut):

            $id = $player->name;
            ?>
            <tr class="player-row <?php echo $id?>" id="<?php echo $id?>">
                <?php if ($player->kitNumber):?>
                    <td class="no-mobile-col" id="kitNumber"><span><?php echo $player->kitNumber?></span></td>
                <?php endif;?>
                <td id="name" style="text-align: left;"><span><?php echo $player->name?></span></td>
                <td class="center-td-content no-mobile-col"><span><?php echo $player->birthdate?></span></td>
                <td class="center-td-content no-mobile-col"><span><?php echo $player->age?></span></td>
                <td><span><?php echo $player->nationality?></span></td>
                <td><span><?php echo $player->position?></span></td>
                <td class="no-mobile-col"><span><?php echo $player->prefFoot?></span></td>
                <td class="center-td-content no-mobile-col"><span><?php echo $player->contractExp?></span></td>
                <td class="center-td-content no-mobile-col"><span><?php echo $player->ageWhenContrExpired?></span></td>
                <td class="no-mobile-col"><span><?php echo "€".$player->transferFee." mill"?></span></td>
                <td class="no-mobile-col"><span><?php echo $player->transferClub?></span></td>
                <?php if ($player->loanedOut == 1):?>
                    <td class="no-mobile-col"><span><?php echo $player->loanClub?></span></td>
                    <td class="no-mobile-col"><span><?php echo $player->loanExpirationDate?></span></td>
                <?php endif;?>
            </tr>

        <?php
        endif;
    endforeach;
    ?>
    </tbody>
</table>
