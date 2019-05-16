$(document).ready(function(){
  function findGetParameter(parameterName) {
    var result = null,
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
      var box = $('.financeModal');
      
      var firstname = box.find('.firstname').val();
      var lastname = box.find('.lastname').val();
      var email = box.find('.email').val();
      var phone = box.find('.phone').val();
      
      window.location = 'results.php?category='+category+'&firstname='+firstname+'&lastname='+lastname+'&email='+email+'&phone='+phone;
  });

  $('.magnific-inline').click(function(){
    var modal = $(this).attr('data-title');
    $('#magnific-modal-title')
    .text(modal.charAt(0).toUpperCase()+''+modal.slice(1).toLowerCase())
    .attr('data-title',modal)
    .parents('.magnific-popup').find('.search').attr('data-category',modal);
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
  $('#search-button').click(function(){
      //var location = $('#location').val();
      //var type = $('#type').val();
      //var status = $('#status').val();

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
      });function findGetParameter(parameterName) {
    var result = null,
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
      
      window.location = 'results.php?'+prices+'&'+checkboxes;
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