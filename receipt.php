<?php

  //if( !isset($user_id) || empty($user_id) )
  //header('Location: user');

  if( !isset($_GET['id']) || empty($_GET['id']) )
  header('Location: events');

  require_once('database.php');

  $id = mysqli_real_escape_string($database, $_GET['id']);

  //`user_id` = '$user_id' AND 
  $sql = "SELECT * FROM `booking` WHERE `booking_id` = '$id'";
  $query = mysqli_query($database, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0){
    $receipt = true;
    $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
    $transaction_id = $row['transaction_id'];
    $status = $row['status'];
    $date = $row['date'];
    $method = $row['method'];
    $processor = $row['processor'];
    $currency = $row['currency'];
    $amount = $row['amount'];
    $type = $row['type'];
    $type_id = $row['type_id'];
    $vendor_id = $row['vendor_id'];
    
    $sql = "SELECT `business_name` FROM `vendor` WHERE `vendor_id` = '$vendor_id'";
    $query = mysqli_query($database, $sql);
    $num = mysqli_num_rows($query);
    if($num > 0){
      $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $vendor_name = $row['business_name'];
    }

    $title_locations = array('event' => 'title', 'property' => 'type', 'insurance' => 'title', 'finance' => 'title', 'offer' => 'title', 'wedding' => 'title', 'travel' => 'departure', 'hotel' => 'checkin');
    $has_listing = array('event', 'property', 'wedding');
    $sql = "SELECT `".$title_locations[$type]."` FROM `$type` WHERE `".$type."_id` = '$type_id' AND `vendor_id` = '$vendor_id'";
    $query = mysqli_query($database, $sql);
    $num = mysqli_num_rows($query);
    if($num > 0){
      $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $title = $row[$title_locations[$type]];

      if($type == 'property')
      $title = 'A property (' . implode(', ', json_decode($title, true)) . ')';

      if(in_array($type, $has_listing))
      $url = $type . '/listing.php?id=' . $type_id;

    }else{
      $receipt = false;
    }
  }else{
    $receipt = false;
  }

?>


<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Receipt</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet"/>
    <link rel="stylesheet" href="css/font-awesome.css"/>
    <link rel="stylesheet" href="css/lineicons.css"/>
    <link rel="stylesheet" href="css/weather-icons.css"/>
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="css/styles.css"/>
  </head>
  <body class="bg-gray">








  
    
    <?php
      $options = array('page' => 'order', 'subpage' => 'order');
      require_once('header.php');

      if($receipt){ 
    ?>
    
    
    <div class="theme-page-section theme-page-section-xl theme-page-section-gray">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="theme-payment-success">
              <div class="theme-payment-success-header">
                <i class="fa fa-check-circle theme-payment-success-header-icon" style="color:#ee4a35;"></i>
                <h1 class="theme-payment-success-title"><?php echo isset($status) && $status == 1 ? 'Receipt Generated Successfully' : ''?></h1>
                <p class="theme-payment-success-subtitle">We have emailed you this receipt already.</p>
              </div>
              <div class="theme-payment-success-box">
                <ul class="theme-payment-success-summary">
                  <li>As payment for
                    <span title="<?php echo isset($title) ? ucwords($title) : ''; ?>" style="width: 200px; text-overflow: ellipsis; overflow: hidden; white-space: pre; text-align: right;"><!--
                      --><?php
                        echo isset($url) ? '<a href="'.$url.'">' : '';
                        echo isset($title) ? ucwords($title) : '';
                        echo isset($url) ? '</a>' : '';
                      ?><!--
                    --></span>
                  </li>
                  <li>Type
                    <span><?php echo isset($type) ? ucwords($type) : ''?></span>
                  </li>
                  <li>Transaction ID
                    <span><?php echo isset($transaction_id) ? $transaction_id : ''?></span>
                  </li>
                  <li>Vendor
                    <span><?php echo isset($vendor_name) ? $vendor_name : ''?></span>
                  </li>
                  <li>Amount
                    <span><?php echo isset($currency) && isset($amount) ? $currency . ' ' . $amount : ''?></span>
                  </li>
                  <li>Processor
                    <span><?php echo isset($processor) ? $processor : ''?></span>
                  </li>
                  <li>Payment method
                    <span><?php echo isset($method) ? ucwords(strtolower($method)) : ''?></span>
                  </li>
                  <li>Date
                    <span><?php echo isset($date) ? $date : ''?></span>
                  </li>
                </ul>
                <p class="theme-payment-success-check-order">You can check all booking details in your
                  <a href="user/history.php">profile history</a>.
                </p>
              </div>
              <!--
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
              -->
            </div>
          </div>
        </div>
      </div>
    </div>
    

    <?php
      }else{
    ?>

    
    <div class="theme-page-section theme-page-section-xl theme-page-section-gray">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="theme-payment-success">
              <div class="theme-payment-success-header">
                <i class="fa fa-warning theme-payment-success-header-icon" style="color:#ee4a35;"></i>
                <h1 class="theme-payment-success-title">Receipt not found.</h1>
                <p class="theme-payment-success-subtitle">This receipt does not exist</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php
      }
      require_once('footer.php');
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