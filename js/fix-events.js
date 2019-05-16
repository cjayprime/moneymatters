
$(document).ready(function(){
    //INDEX PAGE & RESULTS PAGE
    //Search button
    $('#search-button').click(function(){
        var location = $('#location').val();
        var guests = parseInt($('#guests').val());

        var date = $("#from").data("DateTimePicker").date();
        var date = new Date(date._d.getTime() + (60*60*1000));
        var from = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate()// + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
        
        var date = $("#to").data("DateTimePicker").date();
        var date = new Date(date._d.getTime() + (60*60*1000));
        var to = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate()// + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
        
        //Title
        var title = $('#title').val();

        //Prices
        var prices = 'price[min]=' + $('#price-slider').data('from') + '&price[max]=' + $('#price-slider').data('to');

        //Duration
        var duration = 'duration[min]=' + $('#duration').data('from') + '&duration[max]=' + $('#duration').data('to');

        //Get all checkboxes
        var checkboxes = '';
        $('.search-options').each(function(i){
            if($(this).prop('checked')){
                var name = $(this).data('name');
                var split = name.split('-');
                checkboxes += split[0] +'[]='+ split[1] +'&';
            }
        });

        window.location = 'results.php?location='+location+'&from='+from+'&to='+to+'&guests='+guests+'&title='+title+'&'+prices+'&'+duration+'&'+checkboxes;
    });

    //RESULTS PAGE
    $("#duration").ionRangeSlider({
        type: "double",
        postfix: " hours",
        onChange: function (data) {
            var from = data.from;
            var to = data.to;
            $("#price-slider").attr({'data-from':from,'data-to':to});
        }
    });




    //LISTING PAGE
    $('#book').click(function(){
        var id = $('#total-booking').data('id');
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        
        window.location = 'payment.php?id='+id+'&firstname='+firstname+'&lastname='+lastname+'&email='+email+'&phone='+phone;
    });
    





    //PAYMENT PAGE
    if($('#details-entry-none').length)
    $('.theme-payment-page-sections-item-new-link').eq(0).click();
    
    $('#book-now').click(function(){
        if($('#details-entry-none').length)
        alert('You need to enter your details')

        $.ajax({url:'submit.php',method:'post'
        ,success:function(){
            
        },error:function(){
            
        }})
    });

});