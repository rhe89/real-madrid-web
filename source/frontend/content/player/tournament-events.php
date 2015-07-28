<table class="table table-hover table table-hover matches">
  <?php
  $matchesPlayed = $player->getEvent("matches", $tournamentName, $getTotal);
  ?>
  <thead>
  <tr>
    <th class="center-td-content no-mobile-col">Date</th>
    <?php if ($getTotal): ?>
      <th class="center-td-content no-mobile-col">Tournament</th>
    <?php endif;?>
    <th class="center-td-content no-mobile-col">Location</th>
    <th class="center-td-content">Opposition</th>
    <th class="center-td-content no-mobile-col">Result</th>
    <th class="center-td-content">Min.</th>
    <th class="font-awesome center-td-content" id="goal-icon">&#xf1e3;</th>
    <th class="center-td-content">Assists</th>
    <th class="center-td-content no-mobile-col">Third assists</th>
    <th class="center-td-content font-awesome" id="yellow-card-icon">&#xf0c8;</th>
    <th class="center-td-content font-awesome" id="red-card-icon">&#xf0c8;</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($matchesPlayed as &$match):
    $matchObj = $realMadrid->getMatch($match["date"]);
    $id = $match["date"];
    $id = str_replace(" ", "", $id);
    ?>

    <tr class="match-row" id="<?php echo$id?>">
      <td class="center-td-content no-mobile-col"> <span><?php echo$match["date"]; ?></span></td>
      <?php if ($getTotal): ?>
        <td class="center-td-content no-mobile-col"><span><?php echo$match["tournamentName"]; ?></span></td>
      <?php endif;?>
      <td class="center-td-content no-mobile-col"><span><?php echo$matchObj->getLocation() ?></span></td>
      <td class="center-td-content"><span><?php echo$match["opposition"]; ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$matchObj->getResult() ?></span></td>
      <td class="center-td-content"><span><?php echo$match["minutesPlayed"]; ?></span></td>
      <td class="center-td-content"><span><?php echo$match["goals"]; ?></span></td>
      <td class="center-td-content"><span><?php echo$match["assists"]; ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$match["thirdAssists"]; ?></span></td>
      <td class="center-td-content"><span><?php echo$match["yellowCards"]; ?></span></td>
      <td class="center-td-content"><span><?php echo$match["redCards"]; ?></span></td>
    </tr>
  <?php endforeach; ?>
  </tbody>

</table>

<table class="table table-hover goals hidden">
  <?php
  $goals = $player->getEvent("goalscorer", $tournamentName, $getTotal);
  ?>
  <thead>
  <tr>
    <th class="center-td-content">Date</th>
    <?php if ($getTotal): ?>
      <th class="center-td-content no-mobile-col">Tournament</th>
    <?php endif;?>
    <th class="center-td-content no-mobile-col">Location</th>
    <th class="center-td-content">Opposition</th>
    <th class="center-td-content">Result</th>
    <th class="center-td-content no-mobile-col">Min.</th>
    <th class="center-td-content no-mobile-col">Type</th>
    <th class="center-td-content no-mobile-col">Location</th>
    <th class="center-td-content no-mobile-col">Body part</th>
    <th class="center-td-content no-mobile-col">Touches</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($goals as &$goal):
    $matchObj = $realMadrid->getMatch($goal["date"]);
    $id = $goal["date"];
    $id = str_replace(" ", "", $id);
    ?>

    <tr class="match-row" id="<?php echo$id?>">
      <td class="center-td-content"><span><?php echo$goal["date"]; ?></span></td>
      <?php if ($getTotal): ?>
        <td class="center-td-content no-mobile-col"><span><?php echo$goal["tournamentName"]; ?></span></td>
      <?php endif;?>
      <td class="center-td-content no-mobile-col"><span><?php echo$matchObj->getLocation() ?></span></td>
      <td class="center-td-content"><span><?php echo$goal["opposition"]; ?></span></td>
      <td class="center-td-content"><span><?php echo$matchObj->getResult() ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$goal["minute"]; ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$goal["type"]; ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$goal["goalLocation"]; ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$goal["bodypart"]; ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$goal["touches"]; ?></span></td>
    </tr>
  <?php endforeach; ?>

  </tbody>

</table>

