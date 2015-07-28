function selectSeason() {
    var selectedSeason = document.getElementById("select-season").value;

    document.location.href = "/realmadrid/index.php?season="+selectedSeason;
}

$("#sidebar-toggle").click(function () {
    $("#wrapper").toggleClass('toggled');
})

$(".player-row").click(function () {
        var id = $(this).prop('id');
        document.location.href = "/realmadrid/player/index.php?playerID=" + id;
    }
);

$(".leaderboard-row").click(function () {
        var id = $(this).attr('class');
        id = id.substr("leaderboard-row".length + 1, id.length);
        document.location.href = "/realmadrid/player/index.php?playerID=" + id;
    }
);

$(".match-row").click(function () {
        var id = $(this).prop('id');
        document.location.href = "/realmadrid/match/index.php?matchID=" + id;
    }
);

var laLiga = $("#laLiga");
var championsLeague = $("#championsLeague");
var copaDelRey = $("#copaDelRey");
var total = $("#total");

var tournaments = [laLiga, championsLeague, copaDelRey, total];

function selectTournament() {
    var selectedTournament = $("#select-tournament").val();
    var tournamentName = $("#select-tournament option:selected").text();

    if (selectedTournament == "laLiga") showTournament(laLiga, tournamentName);
    else if (selectedTournament == "championsLeague") showTournament(championsLeague, tournamentName);
    else if (selectedTournament == "copaDelRey") showTournament(copaDelRey, tournamentName);
    else if (selectedTournament == "total") showTournament(total, tournamentName);
}

function showTournament(selectedTournament, tournamentName) {
    selectedTournament.toggleClass("hidden", false);

    var headline = $('#headline');

    var siteName = headline.text().slice(0, headline.text().indexOf("-"));

    headline.text(siteName + " - " + tournamentName);

    for (var i = 0; i < tournaments.length; i++) {
        if (tournaments[i] != selectedTournament) {
            tournaments[i].toggleClass("hidden", true);
        }
    }
}