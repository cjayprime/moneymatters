<?php
    
    require_once('../database.php');
      
    $start = isset($_GET['start']) && !empty($_GET['start']) ? $_GET['start'] : 6;
    
    // History
    $sql = "SELECT * FROM `booking` WHERE `user_id` = '$user_id' LIMIT $start, 10";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $results = array();
    if($num > 0){
      while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        array_push($results,$rows);
        $results[count($results) - 1]['details'] = json_decode($rows['details'],true);
      }
    }
        
    // Trending Apartments
    $sql = "SELECT * FROM `user` WHERE `user_id` = '$user_id' LIMIT 1";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $user = array();
    if($num > 0){
      $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $user = $rows;
    }

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>User / History</title>
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
      $options = array('page' => 'user', 'subpage' => 'history');
      require_once('../header.php');
  ?>
    
    
    
    
    
    
    
    
    <div class="theme-page-section theme-page-section-gray theme-page-section-lg">
      <div class="container">
        <div class="row">
          <div class="col-md-2-5 ">
            <div class="theme-account-sidebar">
              <div class="theme-account-avatar">
                <img class="theme-account-avatar-img" src="<?php echo isset($user['profile_picture']) ? $user['profile_picture'] : '' ?>" alt="Profile Picture"/>
                <p class="theme-account-avatar-name">Welcome,
                  <br/>
                  <?php echo isset($user['first_name']) && isset($user['last_name']) ? $user['first_name'].' '.$user['last_name'] : '' ?>
                </p>
              </div>
              <nav class="theme-account-nav">
                <ul class="theme-account-nav-list">
                  <li>
                    <a href="account.php">
                      <i class="fa fa-cog"></i>Profile
                    </a>
                  </li>
                  <li>
                    <a href="notifications.php">
                      <i class="fa fa-bell"></i>Notifications
                    </a>
                  </li>
                  <li class="active">
                    <a href="history.php">
                      <i class="fa fa-history"></i>History
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="col-md-9-5 ">
            <h1 class="theme-account-page-title">Booking History</h1>
            <div class="theme-account-history">
              <table class="table">
                <thead>
                  <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  
                  

                
                  
                
                
                
                
                
                
                
                
                  <?php

                    for($i = 0; $i < count($results); $i++){
                      $result = $results[$i];

                      //Logo
                      $logo = $result['type'] == 'property' ? 'home' : 
                              ($result['type'] == 'travel' ? 'plane' : 
                              ($result['type'] == 'hotel' ? 'bed' : 
                              ($result['type'] == 'event' ? 'calendar' : 
                              ($result['type'] == 'wedding' ? 'circle-o-notch' : 
                              'glass'))));

                      //Name
                      $name = '';
                      $sql = "SELECT * FROM `vendor` WHERE `vendor_id` = '".$result['vendor_id']."' LIMIT 1";
                      $query = mysqli_query($database,$sql);
                      $num = mysqli_num_rows($query);
                      $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
                      $name = $rows['business_name'];
                      //echo mysqli_error($database);

                      //Type
                      $type = $result['type'];
                      $type_id = $result['type_id'];

                      //Date
                      if($result['type'] == 'hotel'){
                        $date = $result['details']['checkin'] . ' &#8212; ' . $result['details']['checkout'];
                      }else if($result['type'] == 'travel'){
                        $date = $result['details']['departure'] . ' &#8212; ' . $result['details']['arrival'];
                      }else $date = $result['date'];
                      
                      //Location
                      $location = '';
                      $sql = "SELECT * FROM `$type` WHERE `".$type."_id` = '$type_id' LIMIT 1";
                      $query = mysqli_query($database,$sql);
                      $num = mysqli_num_rows($query);
                      //echo mysqli_error($database);
                      $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
                      if($result['type'] == 'event' || $result['type'] == 'property' || $result['type'] == 'wedding'){
                        $location = $rows['state'] . ', ' . $rows['country'];
                      }

                      //Amount
                      $currency = $result['currency'];
                      $amount = $result['amount'];
                      
                      $type = ucwords($type).' '.$result['category'];
                      echo <<<EOT
                        <tr>
                          <td class="theme-account-history-type">
                            <i class="fa fa-{$logo} theme-account-history-type-icon"></i>
                          </td>
                          <td>
                            <p class="theme-account-history-type-title">{$name}</p>
                            <a class="theme-account-history-item-name" href="#">{$type}</a>
                          </td>
                          <td>
                            <a href="#">{$location}</a>
                          </td>
                          <td class="theme-account-history-tr-date">
                            <p class="theme-account-history-date">{$date}</p>
                          </td>
                          <td>
                            <p class="theme-account-history-item-price">{$currency} {$amount}</p>
                          </td>
                        </tr>
EOT;
                    }
                  ?>













                </tbody>
              </table>
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