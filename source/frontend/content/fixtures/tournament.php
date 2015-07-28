<section class="<?php echo$hidden?>" id="<?php echo$id?>">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Date</th>
            <th class="no-mobile-col">Time</th>
            <?php
            if ($getTotal): ?>
                <th class="no-mobile-col">Tournament</th>
            <?php endif; ?>
            <th class="no-mobile-col">Location</th>
            <th>Opposition</th>
            <th>Result</th>
            <th class="no-mobile-col">Outcome</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $matchList = $realMadrid->getMatchList($tournamentName, $getTotal);
        if (count($matchList) != 0):
            foreach ($matchList as &$match):
                $id = $match->getDate();
                $id = str_replace(" ", "", $id);
                ?>
                <tr class="match-row" id="<?php echo $id?>">
                    <td><span> <?php echo $match->getDate()?> </span></td>
                    <td class="no-mobile-col"><span> <?php echo $match->getTime()?> </span></td>
                    <?php if ($getTotal): ?>
                        <td class="no-mobile-col"><span> <?php echo $match->getTournamentName()?> </span></td>
                    <?php endif; ?>
                    <td class="no-mobile-col"><span> <?php echo $match->getLocation()?> </span></td>
                    <td><span> <?php echo $match->getOpposition()?> </span></td>
                    <td><span> <?php echo $match->getResult()?></span></td>
                    <td class="no-mobile-col"><span> <?php echo $match->getOutcome()?> </span></td>
                </tr>
            <?php
            endforeach;
        endif;
        ?>
        <?php
        $oppositionList = $realMadrid->getOppositionsList($tournamentName, $getTotal);
        if (count($oppositionList) != 0):
            foreach ($oppositionList as &$opposition):
                ?>
                <tr class="no-hover">
                    <td><?php echo $opposition->getDate()?></td>
                    <td class="no-mobile-col"><?php echo $opposition->getTime()?></td>
                    <?php if ($getTotal): ?>
                        <td class="no-mobile-col"><?php echo $opposition->getTournamentName()?></td>
                    <?php endif; ?>
                    <td class="no-mobile-col"><?php echo $opposition->getLocation()?></td>
                    <td><?php echo $opposition->getOpposition()?></td>
                    <td><?php echo " - "?></td>
                    <td class="no-mobile-col"><?php echo " - "?></td>
                </tr>
            <?php
            endforeach;
        endif;
        ?>
        </tbody>
    </table>
</section>