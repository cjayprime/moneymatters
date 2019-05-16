<?php
    
    require_once('../database.php');
        
    // Trending Apartments
    $sql = "SELECT * FROM `user` WHERE `user_id` = '$user_id' LIMIT 1";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $results = array();
    if($num > 0){
      $results = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $results['notifications'] = json_decode($results['notifications'],true);
    }

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>User / Notification</title>
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
      $options = array('page' => 'user', 'subpage' => 'notifications');
      require_once('../header.php');
  ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="theme-page-section theme-page-section-gray theme-page-section-lg">
      <div class="container">
        <div class="row">
          <div class="col-md-2-5 ">
            <div class="theme-account-sidebar">
              <div class="theme-account-avatar">
                <img class="theme-account-avatar-img" src="<?php echo isset($results['profile_picture']) ? $results['profile_picture'] : '' ?>" alt="Profile Picture"/>
                <p class="theme-account-avatar-name">Welcome,
                  <br/>
                  <?php echo isset($results['first_name']) && isset($results['last_name']) ? $results['first_name'].' '.$results['last_name'] : '' ?>
                </p>
              </div>
              <nav class="theme-account-nav">
                <ul class="theme-account-nav-list">
                  <li>
                    <a href="account.php">
                      <i class="fa fa-cog"></i>Profile
                    </a>
                  </li>
                  <li class="active">
                    <a href="notifications.php">
                      <i class="fa fa-bell"></i>Notifications
                    </a>
                  </li>
                  <li>
                    <a href="history.php">
                      <i class="fa fa-history"></i>History
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="col-md-9-5 ">
            <h1 class="theme-account-page-title">Notifications</h1>
            <h4 class="theme-account-notifications-title">Select subscriptions to be delivered to <?php echo isset($results['email']) ? $results['email'] : '' ?></h4>
            <h4 class="theme-account-notifications-title"></h4>
            <div class="theme-account-notifications">
              <div class="theme-account-notifications-item">
                <label class="icheck-label">
                  <input class="icheck" data-notice="announcements" type="checkbox" <?php echo isset($results['notifications']['announcements']) && $results['notifications']['announcements'] ? 'checked' : '' ?>/>
                  <span class="icheck-title">Announcements
                    <span class="icheck-sub-title">Be the first to know about new features and other news (sent quarterly)</span>
                  </span>
                </label>
              </div>
              <div class="theme-account-notifications-item">
                <label class="icheck-label">
                  <input class="icheck" data-notice="offers" type="checkbox" <?php echo isset($results['notifications']['offers']) && $results['notifications']['offers'] ? 'checked' : '' ?>/>
                  <span class="icheck-title">Special Offers
                    <span class="icheck-sub-title">Receive last-minute offers from our travel partners (sent periodically)</span>
                  </span>
                </label>
              </div>
              <div class="theme-account-notifications-item">
                <label class="icheck-label">
                  <input class="icheck" data-notice="deals" type="checkbox" <?php echo isset($results['notifications']['deals']) && $results['notifications']['deals'] ? 'checked' : '' ?>/>
                  <span class="icheck-title">Travel Deals Newsletter
                    <span class="icheck-sub-title">Stay on top of the best travel deals, offers and discounts we have found (sent periodically)</span>
                  </span>
                </label>
              </div>
              <div class="theme-account-notifications-item">
                <label class="icheck-label">
                  <input class="icheck" data-notice="survey" type="checkbox" <?php echo isset($results['notifications']['survey']) && $results['notifications']['survey'] ? 'checked' : '' ?>/>
                  <span class="icheck-title">Review Surveys
                    <span class="icheck-sub-title">Share your travel experience to better inform users</span>
                  </span>
                </label>
              </div>
              <div class="theme-account-notifications-item">
                <label class="icheck-label">
                  <input class="icheck" data-notice="recommendations" type="checkbox" <?php echo isset($results['notifications']['recommendations']) && $results['notifications']['recommendations'] ? 'checked' : '' ?>/>
                  <span class="icheck-title">Personalized Recommendations
                    <span class="icheck-sub-title">Customized travel deals tailored to help you plan every part of a trip you book through Bookify (sent periodically)</span>
                  </span>
                </label>
              </div>
              <div class="theme-account-notifications-item">
                <label class="icheck-label">
                  <input class="icheck"  data-notice="reminders" type="checkbox" <?php echo isset($results['notifications']['reminders']) && $results['notifications']['reminders'] ? 'checked' : '' ?>/>
                  <span class="icheck-title">Reminders
                    <span class="icheck-sub-title">See the latest prices for the travel deals you were searching (sent periodically)</span>
                  </span>
                </label>
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