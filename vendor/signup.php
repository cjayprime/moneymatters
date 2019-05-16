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

    <title>Vendor / Signup</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">

  </head>
  <body class="az-body">

    <div class="az-signup-wrapper">
      <div class="az-column-signup-left">
        <div>
          <img src="../img/logo_big.png"/>
          <h1 class="az-logo" style="text-transform:none;">MoneyMatters</h1>
          <h5>Responsive Modern Dashboard &amp; Admin Template</h5>
          <p>We are excited to launch our new company and product MoneyMatters. After being featured in too many magazines to mention and having created an online stir, we know that ThemePixels is going to be big. We also hope to win Startup Fictional Business of the Year this year.</p>
          <p>Browse our site and see for yourself why you need Azia.</p>
          <a href="index.html" class="btn btn-outline-indigo">Learn More</a>
        </div>
      </div><!-- az-column-signup-left -->
      <div class="az-column-signup">
        <div class="az-signup-header">
          <h2>Get Started</h2>
          <h4>It's free to signup and only takes a minute.</h4>
          <div id="error" style="color:red;margin-top:10px;margin-bottom:10px;font-size:20px;"></div>

            <!--
            <div class="form-group">
              <label>Business logo</label>
              <input id="file" type="file" style="display:none;">
              <div id="file-trigger" style="color:#b4bdce;font-weight:500;" type="text" class="form-control" onclick="$('#file').click()">Select an image</div>
            </div><!-- form-group -->
            <div class="form-group">
              <div id="error" style="color:red;"></div>
            </div>
            <div class="form-group">
              <label>Vendor Type</label>
              <select id="type" class="form-control">
                <option>Select a vendor type</option>
                <option>Finance</option>
                <option>Insurance</option>
                <option>Wedding</option>
                <option>Event</option>
                <option>Offer</option>
                <option>Property</option>
              </select>
            </div><!-- form-group -->
            <div class="form-group">
              <label>Business name</label>
              <input id="name" type="text" class="form-control" placeholder="Enter your business name">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Business address</label>
              <textarea id="address" type="text" class="form-control" placeholder="Enter your business address"></textarea>
            </div><!-- form-group -->
            <div class="form-group">
              <label>Email</label>
              <input id="email" type="text" class="form-control" placeholder="Enter your email">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Phone</label>
              <input id="phone" type="text" class="form-control" placeholder="Enter your phone number">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Password</label>
              <input id="password" type="password" class="form-control" placeholder="Enter your password">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Repeat Password</label>
              <input id="repeat-password" type="password" class="form-control" placeholder="Enter your password again">
            </div><!-- form-group -->
            <button class="btn btn-az-primary btn-block" id="signup">Create Account</button>
        </div><!-- az-signup-header -->
        <div class="az-signup-footer">
          <p>Already have an account? <a href="signin.php">Sign In</a></p>
        </div><!-- az-signin-footer -->
      </div><!-- az-column-signup -->
    </div><!-- az-signup-wrapper -->

    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>

    <script src="../js/azia.js"></script>
    <script>
      $(function(){
        'use strict'

        //Sign up
        $('#signup').click(function(){
          var type = $('#type').val();
          var name = $('#name').val();
          var address = $('#address').val();
          var email = $('#email').val();
          var phone = $('#phone').val();
          var password = $('#password').val();
          var repeatpassword = $('#repeat-password').val();
          
          var success = {border:'1px solid #dedede'};
          var error = {border:'1px solid red'};
          
          if(type != 'Finance' && type != 'Insurance' && type != 'Wedding' && type != 'Event' && type != 'Offer' && type != 'Property'){
            $('#type').css(error);
            return;
          }else $('#type').css(success);
          
          if(name == ''){
            $('#name').css(error);
            return;
          }else $('#name').css(success);
          
          if(address == ''){
            $('#address').css(error);
            return;
          }else $('#address').css(success);
          
          if(email == ''){
            $('#email').css(error);
            return;
          }else $('#email').css(success);
          
          if(phone == ''){
            $('#phone').css(error);
            return;
          }else $('#phone').css(success);
          
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
          
          if(name && address && email && phone && password){
            var data = {type: 'upload', command: 'create', id: 'account', vendortype: type, businessname: name, businessaddress: address, email: email, phone: phone, password: password};
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
