$(document).ready(function(){
    //INDEX PAGE
    //Status drop down
    $('.quantity-selector-inner').css({cursor:'pointer'}).click(function(){
        $(this).parent('div').prev('input').val($(this).find('.quantity-selector-title').text());
        //$('#status').val($(this).find('.quantity-selector-title').text());
        $('body').click();
    })



    //RESULTS PAGE
    //Search button
    $('#search-button').click(function(){
        var location = $('#location').val();
        var type = $('#type').val();
        var ownership = $('#ownership').val();

        //Prices
        var prices = 'price[min]=' + $('#price-slider').data('from') + '&price[max]=' + $('#price-slider').data('to');

        //Get all checkboxes
        var checkboxes = '';
        $('.search-options').each(function(i){
            if($(this).prop('checked')){
                var name = $(this).data('name');
                var split = name.split('-');
                checkboxes += split[0] +'[]='+ split[1] +'&';
            }
        });
        
        window.location = 'results.php?location='+location+'&type='+type+'&ownership='+ownership+'&'+prices+'&'+checkboxes;
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
    /*$('#add-button').click(function(){
        if($('#firstname').val() == ''){
            $('#firstname').css({border:'1px solid red'})
            return
        }else $('#firstname').css({border:'1px solid #CCC'})
        
        if($('#lastname').val() == ''){
            $('#lastname').css({border:'1px solid red'})
            return
        }else $('#lastname').css({border:'1px solid #CCC'})

        if($('#email').val() == ''){
            $('#email').css({border:'1px solid red'})
            return
        }else $('#email').css({border:'1px solid #CCC'})
        
        if($('#phone').val() == ''){
            $('#phone').css({border:'1px solid red'})
            return
        }else $('#phone').css({border:'1px solid #CCC'})

        console.log($('#firstname').val());

        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var phone = $('#phone').val();

        $('#details-entry-none').remove();
        $('#details-entry').append('<option>'+firstname+' '+lastname+' , '+email+' , '+phone+'</option>')

    });*/
    
    $('#book-now').click(function(){
        if($('#details-entry-none').length)
        alert('You need to enter your details')

        $.ajax({url:'submit.php',method:'post'
        ,success:function(){
            
        },error:function(){
            
        }})
    });

    /*
    var date = (new Date());
    var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    var month = date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1;
    var day = date.getDate() < 10 ? '0'+date.getDate() : date.getDate();
    $('#checkin-start').attr('value',days[date.getDay()]+' '+month+'/'+day);
    $('#checkin-end').attr('value',days[date.getDay()]+' '+month+'/'+day);
    
    var startTimestamp = 0;
    var endTimestamp = 0;
    $('#checkin-start').on('dp.change',function(e){
        var date = (new Date());
        console.log(date)
        var year = date.getFullYear();
        var date =  $(this).val().split(' ');
        var month = date[1].split('/')[0];
        var day = date[1].split('/')[1];
        startTimestamp = (new Date(year+'-'+month+'-'+day)).getTime() / 1000;
        console.log((new Date(year+'-'+month+'-'+day)),startTimestamp)

        var diff = Math.ceil(Math.abs(endTimestamp - startTimestamp));
        if(typeof diff == 'number'){
            var days = (diff / (60*60*24));
            $('#total-duration').html(days + ' days');
            $('#property-price').html('$'+($('#total-duration').data('price') * days));
        }
    });

    $('#checkin-end').on('dp.change',function(){
        var date = (new Date());
        var year = date.getFullYear();
        var date =  $(this).val().split(' ');
        var month = date[1].split('/')[0];
        var day = date[1].split('/')[1];
        endTimestamp = (new Date(year+'-'+month+'-'+day)).getTime() / 1000;

        var diff = Math.ceil(Math.abs(endTimestamp - startTimestamp));
        if(typeof diff == 'number'){
            var days = (diff / (60*60*24));
            $('#total-duration').html(days + ' days');
            $('#property-price').html('$'+($('#total-duration').data('price') * days));
        }
    });
    */
});