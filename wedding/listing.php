<?php
    
    require_once('../database.php');

    // GET: URL request
    $wedding_id = isset($_GET['id']) ? mysqli_real_escape_string($database,$_GET['id']) : 0;
    
    $sql = "SELECT * FROM `wedding` WHERE `wedding_id` = '$wedding_id'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);

    if($num > 0){
      $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $result['pictures'] = json_decode($result['pictures'],true);
      $result['category'] = json_decode($result['category'],true);
      $result['rating'] = json_decode($result['rating'],true);
    }else{
      $result = array();
    }
    

    // Total number of properties in the selected state
    $total_state = 0;
    if(count($result) > 0){
      $sql = "SELECT COUNT(*) AS state FROM `wedding` WHERE `state` = '".$result['state']."'";
      $query = mysqli_query($database,$sql);
      $num = mysqli_num_rows($query);

      if($num > 0){
        $total_state = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $total_state = $total_state['state'];
      } 
    }

    // Total number of properties in the selected LGA/City
    $total_city = 0;
    if(count($result) > 0){
      $sql = "SELECT COUNT(*) AS city FROM `wedding` WHERE `city` = '".$result['city']."'";
      $query = mysqli_query($database,$sql);
      $num = mysqli_num_rows($query);

      if($num > 0){
        $total_city = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $total_city = $total_city['city'];
      } 
    }

    // Total number of properties in the selected LGA/City
    $total_district = 0;
    if(count($result) > 0){
      $sql = "SELECT COUNT(*) AS district FROM `wedding` WHERE `district` = '".$result['district']."'";
      $query = mysqli_query($database,$sql);
      $num = mysqli_num_rows($query);

      if($num > 0){
        $total_district = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $total_district = $total_district['district'];
      } 
    }

    // Admin
    /*$sql = "SELECT `fee` FROM `admin` WHERE `title` = 'moneymatters' AND `page` = 'wedding' AND `access` = 'system'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $admin = array();
    if($num > 0){
      $admin = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $result['price'] = json_decode($result['price'],true);
    }*/

?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Wedding / Listing</title>
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
  <body class="gray">








  
    
<?php
  $options = array('page' => 'wedding', 'subpage' => 'listing');
  require_once('../header.php');
?>











<div class="container">
      <div class="theme-item-page-header">
        <div class="theme-item-page-header-body">
          <ul class="theme-item-page-header-stars">
            <li>
              <i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i>
            </li>
            <li>
              <i class="fa fa-star"></i>
            </li>
          </ul>
          <h1 class="theme-item-page-header-title"><?php echo isset($result['title']) ? $result['title'] : ''; ?></h1>
          <div class="theme-item-page-header-price">
            <p class="theme-item-page-header-price-body">
              <b><?php echo isset($result['views']) ? $result['views'] : ''; ?></b>
              <span>views</span>
            </p>
            <a class="btn _tt-uc btn-primary-inverse" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);" data-scroll href=""><?php echo isset($result['time']) ? date("F jS, Y", strtotime($result['time'])) : ''; ?></a>
          </div>
          <ul class="theme-breadcrumbs _mt-10 _mt-mob-30 theme-breadcrumbs-default">
            <li>
              <p class="theme-breadcrumbs-item-title">
                <a href="index.html">Home</a>
              </p>
            </li>
            <li>
              <p class="theme-breadcrumbs-item-title">
                <a href="#"><?php echo isset($result['district']) ? $result['district'] : ''; ?></a>
              </p>
              <p class="theme-breadcrumbs-item-subtitle"><?php echo $total_district; ?> weddings</p>
            </li>
            <li>
              <p class="theme-breadcrumbs-item-title">
                <a href="#"><?php echo isset($result['city']) ? $result['city'] : ''; ?></a>
              </p>
              <p class="theme-breadcrumbs-item-subtitle"><?php echo $total_city; ?> weddings</p>
            </li>
            <li>
              <p class="theme-breadcrumbs-item-title">
                <a href="#"><?php echo isset($result['state']) ? $result['state'] : ''; ?></a>
              </p>
              <p class="theme-breadcrumbs-item-subtitle"><?php echo $total_state; ?> weddings</p>
            </li>
            <li>
              <p class="theme-breadcrumbs-item-title active"><?php echo isset($result['country']) ? $result['country'] : ''; ?></p>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="theme-page-section">
      <div class="container">
        <div class="row row-col-static" id="sticky-parent">
          <div class="col-md-9 ">
            <div class="row">
              <div class="col-md-8 ">
                <div class="theme-item-page-tabs _mb-30">
                  <div class="tabbable">
                    <div class="tab-content _pt-20">
                      <div class="tab-pane active" id="HotelPageTabs-1" role="tab-panel">
                        <div class="row magnific-gallery row-col-gap" data-gutter="10">
                          
                          
                          



















                          <?php
                            for($i = 0; $i < count($result['pictures']); $i++)
                            echo <<<EOT
                            <div class="col-xs-3 ">
                              <div class="banner banner-sqr banner-">
                                <div class="banner-bg" style="background-image:url({$result['pictures'][$i]});"></div>
                                <a class="banner-link" href="./img/1140x480.png"></a>
                              </div>
                            </div>
