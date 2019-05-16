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

    <title>Moneymatters Admin</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">

  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin" style="width:45%">
        <h1 class="az-logo" style="text-transform:none;">MoneyMatters</h1>
        <div class="az-signin-header">
          <div class="form-group">
            <img src="../img/logo_big.png"/>
          </div>
          <h2>Enter the administrator email and password to proceed</h2>
          <div id="error" style="color:red;margin-top:10px;margin-bottom:10px;font-size:20px;"></div>
            
            <div class="form-group">
              <label>Email</label>
              <input id="email" type="text" class="form-control" placeholder="Email">
              <label style="margin-top:20px">Password</label>
              <input id="access" type="password" class="form-control" placeholder="Access key">
            </div><!-- form-group -->
            <a href="reset.php">Reset password</a>
            <button class="btn btn-az-primary btn-block" id="enter">Enter</button>
        </div><!-- az-signin-header -->
        <div class="az-signin-footer">
        </div><!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>

    <script src="../js/admin/azia.js"></script>
    <script>
      $(function(){
        'use strict'

        //Sign in
        $('#enter').click(function(){
          var email = $('#email').val();
          var access = $('#access').val();
          
          var success = {border:'1px solid #dedede'};
          var error = {border:'1px solid red'};
          
          if(email == ''){
            $('#email').css(error);
            return;
          }else{
            $('#email').css(success);
          }

          if(access == ''){
            $('#access').css(error);
            return;
          }else{
            $('#access').css(success);
          }
          
          if(access){
            var data = {type: 'upload', command: 'confirm', id: 'account', access: access, email: email};
            $.ajax({url: 'action.php',data: data,
                method:'POST',
                dataType:"json",
                success:function(res,status,xhr){
                    console.log(res,access,email);
                    if(res.success)
                    window.location = '../admin';
                    else
                    $('#error').text(res.message+' An error occurred, check the form and try again.');
                },
                error:function(res,status,xhr){
                    console.log(res.responseText);
                    $('#error').text(res.responseText+' A fatal error occurred, try again, if the error persists, contact support.');
                }
            });
          }
        })//.click();
      });
    </script>
  </body>
</html>
