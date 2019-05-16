<?php
    
    require_once('../database.php');
    
    // GET: URL request
    $event_id = isset($_GET['id']) ? mysqli_real_escape_string($database,$_GET['id']) : 0;
    
    $sql = "SELECT * FROM `event` WHERE `event_id` = '$event_id'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);

    if($num > 0){
      $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $result['pictures'] = json_decode($result['pictures'],true);
      $result['category'] = json_decode($result['category'],true);
    }else{
      $result = array();
    }

    // Total number of properties in the selected state
    $total_country = 0;
    if(count($result) > 0){
      $sql = "SELECT COUNT(*) AS country FROM `event` WHERE `country` = '".$result['country']."'";
      $query = mysqli_query($database,$sql);
      $num = mysqli_num_rows($query);

      if($num > 0){
        $total_country = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $total_country = $total_country['country'];
      }
    }

    // Total number of properties in the selected state
    $total_state = 0;
    if(count($result) > 0){
      $sql = "SELECT COUNT(*) AS state FROM `event` WHERE `state` = '".$result['state']."'";
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
      $sql = "SELECT COUNT(*) AS city FROM `event` WHERE `city` = '".$result['city']."'";
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
      $sql = "SELECT COUNT(*) AS district FROM `event` WHERE `district` = '".$result['district']."'";
      $query = mysqli_query($database,$sql);
      $num = mysqli_num_rows($query);

      if($num > 0){
        $total_district = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $total_district = $total_district['district'];
      } 
    }

    // Admin
    /*$sql = "SELECT `fee` FROM `admin` WHERE `title` = 'moneymatters' AND `page` = 'event' AND `access` = 'system'";
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
    <title>Events / Listing</title>
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
      $options = array('page' => 'events', 'subpage' => 'listing');
      require_once('../header.php');
    ?>










    
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-strong" style="background-image:url(../img/ep_naturalblack.png);"></div>
        <div class="theme-hero-area-inner-shadow"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="theme-item-page-header _pv-200 _mt-0 theme-item-page-header-white theme-item-page-header-center">
            <div class="theme-item-page-header-body">
              <h1 class="theme-item-page-header-title"><?php echo (isset($result['title'])) ? $result['title'] : ''; ?></h1>
              <ul class="theme-breadcrumbs _mob-h theme-breadcrumbs-center theme-breadcrumbs-sm">
                <li>
                  <p class="theme-breadcrumbs-item-title">
                    <a href="index.html">Home</a>
                  </p>
                </li>
                <li>
                  <p class="theme-breadcrumbs-item-title">
                    <a href="#"><?php echo (isset($result['district'])) ? $result['district'] : ''; ?></a>
                  </p>
                  <p class="theme-breadcrumbs-item-subtitle"><?php echo $total_district; ?> offers</p>
                </li>
                <li>
                  <p class="theme-breadcrumbs-item-title">
                    <a href="#"><?php echo (isset($result['state'])) ? $result['state'] : ''; ?></a>
                  </p>
                  <p class="theme-breadcrumbs-item-subtitle"><?php echo $total_state; ?> offers</p>
                </li>
                <li>
                  <p class="theme-breadcrumbs-item-title">
                    <a href="#"><?php echo (isset($result['country'])) ? $result['country'] : ''; ?> Experiences</a>
                  </p>
                  <p class="theme-breadcrumbs-item-subtitle"><?php echo $total_country; ?> offers</p>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section _pt-0 _pb-60 front theme-page-section-gray">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="_ph-30 _bg-w _bsh-xl _mt--50">
              <div class="row row-col-static row-eq-height row-col-border" id="sticky-parent" data-gutter="60">
                <div class="col-md-8 ">
                  <div class="theme-search-area _mt-30 _desk-h theme-search-area-vert">
                    <div class="theme-search-area-header _mb-20 theme-search-area-header-sm">
                      <h1 class="theme-search-area-title">$92 per person</h1>
                      <p class="theme-search-area-subtitle">Tortor euismod et neque lobortis</p>
                    </div>
                    <div class="theme-search-area-form">
                      <div class="theme-search-area-section theme-search-area-section-sm theme-search-area-section-curved">
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-calendar"></i>
                          <input class="theme-search-area-section-input datePickerSingle _mob-h" value="Wed 06/27" type="text"/>
                          <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                        </div>
                      </div>
                      <div class="theme-search-area-section theme-search-area-section-sm theme-search-area-section-curved quantity-selector" data-increment="Guests">
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-people"></i>
                          <input class="theme-search-area-section-input" value="2 Guests" type="text"/>
                          <div class="quantity-selector-box" id="mobile-ExpSearchGuests">
                            <div class="quantity-selector-inner">
                              <p class="quantity-selector-title">Guests</p>
                              <ul class="quantity-selector-controls">
                                <li class="quantity-selector-decrement">
                                  <a href="#">&#45;</a>
                                </li>
                                <li class="quantity-selector-current">1</li>
                                <li class="quantity-selector-increment">
                                  <a href="#">&#43;</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-item-page-summary-price _mb-20">
                        <a class="theme-item-page-summary-price-link" href="#summaryPriceCollapseMobile" data-toggle="collapse" aria-expanded="false" aria-controls="summaryPriceCollapseMobile">Show summary</a>
                        <div class="collapse" id="summaryPriceCollapseMobile">
                          <ul class="theme-item-page-summary-price-list">
                            <li class="theme-item-page-summary-price-item">
                              <h5 class="theme-item-page-summary-price-item-title">2 Guests</h5>
                              <p class="theme-item-page-summary-price-item-subtitle"></p>
                              <p class="theme-item-page-summary-price-item-price">$184.00</p>
                            </li>
                            <li class="theme-item-page-summary-price-item">
                              <h5 class="theme-item-page-summary-price-item-title">Service fee</h5>
                              <p class="theme-item-page-summary-price-item-subtitle"></p>
                              <p class="theme-item-page-summary-price-item-price">$7.00</p>
                            </li>
                          </ul>
                        </div>
                        <p class="theme-item-page-summary-price-total">Total
                          <span>$191.00</span>
                        </p>
                      </div>
                      <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved"  style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);">Book Now</button>
                    </div>
                  </div>
                  <div class="theme-item-page-details _pv-30 theme-item-page-details-first-nm">
                    <div class="theme-item-page-details-section">
                      <div class="row magnific-gallery row-col-gap" data-gutter="10">
                        




























                        <?php

                          if(isset($result['pictures']))
                          for($i = 0; $i < count($result['pictures']); $i++)
                          echo 
                          <<<EOT
                          <div class="col-xs-4 ">
                            <div class="banner _h-20vh _h-mob-15vh banner-">
                              <div class="banner-bg" style="background-image:url({$result['pictures'][$i]});"></div>
                              <a class="banner-link" href="{$result['pictures'][$i]}"></a>
                            </div>
                          </div>
EOT;
                          ?>
                        

























                        
                      </div>
                    </div>
                    <div class="theme-item-page-details-section">
                      <h5 class="theme-item-page-details-section-title">Description</h5>
                      <div class="theme-item-page-desc">
                        <?php echo (isset($result['description'])) ? $result['description'] : ''; ?>
                      </div>
                    </div>
                    <div class="theme-item-page-details-section">
                      <h5 class="theme-item-page-details-section-title">Categories</h5>
                      <div class="theme-item-page-desc row">
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="col-md-4 ">
                          <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                      
                            <?php

                              if(isset($result['category']))
                              for($i = 0; $i < 0.3 * count($result['category']); $i++)
                              echo '<li>'.$result['category'][$i].'</li>';
                              
                            ?>

                          </ul>
                        </div>
                        <div class="col-md-4 ">
                          <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                      
                            <?php

                              if(isset($result['category']))
                              for($i = ceil(0.3 * count($result['category'])); $i < 0.6 * count($result['category']); $i++)
                              echo '<li>'.$result['category'][$i].'</li>';
                              
                            ?>

                          </ul>
                        </div>
                        <div class="col-md-4 ">
                          <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                      
                            <?php

                              if(isset($result['category']))
                              for($i = ceil(0.6 * count($result['category'])); $i < count($result['category']); $i++)
                              echo '<li>'.$result['category'][$i].'</li>';
                              
                            ?>

                          </ul>
                        </div>























                      </div>
                    </div>
                    <div class="theme-item-page-details-section">
                      <h5 class="theme-item-page-details-section-title">Location</h5>
                      <div class="theme-item-page-map google-map" data-lat="40.7483624" data-lng="-73.9900896" data-tab="false"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 ">
                  <div class="sticky-col _pv-30 _mob-h">
                    <div class="theme-search-area theme-search-area-vert">
                      <div class="theme-search-area-header _mb-20 theme-search-area-header-sm">
                        <h1 class="theme-search-area-title"><span class="currency-symbol">₦</span><?php echo isset($result['price']) ? '<span class="currency-value" data-value="'.$result['price'].'">'.$result['price'].'</span>' : '0';?></h1>
                        <p class="theme-search-area-subtitle"><i class="fa fa-male"></i> <?php echo (isset($result['guests'])) ? $result['guests'] : ''; ?> guests</p>
                        <p class="theme-search-area-subtitle"><i class="fa fa-calendar"></i> <?php echo (isset($result['time'])) ? date("F jS, Y", strtotime($result['time'])) : 'March 7th, 2019'; ?></p>
                      </div>
                      <div class="theme-search-area-form">
                        <div class="row" data-gutter="10">
                          <div class="col-md-6 ">
                            <div class="theme-search-area-section theme-search-area-section-sm theme-search-area-section-curved">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon fa fa-male"></i>
                                <input class="theme-search-area-section-input _mob-h" id="firstname" value="" type="text" placeholder="First name"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 ">
                            <div class="theme-search-area-section theme-search-area-section-sm theme-search-area-section-curved">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon fa fa-male"></i>
                                <input class="theme-search-area-section-input _mob-h" id="lastname" value="" type="text" placeholder="Last name"/>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="theme-search-area-section theme-search-area-section-sm theme-search-area-section-curved">
                          <div class="theme-search-area-section-inner">
                            <i class="theme-search-area-section-icon fa fa-envelope"></i>
                            <input class="theme-search-area-section-input" value="" placeholder="Email" id="email" type="text"/>
                          </div>
                        </div>
                        <div class="theme-search-area-section theme-search-area-section-sm theme-search-area-section-curved">
                          <div class="theme-search-area-section-inner">
                            <i class="theme-search-area-section-icon fa fa-phone"></i>
                            <input class="theme-search-area-section-input" value="" placeholder="Phone" id="phone" type="text"/>
                          </div>
                        </div>
                        <div class="theme-item-page-summary-price _mb-20">
                          <a class="theme-item-page-summary-price-link" href="#summaryPriceCollapse" data-toggle="collapse" aria-expanded="false" aria-controls="summaryPriceCollapse">Show summary</a>
                          <div class="collapse" id="summaryPriceCollapse">
                            <ul class="theme-item-page-summary-price-list">
                              <li class="theme-item-page-summary-price-item">
                                <h5 class="theme-item-page-summary-price-item-title">Fee per attendee</h5>
                                <p class="theme-item-page-summary-price-item-subtitle"></p>
                                <p class="theme-item-page-summary-price-item-price" data-price="<?php echo isset($result['price']) ? $result['price'] : '0';?>"><span class="currency-symbol">₦</span><?php echo isset($result['price']) ? '<span class="currency-value" data-value="'.$result['price'].'">'.$result['price'].'</span>' : '0';?></p>
                              </li>
                            </ul>
                          </div>
                          <p class="theme-item-page-summary-price-total" id="total-booking" data-id="<?php echo isset($event_id) ? $event_id : '0';?>">Total Due
                            <span><span class="currency-symbol">₦</span><?php echo isset($result['price']) ? '<span class="currency-value" data-value="'.$result['price'].'">'.$result['price'].'</span>' : '0';?></span>
                          </p>
                        </div>
                        <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved" id="book" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);">Book Now</button>
                      </div>
                    </div>
                  </div>
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
    <script src="../js/fix-events.js"></script>
  </body>
</html>