<table class="table table-hover assists hidden">
  <?php
  $assists = $player->getEvent("assist", $tournamentName, $getTotal);
  ?>
  <thead>
  <tr>
    <th class="center-td-content">Date</th>
    <?php if ($getTotal): ?>
      <th class="center-td-content no-mobile-col">Tournament</th>
    <?php endif;?>
    <th class="center-td-content no-mobile-col">Location</th>
    <th class="center-td-content">Opposition</th>
    <th class="center-td-content">Result</th>
    <th class="center-td-content no-mobile-col">Min.</th>
    <th class="center-td-content no-mobile-col">Assisted</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($assists as &$assist):
    $matchObj = $realMadrid->getMatch($assist["date"]);
    $id = $assist["date"];
    $id = str_replace(" ", "", $id);
    ?>

    <tr class="match-row" id="<?php echo$id?>">
      <td class="center-td-content"><span><?php echo$assist["date"]; ?></span></td>
      <?php if ($getTotal): ?>
        <td class="center-td-content no-mobile-col"><span><?php echo$assist["tournamentName"]; ?></span></td>
      <?php endif;?>
      <td class="center-td-content no-mobile-col"><span><?php echo$matchObj->getLocation() ?></span></td>
      <td class="center-td-content"><span><?php echo$assist["opposition"]; ?></span></td>
      <td class="center-td-content"><span><?php echo$matchObj->getResult() ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$assist["minute"]; ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$assist["goalscorer"]; ?></span></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<table class="table table-hover third-assists hidden">
  <?php
  $thirdAssists = $player->getEvent("thirdAssist", $tournamentName, $getTotal);
  ?>
  <thead>
  <tr>
    <th class="center-td-content">Date</th>
    <?php if ($getTotal): ?>
      <th class="center-td-content no-mobile-col">Tournament</th>
    <?php endif;?>
    <th class="center-td-content no-mobile-col">Location</th>
    <th class="center-td-content">Opposition</th>
    <th class="center-td-content">Result</th>
    <th class="center-td-content no-mobile-col">Min.</th>
    <th class="center-td-content no-mobile-col">Assisted</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($thirdAssists as &$thirdAssist):
    $matchObj = $realMadrid->getMatch($thirdAssist["date"]);

    $id = $thirdAssist["date"];
    $id = str_replace(" ", "", $id);
    ?>

    <tr class="headline match" id="<?php echo$id?>">
      <td class="center-td-content"><span><?php echo$thirdAssist["date"]; ?></span></td>
      <?php if ($getTotal): ?>
        <td class="center-td-content no-mobile-col"><span><?php echo$thirdAssist["tournamentName"]; ?></span></td>
      <?php endif;?>
      <td class="center-td-content no-mobile-col"><span><?php echo$matchObj->getLocation() ?></span></td>
      <td class="center-td-content"><span><?php echo$thirdAssist["opposition"]; ?></span></td>
      <td class="center-td-content"><span><?php echo$matchObj->getResult() ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$thirdAssist["minute"]; ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$thirdAssist["goalscorer"]; ?></span></td>
    </tr>
  <?php endforeach; ?>
  </tbody>

</table>

<table class="table table-hover yellow-cards hidden">
  <?php
  $yellowCards = $player->getEvent("Yellow", $tournamentName, $getTotal);
  ?>
  <thead>
  <tr>
    <th class="center-td-content">Date</th>
    <?php if ($getTotal): ?>
      <th class="center-td-content no-mobile-col">Tournament</th>
    <?php endif;?>
    <th class="center-td-content no-mobile-col">Location</th>
    <th class="center-td-content">Opposition</th>
    <th class="center-td-content">Result</th>
    <th class="center-td-content no-mobile-col">Min.</th>
    <th class="center-td-content no-mobile-col">Cause</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($yellowCards as &$yellowCard):
    $matchObj = $realMadrid->getMatch($yellowCard["date"]);
    $id = $yellowCard["date"];
    $id = str_replace(" ", "", $id);
    ?>
    <tr class="headline match" id="<?php echo$id?>">
      <td class="center-td-content"><span><?php echo$yellowCard["date"]; ?></span></td>
      <?php if ($getTotal): ?>
        <td class="center-td-content no-mobile-col"><span><?php echo$yellowCard["tournamentName"]; ?></span></td>
      <?php endif;?>
      <td class="center-td-content no-mobile-col"><span><?php echo$matchObj->getLocation() ?></span></td>
      <td class="center-td-content"><span><?php echo$yellowCard["opposition"]; ?></span></td>
      <td class="center-td-content"><span><?php echo$matchObj->getResult() ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$yellowCard["minute"]; ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$yellowCard["cause"]; ?></span></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<table class="table table-hover red-cards hidden">
  <?php
  $redCards = $player->getEvent("Red", $tournamentName, $getTotal);
  ?>
  <thead>
  <tr>
    <th class="center-td-content">Date</th>
    <?php if ($getTotal): ?>
      <th class="center-td-content no-mobile-col">Tournament</th>
    <?php endif;?>
    <th class="center-td-content no-mobile-col">Location</th>
    <th class="center-td-content">Opposition</th>
    <th class="center-td-content">Result</th>
    <th class="center-td-content no-mobile-col">Min.</th>
    <th class="center-td-content no-mobile-col">Cause</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($redCards as &$redCard):
    $matchObj = $realMadrid->getMatch($redCard["date"]);
    $id = $redCard["date"];
    $id = str_replace(" ", "", $id);
    ?>

    <tr class="match-row" id="<?php echo$id?>">
      <td class="center-td-content"><span><?php echo$redCard["date"]; ?></span></td>
      <?php if ($getTotal): ?>
        <td class="center-td-content no-mobile-col"><span><?php echo$redCard["tournamentName"]; ?></span></td>
      <?php endif;?>
      <td class="center-td-content no-mobile-col"><span><?php echo$matchObj->getLocation() ?></span></td>
      <td class="center-td-content"><span><?php echo$redCard["opposition"]; ?></span></td>
      <td class="center-td-content"><span><?php echo$matchObj->getResult() ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$redCard["minute"]; ?></span></td>
      <td class="center-td-content no-mobile-col"><span><?php echo$redCard["cause"]; ?></span></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>