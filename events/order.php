<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Travel Mate - Payment success</title>
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
  <body class="bg-gray">








  
    
    <?php
      $options = array('page' => 'events', 'subpage' => 'order');
      require_once('../header.php');
    ?>










    
    <div class="theme-page-section theme-page-section-xl theme-page-section-gray">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="theme-payment-success">
              <div class="theme-payment-success-header">
                <i class="fa fa-check-circle theme-payment-success-header-icon" style="color:#ee4a35;"></i>
                <h1 class="theme-payment-success-title">Payment Successful</h1>
                <p class="theme-payment-success-subtitle">We have emailed you the receipt.</p>
              </div>
              <div class="theme-payment-success-box">
                <ul class="theme-payment-success-summary">
                  <li>Payment ID
                    <span>#7249874</span>
                  </li>
                  <li>Date
                    <span>9/25/2017 12:24pm</span>
                  </li>
                  <li>Customer
                    <span>John Doe</span>
                  </li>
                  <li>Paid to
                    <span>Bookify group inc.</span>
                  </li>
                  <li>Payment method
                    <span>Visa credit card</span>
                  </li>
                  <li>Subject
                    <span>Vacation Rental</span>
                  </li>
                  <li>Amount paid
                    <span>$753.85</span>
                  </li>
                </ul>
                <p class="theme-payment-success-check-order">You can check your order details in your
                  <a href="account-history.html">account page</a>.
                </p>
              </div>
              <ul class="theme-payment-success-actions">
                <li>
                  <a href="#">
                    <i class="fa fa-file-pdf-o"></i>
                    <p>PDF
                      <br/>receipt
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-print"></i>
                    <p>Print
                      <br/>receipt
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-envelope-o"></i>
                    <p>SMS
                      <br/>receipt
                    </p>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    







    <?php
      require_once('../footer.php');
    ?>










    <script src="js/jquery.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/bootstrap.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYeBBmgAkyAN_QKjAVOiP_kWZ_eQdadeI&callback=initMap&libraries=places"></script>
    <script src="js/owl-carousel.js"></script>
    <script src="js/blur-area.js"></script>
    <script src="js/icheck.js"></script>
    <script src="js/gmap.js"></script>
    <script src="js/magnific-popup.js"></script>
    <script src="js/ion-range-slider.js"></script>
    <script src="js/sticky-kit.js"></script>
    <script src="js/smooth-scroll.js"></script>
    <script src="js/fotorama.js"></script>
    <script src="js/bs-datepicker.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="js/quantity-selector.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/window-scroll-action.js"></script>
    <script src="js/fitvid.js"></script>
    <script src="js/youtube-bg.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>