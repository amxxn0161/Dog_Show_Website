$(document).ready(function(){

    $.get("controllers/dogOwner.php", {owner_id: owner_id}, function(data, status){
        // if no data present then redirect
        if (!data) {
            window.location.replace("index.php");
        }
        $('#owner_name').text("Owner name: " + data.name);
        $('#owner_address').text("Owner address: " + data.address);
        $('#owner_email').text("Owner email: " + data.email);
        $('#owner_phone').text("Owner phone: " + data.phone);
    });

});