<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>User / Signin</title>
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
      $options = array('page' => 'user', 'subpage' => 'signin');
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
                  <div class="theme-login-header">
                    <h1 class="theme-login-title">Sign In</h1>
                    <p class="theme-login-subtitle">Sign in to your MoneyMatters account</p>
                  </div>
                  <div class="theme-login-box">
                    <div class="theme-login-box-inner">
                        <div class="form-group theme-login-form-group">
                          <div id="error" style="color:red;"></div>
                        </div>
                        <div class="form-group theme-login-form-group">
                          <input class="form-control" type="text" placeholder="Email Address" id="email"/>
                        </div>
                        <div class="form-group theme-login-form-group">
                          <input class="form-control" type="password" placeholder="Password" id="password"/>
                        </div>
                        <button class="btn btn-uc btn-dark btn-block btn-lg" id="signin">Sign in</button>
                      
                    </div>
                    <div class="theme-login-box-alt">
                      <div>
                        <a href="reset.php">Forgot password?</a>
                      </div>
                      <p>Don't have an account? &nbsp;
                        <a href="signup.php">Sign up.</a>
                      </p>
                    </div>
                  </div>
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
    <script src="../js/fix-user.js"></script>
  </body>
</html>