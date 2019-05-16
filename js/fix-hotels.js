$(document).ready(function(){
    //Search button
    $('#search-button').click(function(){
        var location = $('#location').val();
        var checkin = $('#checkin').val();
        var checkout = $('#checkout').val();
        var room = $('#room').val();
        var guest = $('#guest').val();
        window.location = 'results.php?location='+location+'&checkin='+checkin+'&checkout='+checkout+'&room='+room+'&guest='+guest;
    });
});