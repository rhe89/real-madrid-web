var goals = $(".goals");
var matches = $(".matches");
var assists = $(".assists");
var thirdAssists = $(".third-assists");
var yellowCards = $(".yellow-cards");
var redCards = $(".red-cards");

var matchEvents = [goals, matches, assists, thirdAssists, yellowCards, redCards];

function selectEvent() {
    var selectedEvent = document.getElementById("select-event").value;

    if (selectedEvent == "matches") showMatches();
    else if (selectedEvent == "goals") showGoals();
    else if (selectedEvent == "assists") showAssists();
    else if (selectedEvent == "third-assists") showThirdAssists();
    else if (selectedEvent == "yellow-cards") showYellowCards();
    else if (selectedEvent == "red-cards") showRedCards();
}

function showGoals() {
    goals.toggleClass("hidden", false);

    var i;

    for (i = 0; i < matchEvents.length; i++) {
        if (matchEvents[i] != goals) {
            matchEvents[i].toggleClass("hidden", true);
        }
    }
}
function showAssists() {
    assists.toggleClass("hidden", false);

    var i;
    for (i = 0; i < matchEvents.length; i++) {
        if (matchEvents[i] != assists) {
            matchEvents[i].toggleClass("hidden", true);
        }
    }
}

function showThirdAssists() {
    thirdAssists.toggleClass("hidden", false);

    var i;
    for (i = 0; i < matchEvents.length; i++) {
        if (matchEvents[i] != thirdAssists) {
            matchEvents[i].toggleClass("hidden", true);
        }
    }
}

function showMatches() {
    matches.toggleClass("hidden", false);

    var i;
    for (i = 0; i < matchEvents.length; i++) {
        if (matchEvents[i] != matches) {
            matchEvents[i].toggleClass("hidden", true);
        }
    }
}

function showYellowCards() {
    yellowCards.toggleClass("hidden", false);
    var i;

    for (i = 0; i < matchEvents.length; i++) {
        if (matchEvents[i] != yellowCards) {
            matchEvents[i].toggleClass("hidden", true);
        }
    }
}

function showRedCards() {
    redCards.toggleClass("hidden", false);

    var i;
    for (i = 0; i < matchEvents.length; i++) {
        if (matchEvents[i] != redCards) {
            matchEvents[i].toggleClass("hidden", true);
        }
    }
}