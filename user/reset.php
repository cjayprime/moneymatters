<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>User / Reset</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/font-awesome.css"/>
    <link rel="stylesheet" href="../css/lineicons.css"/>
    <link rel="stylesheet" href="../css/weather-icons.css"/>
    <link rel="stylesheet" href="../css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/styles.css"/>
    </head>
    <body>
























  
    
    <?php
      $options = array('page' => 'user', 'subpage' => 'reset');
      require_once('../header.php');
    ?>






















    
    
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url(../img/offers-mm.jpg);"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-strong"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="theme-page-section _pt-100 theme-page-section-xl">
          <div class="container">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <div class="theme-login theme-login-white">



                  
            <?php

              if(isset($_GET['verify']) && !empty($_GET['verify'])){
                $verify = $_GET['verify'];
                echo <<<EOT
                  <div class="theme-login-header">
                    <h1 class="theme-login-title">Code verification</h1>
                    <p class="theme-login-subtitle">Verify the code sent to your email</p>
                  </div>
                  <div class="theme-login-box">
                    <div class="theme-login-box-inner">
                        <div class="form-group theme-login-form-group">
                          <div id="error" style="color:red;"></div>
                        </div>
                        <input id="verify" type="hidden" value="{$verify}">
                        <div class="form-group theme-login-form-group">
                          <input class="form-control" type="text" placeholder="Enter code" id="code"/>
                        </div>
                        <div class="form-group theme-login-form-group">
                          <input class="form-control" type="password" placeholder="New Password" id="password"/>
                        </div>
                        <div class="form-group theme-login-form-group">
                          <input class="form-control" type="password" placeholder="Repeat Password" id="repeat-password"/>
                        </div>
                        <button class="btn btn-uc btn-dark btn-block btn-lg" id="reset">Reset</button>
                      
                    </div>
                  </div>
EOT;
              }else{

                echo <<<EOT
                  <div class="theme-login-header">
                    <h1 class="theme-login-title">Reset password</h1>
                    <p class="theme-login-subtitle">Reset your MoneyMatters account password</p>
                  </div>
                  <div class="theme-login-box">
                    <div class="theme-login-box-inner">
                        <div class="form-group theme-login-form-group">
                          <div id="error" style="color:red;"></div>
                        </div>
                        <div class="form-group theme-login-form-group">
                          <input class="form-control" type="text" placeholder="Email Address" id="email"/>
                        </div>
                        <button class="btn btn-uc btn-dark btn-block btn-lg" id="continue">Continue</button>
                      
                    </div>
                  </div>
EOT;
            }
                ?>
                
                  <p class="theme-login-terms">By using our platform you accept our
                    <a href="#">Terms of Use</a>
                    <br/>and
                    <a href="#">Privacy Policy</a>.
                  </p>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    







    <?php
      require_once('../footer.php');
    ?>










    <script src="../js/jquery.js"></script>
    <script src="../js/moment.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYeBBmgAkyAN_QKjAVOiP_kWZ_eQdadeI&callback=initMap&libraries=places"></script>
    <script src="../js/owl-carousel.js"></script>
    <script src="../js/blur-area.js"></script>
    <script src="../js/icheck.js"></script>
    <script src="../js/gmap.js"></script>
    <script src="../js/magnific-popup.js"></script>
    <script src="../js/ion-range-slider.js"></script>
    <script src="../js/sticky-kit.js"></script>
    <script src="../js/smooth-scroll.js"></script>
    <script src="../js/fotorama.js"></script>
    <script src="../js/bs-datepicker.js"></script>
    <script src="../js/typeahead.js"></script>
    <script src="../js/quantity-selector.js"></script>
    <script src="../js/countdown.js"></script>
    <script src="../js/window-scroll-action.js"></script>
    <script src="../js/fitvid.js"></script>
    <script src="../js/youtube-bg.js"></script>
    <script src="../js/custom.js"></script>
    <script>
      $(function(){
        'use strict'
        
        //Continue
        $('#continue').click(function(){
          var email = $('#email').val();
          
          var success = {border:'1px solid #dedede'};
          var error = {border:'1px solid red'};
          
          if(email == ''){
            $('#email').css(error);
            return;
          }else{
            $('#email').css(success);
          }
          
          if(email){
            var data = {type: 'upload', command: 'create-reset', id: 'account', email: email};
            $.ajax({url: 'action.php',data: data,
                method:'POST',
                dataType:"json",
                success:function(res,status,xhr){
                    console.log(res);
                    if(res.success)
                    window.location = '../user/reset.php?verify='+res.data['id'];
                    else
                    $('#error').text(res.message+' An error occurred, check the form and try again.');
                },
                error:function(res,status,xhr){
                    console.log(res.responseText);
                    $('#error').text(res.responseText+' A fatal error occurred, try again, if the error persists, contact support.');
                }
            });
          }
        });

        //Reset
        $('#reset').click(function(){
          var verify = $('#verify').val();
          var code = $('#code').val();
          var password = $('#password').val();
          var repeatpassword = $('#repeat-password').val();
          
          var success = {border:'1px solid #dedede'};
          var error = {border:'1px solid red'};
          
          if(code == ''){
            $('#code').css(error);
            return;
          }else{
            $('#code').css(success);
          }
          
          if((password == '' || repeatpassword == '') || (password != repeatpassword)){
            if(password != repeatpassword)
            $('#password,#repeat-password').css(error);
            
            if(password == '')
            $('#password').css(error);
            
            if(repeatpassword == '')
            $('#repeat-password').css(error);
            
            return;
          }else{
            $('#password,#repeat-password').css(success);
          }
          
          if(code && password){
            var data = {type: 'upload', command: 'reset', id: 'account', code: code, password: password, verify: verify};
            $.ajax({url: 'action.php',data: data,
                method:'POST',
                dataType:"json",
                success:function(res,status,xhr){
                    console.log(res);
                    if(res.success)
                    window.location = '../user';
                    else
                    $('#error').text(res.message+' An error occurred, check the form and try again.');
                },
                error:function(res,status,xhr){
                    console.log(res.responseText);
                    $('#error').text(res.responseText+' A fatal error occurred, try again, if the error persists, contact support.');
                }
            });
          }
        });
      });
    </script>
  </body>
</html>