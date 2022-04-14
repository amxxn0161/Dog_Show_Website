$(document).ready(function(){

    $.get("controllers/populate.php", function(data, status){
        $("#header1").text('Welcome to Poppleton Dog Show! This year ' + data.owners + ' owners entered ' + data.dogs + ' dogs in ' + data.events + '\n' +
            '    events!');
        // populates the table with data for the leaderboard
        let leaderboard = data.top10;
        for (var i = leaderboard.length - 1; i >= 0; i--) {
            $('#leaderboard tr:last').after('<tr><td>' + leaderboard[i].name + '</td><td>' + leaderboard[i].breed + '</td><td>' + leaderboard[i].score + '</td><td>' + '<a href="owner.php?owner_id=' + leaderboard[i].owner_id + '">' + leaderboard[i].owner_name + '</a>' + '</td><td>' + '<a href="mailto:' + leaderboard[i].owner_email + '">' + leaderboard[i].owner_email + '</a>' + '</td></tr>');
        }
    });

});