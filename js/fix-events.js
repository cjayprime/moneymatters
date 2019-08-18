
$(document).ready(function(){
    //INDEX PAGE & RESULTS PAGE
    //Search button
    $('#search-button').click(function(){
        var location = $('#location').val();
        var guests = parseInt($('#guests').val());

        var date = $("#from").data("DateTimePicker").date();
        var date = new Date(date._d.getTime() + (60*60*1000));
        var from = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
        
        var date = $("#to").data("DateTimePicker").date();
        var date = new Date(date._d.getTime() + (60*60*1000));
        var to = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
        
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
        
        if(firstname && lastname && email && phone){
            window.location = 'payment.php?id='+id+'&firstname='+firstname+'&lastname='+lastname+'&email='+email+'&phone='+phone;
        }else{
            if(!firstname)$('#firstname').parents('.theme-search-area-section-inner').css({border: '1px solid red'});
            if(!lastname)$('#lastname').parents('.theme-search-area-section-inner').css({border: '1px solid red'});
            if(!email)$('#email').parents('.theme-search-area-section-inner').css({border: '1px solid red'});
            if(!phone)$('#phone').parents('.theme-search-area-section-inner').css({border: '1px solid red'});
        }
    });
    $('#firstname,#lastname,#email,#phone').keyup(function(){
        if(!$(this).val())
        $(this).parents('.theme-search-area-section-inner').css({border: '1px solid red'});
        else
        $(this).parents('.theme-search-area-section-inner').css({border: '1px solid #d9d9d9'});
    });
    





    //PAYMENT PAGE
    MoneyMatters.platform = 'event';

    $('#book-now').click(function(e){
        e.preventDefault();
        var details = {
            identification: $('#identification').val(),
            key: MoneyMatters.keys[MoneyMatters.platform], 
            email: $('#email').val(), 
            amount: $('#amount').data('value') * 100, 
            firstname: $('#firstname').val(), 
            lastname: $('#lastname').val(), 
            phone: $('#phone').val()
        };
        console.log(details);

        if( details.identification && details.key && details.email && details.amount && details.firstname && details.lastname && details.phone )
        MoneyMatters.payWithPayStack(details);
    });
});