<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130582519-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-130582519-1');
    </script>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Azia">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/azia/img/azia-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/azia">
    <meta property="og:title" content="Azia">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <title>Vendor / Reset</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">

  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin">
        <h1 class="az-logo" style="text-transform:none;">MoneyMatters</h1>
        <div class="az-signin-header">
          
            
            <?php

              if(isset($_GET['verify']) && !empty($_GET['verify'])){
                $verify = $_GET['verify'];
                echo <<<EOT
                <input id="verify" type="hidden" value="{$verify}">
                <h2>Verify the code sent to your email</h2>
                <div id="error" style="color:red;margin-top:10px;margin-bottom:10px;font-size:20px;"></div>
                
                <div class="form-group">
                  <label>Code</label>
                  <input id="code" type="text" class="form-control" placeholder="Enter code">
                </div><!-- form-group -->
                <div class="form-group">
                  <label>New Password</label>
                  <input id="password" type="password" class="form-control" placeholder="New password">
                </div><!-- form-group -->
                <div class="form-group">
                  <label>Repeat Password</label>
                  <input id="repeat-password" type="password" class="form-control" placeholder="Repeat password">
                </div><!-- form-group -->
                <button class="btn btn-az-primary btn-block" id="reset">Reset</button>
EOT;
              }else{
                echo <<<EOT
                <h2>Reset your account password!</h2>
                <div id="error" style="color:red;margin-top:10px;margin-bottom:10px;font-size:20px;"></div>
                
                <div class="form-group">
                  <label>Email</label>
                  <input id="email" type="text" class="form-control" placeholder="Enter your email">
                </div><!-- form-group -->
                <button class="btn btn-az-primary btn-block" id="continue">Continue</button>
EOT;
              }

            ?>
            
        </div><!-- az-signin-header -->
        <div class="az-signin-footer">
        </div><!-- az-signin-footer -->
        <div class="az-signin-footer">
        </div><!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>

    <script src="../js/azia.js"></script>
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
                    window.location = '../vendor/reset.php?verify='+res.data['verification'];
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
                    window.location = '../vendor';
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
