
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
        var phone = $('#phone').val();
        var message = $('#message').val();

        if(firstname && lastname && email && phone && message){
            $.ajax({
                url: 'inquiry.php',
                method: 'POST',
                data: {firstname: firstname, lastname: lastname, email: email, phone: phone, message: message},
                dataType: 'json',
                success: function (data) {
                    if(typeof data.success != 'undefined' && data.success){
                        alert('Successfully saved your inquiry. You will be contacted shortly.');
                    }else{
                        
                    }
                },
                error: function(response){
                    alert('An error occured. Try again.');
                    console.log(response.responseText)
                }
            });
        }else{
            if(!firstname)$('#firstname').parents('.theme-search-area-section-inner').css({border: '1px solid red'});
            if(!lastname)$('#lastname').parents('.theme-search-area-section-inner').css({border: '1px solid red'});
            if(!email)$('#email').parents('.theme-search-area-section-inner').css({border: '1px solid red'});
            if(!phone)$('#phone').parents('.theme-search-area-section-inner').css({border: '1px solid red'});
            if(!message)$('#message').parents('.theme-search-area-section-inner').css({border: '1px solid red'});
        }
    });
    $('#firstname,#lastname,#email,#phone,#message').keyup(function(){
        if(!$(this).val())
        $(this).parents('.theme-search-area-section-inner').css({border: '1px solid red'});
        else
        $(this).parents('.theme-search-area-section-inner').css({border: '1px solid #d9d9d9'});
    })
    
    
    .val('Ok');
    
});