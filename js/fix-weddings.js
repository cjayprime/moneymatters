
$(document).ready(function(){
    //INDEX PAGE & RESULTS PAGE
    //Search button
    $('#search-button').click(function(){
        var location = $('#location').val();

        var date = $("#from").data("DateTimePicker").date();
        var date = new Date(date._d.getTime() + (60*60*1000));
        var from = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate()// + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
        
        var date = $("#to").data("DateTimePicker").date();
        var date = new Date(date._d.getTime() + (60*60*1000));
        var to = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate()// + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
        
        //Title
        var title = $('#title').length ? $('#title').val() : '';

        //Get all checkboxes
        var checkboxes = '';
        $('.search-options').each(function(i){
            if($(this).prop('checked')){
                var name = $(this).data('name');
                var split = name.split('-');
                checkboxes += split[0] +'[]='+ split[1] +'&';
            }
        });

        window.location = 'results.php?location='+location+'&from='+from+'&to='+to+'&title='+title+'&'+checkboxes;
    });


    //RESULTS PAGE
    

    //LISTING PAGE
    $('#submit').click(function(){
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var message = $('#message').val();

        console.log(firstname,lastname,email,message)
        //window.location = 'payment.php?id='+id+'&firstname='+firstname+'&lastname='+lastname+'&email='+email+'&phone='+phone;
    });
    
});