
<div id="wrapper">
    <button id="sidebar-toggle" type="button" class="btn btn-default" aria-label="Left Align">
        <span class="glyphicon glyphicon-align-left" aria-hidden="true"> Menu </span>
    </button>
    <nav id="sidebar-wrapper">
        <ul class="container sidebar-nav ">

            <li class="sidebar-brand"><a>Real Madrid statistics</a></li>

            <li id="home"><a href="/realmadrid/index.php">Home</a ></li>
            <li id="fixtures" class="active"><a href="/realmadrid/fixtures/index.php">Fixtures</a></li>
            <li id="squad"><a href="/realmadrid/squad/index.php">Squad</a></li>
            <li id="player-stats"><a href="/realmadrid/player-stats/index.php">Player stats</a></li>
            <li id="leaderboards"><a href="/realmadrid/leaderboards/index.php">Leaderboards</a></li>

            <li class="divider"></li>
            <li>
                <article>
                    <h4>Choose season</h4>
                    <select id="select-season" class="form-control" onchange="selectSeason()">
                        <option value="2014_2015" <?php if ($realMadrid->getSeason() == "2014_2015") echo "selected='true'";?>>2014/2015</option>
                        <option value="2015_2016" <?php if ($realMadrid->getSeason() == "2015_2016") echo "selected='true'";?>>2015/2016</option>
                    </select>
                    <?php if($selectType == 'tournament'): ?>
                    <h4>Choose tournament</h4>
                    <select id="select-tournament" class="form-control" onchange="selectTournament()">
                        <option value="total">All tournaments</option>
                        <option value="laLiga">La Liga</option>
                        <option value="championsLeague">Champions League</option>
                        <option value="copaDelRey">Copa del Rey</option>
                    </select>
                    <?php elseif ($selectType == 'squad'):?>
                    <h4>Choose squad</h4>
                    <select id="select-squad" class="form-control input-large" onchange="selectSquad()">
                        <option value="first-team">First team</option>
                        <option value="castilla">Castilla</option>
                        <option value="loaned-out">Loaned out</option>
                    </select>
                    <?php endif;?>
                </article>
            </li>
            <li class="footer">
                <a href="http://localhost:8888/realmadrid/admin/index.php">Admin</a>
                <p>Made by Roar Eriksen</p>
                <p>All images of players are</p>
                <p>in courtesy of realmadrid.com</p>
            </li>
        </ul>
    </nav>
</div>