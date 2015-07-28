<table class ="<?php echo $hidden . " " . $id?> table table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Number</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($leaderboard as &$player):
        $id = $player["name"];
        ?>

        <tr class ="leaderboard-row <?php echo $id?> ">
            <td><span> <?php echo $player["pos"]; ?></span></td>
            <td><span> <?php echo $player["name"]; ?></span></td>
            <td><span> <?php echo $player["number"]; ?></span></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>