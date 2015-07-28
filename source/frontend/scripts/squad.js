var firstTeam = $("#firstTeam");
var castilla = $("#castilla");
var loanedOut = $("#loanedOut");

var squads = [firstTeam, castilla, loanedOut];

function selectSquad() {
    var selectedSquad = $("#select-squad").val();
    var squadName = $("#select-squad option:selected").text();

    if (selectedSquad == "first-team") showSquad(firstTeam, squadName);
    else if (selectedSquad == "castilla") showSquad(castilla, squadName);
    else if (selectedSquad == "loaned-out") showSquad(loanedOut, squadName);
}

function showSquad(squad, squadName) {
    squad.toggleClass("hidden", false);

    var headline = $('#headline');

    var siteName = headline.text().slice(0, headline.text().indexOf("-"));

    headline.text(siteName + " - " + squadName);

    for (var i = 0; i < squads.length; i++) {
        if (squads[i] != squad) {
            squads[i].toggleClass("hidden", true);
        }
    }
}
