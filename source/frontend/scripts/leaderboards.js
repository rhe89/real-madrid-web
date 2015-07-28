var goals = $(".goals");
var matches = $(".matches");
var minutes = $(".minutes");
var subbedOff = $(".subbed-off");
var subbedOn = $(".subbed-on");
var assists = $(".assists");
var thirdAssists = $(".third-assists");
var yellowCards = $(".yellow-cards");
var redCards = $(".red-cards");

var leaderboardTables = [goals, matches, minutes, subbedOff, subbedOn, assists, thirdAssists, yellowCards, redCards];

function selectLeaderboard() {
    var selectedLeaderboard = document.getElementById("select-leaderboard").value;

    if (selectedLeaderboard == "matches") showLeaderboard(matches);
    else if (selectedLeaderboard == "subbed-on") showLeaderboard(subbedOn);
    else if (selectedLeaderboard == "subbed-off") showLeaderboard(subbedOff);
    else if (selectedLeaderboard == "minutes") showLeaderboard(minutes);
    else if (selectedLeaderboard == "goals") showLeaderboard(goals);
    else if (selectedLeaderboard == "assists") showLeaderboard(assists);
    else if (selectedLeaderboard == "third-assists") showLeaderboard(thirdAssists);
    else if (selectedLeaderboard == "yellow-cards") showLeaderboard(yellowCards);
    else if (selectedLeaderboard == "red-cards") showLeaderboard(redCards);
}

function showLeaderboard(leaderboardToShow) {
    leaderboardToShow.toggleClass("hidden", false);

    var i;

    for (i = 0; i < leaderboardTables.length; i++) {
        if (leaderboardTables[i] != leaderboardToShow) {
            leaderboardTables[i].toggleClass("hidden", true);
        }
    }
}