EOT;
                          ?>






















                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 ">
                <div class="theme-item-page-overview _mt-20 _mv-mob-30">
                  <div class="theme-item-page-overview-rate">
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <?php
                      $total_rating = 0;
                      $color_code = '#FFF';
                      $score_comment = '-';
                      for($j = 0; $j < count($result['rating']); $j++){
                        if($j != count($result['rating']) - 1){
                          $total_rating += $result['rating'][$j]['rating'] + $result['rating'][$j + 1]['rating'];
                        }else{
                          $score = ($total_rating /  ($j+1));
                          $score_comment = (($score == 10) ? 'Excellent' : (($score > 7) ? 'Very Good' : (($score > 5 && $score <= 7) ? 'Good' : (($score >= 3 && $score <= 5) ? 'Fair' : 'Poor'))));
                          $color_code = (($score == 10) ? 'green' : (($score > 7) ? 'blue' : (($score > 5 && $score <= 7) ? 'sky blue' : (($score >= 3 && $score <= 5) ? 'pink' : 'red'))));
                          $total_rating = '<b>'.$score.'</b> out of 5';//$score .' '. $score_comment;
                        }
                      }
                      $total_rating = $total_rating ? $total_rating : 'Not yet rated';
                      $rating = count($result['rating']);
                      echo <<<EOT
                      <p class="theme-item-page-overview-rate-subtitle">
                        {$total_rating}
                      </p>
                      <h3 class="theme-item-page-overview-rate-title" style="color:{$color_code}">{$score_comment}</h3>
                      <p class="theme-item-page-overview-rate-count">Rated by {$rating} users</p>
EOT;
                    ?>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    





                    
                    
                  </div>
                  <ul class="theme-item-page-overview-summary">
                    <li>Category</li>
                    <?php 
                      for($i = 0; $i < count($result['category']); $i++){
                        echo '<li>'.$result['category'][$i].'</li>';
                      }

                      echo (isset($result['description'])) ? '<br/><b>'.$result['description'].'</b>' : '';
                    ?>
                  </ul>
                </div>
              </div>
            </div>
            
          </div>
          <div class="col-md-3 ">
            <div class="_mt-20 _mt-mob-30">
              
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="theme-search-area _p-20 _bg-p _br-4 _mb-20 _bsh theme-search-area-vert theme-search-area-white">
                <div class="theme-search-area-form" id="hero-search-form">
                
                <input id="identification" value="<?php echo isset($wedding_id) ? $wedding_id : ''; ?>" type="hidden"/>
                        
                <div class="row" data-gutter="10">
                    <div class="col-md-6 ">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        <label class="theme-search-area-section-label">First name</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon fa fa-male"></i>
                          <input class="theme-search-area-section-input _mob-h" id="firstname" value="" type="text" placeholder="First name"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        <label class="theme-search-area-section-label">Last name</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon fa fa-male"></i>
                          <input class="theme-search-area-section-input _mob-h" id="lastname" value="" type="text" placeholder="Last name"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" data-gutter="10">
                    <div class="col-md-6 ">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        <label class="theme-search-area-section-label">Email</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon fa fa-envelope"></i>
                          <input class="theme-search-area-section-input _mob-h" id="email" value="" type="text" placeholder="Email"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        <label class="theme-search-area-section-label">Phone</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon fa fa-phone"></i>
                          <input class="theme-search-area-section-input _mob-h" id="phone" value="" type="text" placeholder="Phone"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                    <label class="theme-search-area-section-label">To</label>
                    <div class="theme-search-area-section-inner">
                      <i class="theme-search-area-section-icon fa fa-comment"></i>
                      <textarea class="theme-search-area-section-input" style="height: 75px; padding-top:13px" id="message" type="text" placeholder="Message"></textarea>
                    </div>
                  </div>
                  <button id="submit" class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved theme-search-area-submit-sm theme-search-area-submit-white theme-search-area-submit-primary">Submit</button>
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
    <script async defer src="../https://maps.googleapis.com/maps/api/js?key=AIzaSyDYeBBmgAkyAN_QKjAVOiP_kWZ_eQdadeI&callback=initMap&libraries=places"></script>
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
    <script src="../js/fix-weddings.js"></script>
  </body>
</html>