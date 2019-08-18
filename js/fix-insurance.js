$(document).ready(function(){
    function findGetParameter(parameterName) {
        var result = '',
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
                tmp = item.split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            });
        return result;
    }
      
    //INDEX PAGE
    $('.quantity-selector-title').click(function(){
        var box = $(this).parents('.quantity-selector-box');
        
        // Set text
        var input = box.prev('input');
        input.val($(this).find('span').text());
        
        // Get icon of clicked selection
        var fa = $(this).children('i.fa');
        var fac = fa[0].className.split(' ');
        var selectedFa = '';
        for(var i = 0; i < fac.length; i++){
            if(/^fa\-/.test(fac[i])){
                selectedFa = fac[i];
            }
        }

        // Get icon of input element
        var fa = box.prevAll('i.fa');
        var fac = fa[0].className.split(' ');
        var removeFa = '';
        for(var i = 0; i < fac.length; i++){
            if(/^fa\-/.test(fac[i])){
                removeFa = fac[i];
            }
        }
        
        // Set icon
        box.prevAll('i.fa').removeClass(removeFa).addClass(selectedFa);
    });

    
    //Search for insurance
    $('.search').click(function(){
        var category = $(this).data('category');
        var box = $('#'+category+'InsuranceModal');
        
        var firstname = box.find('.firstname').val();
        var lastname = box.find('.lastname').val();
        var email = box.find('.email').val();
        var phone = box.find('.phone').val();
        var address = box.find('.address').val();
        var type = box.find('.type').val();
        var quantity = box.find('.quantity').val();
        var item = box.find('.item').prop('checked') ? 'true' : 'false';

        var extras = '';
        if(category == 'travel'){
            category = 'Travel Insurance';
            extras = '&destination=' + box.find('.destination').val();
        }else if(category == 'motor'){
            category = 'Motor Insurance';
            extras = '&vehicle_chasis=' + box.find('.chasis').val() + 
                     '&vehicle_engine=' + box.find('.engine').val() + 
                     '&vehicle_type=' + box.find('.vehicle_type').val() + 
                     '&vehicle_value=' + box.find('.value').val() +
                     '&vehicle_registration=' + box.find('.registration').val();
        }else if(category == 'home'){
            category = 'Householders/Homeowners\' Insurance';
            extras = '&business=' + box.find('.business').val();
        }else if(category == 'fire'){
            category = 'Fire & Special Perils Insurance';
            extras = '&duration=' + box.find('.duration').val();
        }else if(category == 'risk'){
            category = 'All Risks Insurance';
            extras = '&duration=' + box.find('.duration').val();
        }else if(category == 'personal'){
            category = 'Personal Insurance';
        }else if(category == 'life'){
            category = 'Life Assurance';
        }else if(category == 'burglary'){
            category = 'Burglary or Theft Insurance';
        }

        window.location = 'results.php?category='+category+'&firstname='+firstname+'&lastname='+lastname+'&email='+email+'&phone='+phone+'&address='+address+'&type='+type+'&quantity='+quantity+'&item='+item+''+extras;
    });





    //RESULTS PAGE
    var checkbox2radio = function(){
        var that = $(this);
        setTimeout(function(){
            $('.iCheck-helper')
            .off('click.checkbox2radio')
            .each(function(){
                if($(this).prev('input').prop('checked'))
                $(this).click();
            });
            
            that.click();
            
            $('.iCheck-helper').on('click.checkbox2radio',checkbox2radio);
        },100);
    };
    $('.iCheck-helper')
    .on('click.checkbox2radio',checkbox2radio);


    //Search button
    $('#search-button').click(function(e){
        //Old get parameters
        var category = findGetParameter('category');
        var firstname = findGetParameter('firstname');
        var lastname = findGetParameter('lastname');
        var email = findGetParameter('email');
        var phone = findGetParameter('phone');
        var address = findGetParameter('address');
        var quantity = findGetParameter('quantity');
        var item = findGetParameter('item');

        console.log(category)
        
        if(category == 'Travel Insurance'){
            extras = '&destination=' + findGetParameter('destination');
        }else if(category == 'Motor Insurance'){
            extras = '&vehicle_chasis=' + findGetParameter('vehicle_chasis') + 
                     '&vehicle_engine=' + findGetParameter('vehicle_engine') + 
                     '&vehicle_type=' + findGetParameter('vehicle_type') + 
                     '&vehicle_value=' + findGetParameter('vehicle_value') +
                     '&vehicle_registration=' + findGetParameter('vehicle_registration');
        }else if(category == 'Householders/Homeowners\' Insurance'){
            extras = '&business=' + findGetParameter('business');
        }else if(category == 'Fire & Special Perils Insurance'){
            extras = '&duration=' + findGetParameter('duration');
        }else if(category == 'All Risks Insurance'){
            extras = '&duration=' + findGetParameter('duration');
        }else if(category == 'Personal Insurance'){
        }else if(category == 'Life Assurance'){
        }else if(category == 'Burglary or Theft Insurance'){
        }

        //Prices
        var prices = 'price[min]=' + $('#price-slider').data('from') + '&price[max]=' + $('#price-slider').data('to');

        //Get all checkboxes
        var checkboxes = '';
        $('.search-options').each(function(i){
            if($(this).prop('checked')){
                var name = $(this).data('name');
                var split = name.split('-');
                checkboxes += split[0] +'='+ split[1] +'&';
            }
        });
        
        window.location = 'results.php?'+'category='+category+'&firstname='+firstname+'&lastname='+lastname+'&email='+email+'&phone='+phone+'&address='+address+'&quantity='+quantity+'&item='+item+'&'+prices+'&'+checkboxes;
    });

    
    
    
    //PAYMENT
    MoneyMatters.platform = 'insurance';

    $('.purchase-now').click(function(e){
        e.preventDefault();
        var details = {
            identification: $(this).data('value'),
            key: MoneyMatters.keys[MoneyMatters.platform], 
            email: $('#email').val(), 
            amount: $(this).data('price') * 100,
            firstname: $('#firstname').val(), 
            lastname: $('#lastname').val(), 
            phone: $('#phone').val()
        };

        if( details.identification && details.key && details.email && details.amount && details.firstname && details.lastname && details.phone )
        MoneyMatters.payWithPayStack(details);
    });
});