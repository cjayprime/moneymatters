<?php
    
    require_once('../database.php');
    
    // Trending Apartments
    $sql = "SELECT * FROM `property` ORDER BY `views` desc LIMIT 10";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    $results_views_apartments = array();
    if($num > 0){
      while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        array_push($results_views_apartments,$rows);
        $results_views_apartments[count($results_views_apartments) - 1]['pictures'] = json_decode($rows['pictures'],true);
      }
    }
    

    // Recommended Apartments
    $sql = "SELECT * FROM `property` WHERE `featured` = '1'  ORDER BY `views` desc  LIMIT 10";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    echo mysqli_error($database);
    $results_views_recommended = array();
    if($num > 0){
      while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        array_push($results_views_recommended,$rows);
        $results_views_recommended[count($results_views_recommended) - 1]['pictures'] = json_decode($rows['pictures'],true);
      }
    }


    // Admin
    $sql = "SELECT * FROM `admin` WHERE `title` = 'moneymatters' AND `page` = 'property' AND `access` = 'system'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $admin = array();
    if($num > 0){
      $admin = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $admin['type'] = json_decode($admin['type'],true);
    }
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Property / Home</title>
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
      $options = array('page' => 'property', 'subpage' => 'index');
      require_once('../header.php');
    ?>










    
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url(../img/daak8aqd_-i_1500x500.jpeg);" id="hero-banner"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="blur-area" data-bg-area="#hero-banner" data-blur-area="#hero-search-form" data-blur="20"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="theme-search-area _pv-100 theme-search-area-stacked theme-search-area-white">
                <div class="theme-search-area-header _ta-c">
                  <h1 class="theme-search-area-title">Buy or rent a property</h1>
                  <p class="theme-search-area-subtitle">Find and reserve your next home in minutes.</p>
                </div>
                <div class="theme-search-area-form" id="hero-search-form">
                  <div class="row" data-gutter="none">
                    <div class="col-md-5 ">
                      <div class="theme-search-area-section first theme-search-area-section-curved">
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                          <input class="theme-search-area-section-input typeahead" id="location" type="text" placeholder="Apartment Location" data-provide="typeahead"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="row" data-gutter="none">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved quantity-selector" data-increment="Guests">
                            <div class="theme-search-area-section-inner drop-down-button">
                              <i class="theme-search-area-section-icon lin lin-home"></i>
                              <input class="theme-search-area-section-input" id="type" value="Select type" type="button" style="margin-left:-45px"/>
                              <div class="quantity-selector-box" id="RoomSearchGuests">
                                

                                
                                
                                
                                
                                
                                
                                <?php
                                  for($i = 0; $i < count($admin['type']); $i++)
                                  echo '<div class="quantity-selector-inner"><p class="quantity-selector-title">'.$admin['type'][$i].'</p></div>';

                                ?>







                                
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved quantity-selector" data-increment="Guests">
                            <div class="theme-search-area-section-inner drop-down-button">
                              <i class="theme-search-area-section-icon fa fa-bookmark-o"></i>
                              <input class="theme-search-area-section-input" id="ownership" value="Select status" type="button" style="margin-left:-45px"/>
                              <div class="quantity-selector-box" id="RoomSearchGuests">
                                <div class="quantity-selector-inner">
                                  <p class="quantity-selector-title">Rental</p>
                                </div>
                                <div class="quantity-selector-inner" style="margin-top:10px;">
                                  <p class="quantity-selector-title">Sale</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-1 ">
                      <button class="theme-search-area-submit _mt-0 theme-search-area-submit-glow theme-search-area-submit-curved" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);" id="search-button">
                        <i class="theme-search-area-submit-icon fa fa-angle-right"></i>
                        <span class="_desk-h">Search</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section _pb-0 theme-page-section-xxl">
      <div class="container">
        <div class="row row-col-mob-gap" data-gutter="20">
          <div class="col-md-4 ">
            <div class="banner _br-5 _bsh-xl _bsh-light banner-animate banner-animate-zoom-in">
              <img class="banner-img" src=".././img/rxgcjsathdq_800x600.jpeg" alt="Image Alternative text" title="Image Title"/>
              <div class="banner-caption _bg-p _p-15 _pos-h-c _w-66pct _mb-30 _ta-c _br-3 banner-caption-bottom">
                <h5 class="banner-title">Find a Home</h5>
                <p class="banner-subtitle">Search thousands of listings.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="banner _br-5 _bsh-xl _bsh-light banner-animate banner-animate-zoom-in">
              <img class="banner-img" src=".././img/6vijobrmnbw_800x600.jpeg" alt="Image Alternative text" title="Image Title"/>
              <div class="banner-caption _bg-p _p-15 _pos-h-c _w-66pct _mb-30 _ta-c _br-3 banner-caption-bottom">
                <h5 class="banner-title">Online Reservation</h5>
                <p class="banner-subtitle">Reserve your choosen property online.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="banner _br-5 _bsh-xl _bsh-light banner-animate banner-animate-zoom-in">
              <img class="banner-img" src=".././img/gozxralnit4_800x600.jpeg" alt="Image Alternative text" title="Image Title"/>
              <div class="banner-caption _bg-p _p-15 _pos-h-c _w-66pct _mb-30 _ta-c _br-3 banner-caption-bottom">
                <h5 class="banner-title">24/7 Support</h5>
                <p class="banner-subtitle">Quality support anytime, anywhere.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section theme-page-section-xxl">
      <div class="container">
        <div class="theme-page-section-header">
          <h5 class="theme-page-section-title">Search by Cities</h5>
          <p class="theme-page-section-subtitle">Travellers choices for summer trips</p>
        </div>
        <div class="row row-col-gap" data-gutter="10">
          <div class="col-md-3 ">
            <div class="banner _h-40vh _br-3 banner-animate banner-animate-mask-in">
              <div class="banner-bg" style="background-image:url(../img/enugu.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?location=enugu"></a>
              <div class="banner-caption banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Enugu</h5>
                <p class="banner-subtitle">Coal City</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _h-40vh _br-3 banner-animate banner-animate-mask-in">
              <div class="banner-bg" style="background-image:url(../img/abuja.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?location=abuja"></a>
              <div class="banner-caption banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Abuja</h5>
                <p class="banner-subtitle">Center of Unity</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _h-40vh _br-3 banner-animate banner-animate-mask-in">
              <div class="banner-bg" style="background-image:url(../img/kano.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?location=kano"></a>
              <div class="banner-caption banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Kano</h5>
                <p class="banner-subtitle">Center of Commerce</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _h-40vh _br-3 banner-animate banner-animate-mask-in">
              <div class="banner-bg" style="background-image:url(../img/yobe.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?location=yobe"></a>
              <div class="banner-caption banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Yobe</h5>
                <p class="banner-subtitle">Pride of Sahel</p>
              </div>
            </div>
          </div>
          <div class="col-md-5 ">
            <div class="banner _h-40vh _br-3 banner-animate banner-animate-mask-in">
              <div class="banner-bg" style="background-image:url(../img/abia.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?location=abia"></a>
              <div class="banner-caption banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Abia</h5>
                <p class="banner-subtitle">God's own state</p>
              </div>
            </div>
          </div>
          <div class="col-md-7 ">
            <div class="banner _h-40vh _br-3 banner-animate banner-animate-mask-in">
              <div class="banner-bg" style="background-image:url(../img/lagos.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?location=lagos"></a>
              <div class="banner-caption banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Lagos</h5>
                <p class="banner-subtitle">Center of Excellence</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section _pb-0 theme-page-section-xl theme-page-section-gray">
      <div class="container">
        <div class="theme-page-section-header">
          <h5 class="theme-page-section-title theme-page-section-title-sm">Trending Properties</h5>
          <p class="theme-page-section-subtitle theme-page-section-subtitle-sm">Our in-demand, and most viewed properties this week.</p>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
          <div class="owl-carousel" data-items="5" data-loop="true" data-nav="true">
            




          





          
          



              <?php
                  for($i = 0; $i < count($results_views_apartments); $i++){
                    $duration = (isset($results_views_apartments[$i]['duration']) && isset($results_views_apartments[$i]['status']) && $results_views_apartments[$i]['status'] == 'Sale') ? '/ '.$results_views_apartments[$i]['duration'] : '';
                    echo  <<<EOD
                      <div class="theme-inline-slider-item">
                        <div class="theme-search-results-item _br-2 theme-search-results-item-grid">
                          <div class="banner _h-20vh _h-mob-30vh banner-">
                            <div class="banner-bg" style="background-image:url({$results_views_apartments[$i]['pictures'][0]});"></div>
                          </div>
                          <div class="theme-search-results-item-grid-body">
                            <a class="theme-search-results-item-mask-link" href="listing.php?id={$results_views_apartments[$i]['property_id']}"></a>
                            <div class="theme-search-results-item-grid-header">
                              <h5 class="theme-search-results-item-title _fw-n">{$results_views_apartments[$i]['full_address']}</h5>
                            </div>
                            <div class="theme-search-results-item-grid-caption">
                              <div class="row" data-gutter="10">
                                <div class="col-xs-9 ">
                                  <div class="theme-search-results-item-rating">
                                    <ul class="theme-search-results-item-rating-stars">
                                      <i class="fa fa-bed"></i>
                                      {$results_views_apartments[$i]['bedroom']} beds
                                    </ul>
                                    <p class="theme-search-results-item-rating-title">
                                      <i class="fa fa-bath"></i>
                                      {$results_views_apartments[$i]['bathroom']} baths</p>
                                  </div>
                                </div>
                                <div class="col-xs-3 ">
                                  <div class="theme-search-results-item-price">
                                    <p class="theme-search-results-item-price-tag"><span class="currency-symbol">₦</span><span class="currency-value" data-value="{$results_views_apartments[$i]['price']}">{$results_views_apartments[$i]['price']}</span></p>
                                    <p class="theme-search-results-item-price-sign">{$duration}</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
EOD;
                  }
                ?>
          
          





          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section theme-page-section-xl theme-page-section-gray">
      <div class="container">
        <div class="theme-page-section-header">
          <h5 class="theme-page-section-title theme-page-section-title-sm">Recomended Properties</h5>
          <p class="theme-page-section-subtitle theme-page-section-subtitle-sm">Staff picks just for you.</p>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
          <div class="owl-carousel" data-items="5" data-loop="true" data-nav="true">
            
            




          





          
          



            <?php
                for($i = 0; $i < count($results_views_recommended); $i++){
                  $duration = (isset($results_views_recommended[$i]['duration']) && isset($results_views_recommended[$i]['status']) && $results_views_recommended[$i]['status'] == 'Sale') ? '/ '.$results_views_recommended[$i]['duration'] : '';
                  echo  <<<EOD
                    <div class="theme-inline-slider-item">
                      <div class="theme-search-results-item _br-2 theme-search-results-item-grid">
                        <div class="banner _h-20vh _h-mob-30vh banner-">
                          <div class="banner-bg" style="background-image:url({$results_views_recommended[$i]['pictures'][0]});"></div>
                        </div>
                        <div class="theme-search-results-item-grid-body">
                          <a class="theme-search-results-item-mask-link" href="listing.php?id={$results_views_recommended[$i]['property_id']}"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fw-n">{$results_views_recommended[$i]['full_address']}</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-rating">
                                  <ul class="theme-search-results-item-rating-stars">
                                    <i class="fa fa-bed"></i>
                                    {$results_views_recommended[$i]['bedroom']} beds
                                  </ul>
                                  <p class="theme-search-results-item-rating-title">
                                    <i class="fa fa-bath"></i>
                                    {$results_views_recommended[$i]['bathroom']} baths</p>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag"><span class="currency-symbol">₦</span><span class="currency-value" data-value="{$results_views_recommended[$i]['price']}">{$results_views_recommended[$i]['price']}</span></p>
                                  <p class="theme-search-results-item-price-sign">{$duration}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
EOD;
                }
              ?>
        
        





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
    <script src="../js/fix-properties.js"></script>
  </body>
</html>