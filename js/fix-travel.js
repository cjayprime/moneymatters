$(document).ready(function(){
    //Search button
    $('#search-button').click(function(){
        var oneway = $('#flight-option-1').prop('checked') ? 'round-trip' : 'one-way';
        var departure = $('#departure').val();
        var arrival = $('#arrival').val();
        var checkin = $('#checkin').val();
        var checkout = $('#checkout').val();
        var passenger = $('#passenger').val();
        window.location = 'results.php?oneway='+oneway+'&departure='+departure+'&arrival='+arrival+'&checkin='+checkin+'&checkout='+checkout+'&passenger='+passenger;
    });
});