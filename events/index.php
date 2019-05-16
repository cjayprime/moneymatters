<?php
    
    require_once('../database.php');
    
    
    // Lagos
    $sql = "SELECT * FROM `event` WHERE LOWER(`state`) = LOWER('lagos')  ORDER BY `views` desc  LIMIT 10";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $results_lagos = array();
    if($num > 0){
      while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        array_push($results_lagos,$rows);
        $results_lagos[count($results_lagos) - 1]['pictures'] = json_decode($rows['pictures'],true);
      }
    }
    

    // Abuja
    $sql = "SELECT * FROM `event` WHERE LOWER(`state`) = LOWER('abuja') ORDER BY `views` desc  LIMIT 10";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $results_abuja = array();
    if($num > 0){
      while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        array_push($results_abuja,$rows);
        $results_abuja[count($results_abuja) - 1]['pictures'] = json_decode($rows['pictures'],true);
      }
    }
    

    // Kaduna
    $sql = "SELECT * FROM `event` WHERE LOWER(`state`) = LOWER('kaduna') ORDER BY `views` desc  LIMIT 10";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $results_kaduna = array();
    if($num > 0){
      while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        array_push($results_kaduna,$rows);
        $results_kaduna[count($results_kaduna) - 1]['pictures'] = json_decode($rows['pictures'],true);
      }
    }
    

    // Count
    $sql = "SELECT COUNT(*) AS count FROM `event`";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $results_count = 0;
    if($num > 0){
      $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $results_count = $rows['count'];
    }

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Events / Home</title>
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
      $options = array('page' => 'events', 'subpage' => 'index');
      require_once('../header.php');
    ?>










    
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg theme-hero-area-bg-blur" style="background-image:url(../img/food-on-table-326278_1800x500.jpeg);"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-strong"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="_pb-100 _pt-150 _pv-mob-60">
            <div class="theme-search-area theme-search-area-stacked">
              <div class="theme-search-area-header _c-w">
                <h1 class="theme-search-area-title theme-search-area-title-lg">Search for
                  <br/>Events
                </h1>
                <p class="theme-search-area-subtitle">Explore <?php echo $results_count; ?> events from all over the world</p>
              </div>
              <div class="theme-search-area-form" id="hero-search-form">
                <div class="row" data-gutter="none">
                  <div class="col-md-4 ">
                    <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                      <div class="theme-search-area-section-inner">
                        <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                        <input class="theme-search-area-section-input typeahead" id="location" type="text" placeholder="Location" data-provide="typeahead"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7 ">
                    <div class="row" data-gutter="none">
                      <div class="col-md-4 ">
                        <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                          <div class="theme-search-area-section-inner">
                            <i class="theme-search-area-section-icon lin lin-calendar"></i>
                            <input class="theme-search-area-section-input datePickerStart _mob-h" id="from" value="Wed 06/27" type="text" placeholder="Check-in"/>
                            <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 ">
                        <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                          <div class="theme-search-area-section-inner">
                            <i class="theme-search-area-section-icon lin lin-calendar"></i>
                            <input class="theme-search-area-section-input datePickerEnd _mob-h" id="to" value="Mon 07/02" type="text" placeholder="Check-out"/>
                            <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 ">
                        <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr quantity-selector" data-increment="Guests">
                          <div class="theme-search-area-section-inner">
                            <i class="theme-search-area-section-icon lin lin-people"></i>
                            <input class="theme-search-area-section-input" id="guests" value="1 Guests" type="text"/>
                            <div class="quantity-selector-box" id="ExpSearchGuests">
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
                      </div>
                    </div>
                  </div>
                  <div class="col-md-1 ">
                    <button id="search-button" class="theme-search-area-submit _mt-0 theme-search-area-submit-glow theme-search-area-submit-curved theme-search-area-submit-no-border"  style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);">
                      <i class="theme-search-area-submit-icon fa fa-angle-right"></i>
                      <span class="_desk-h">Search</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="_pt-60">
              <div class="row row-col-mob-gap" data-gutter="60">
                <div class="col-md-3 ">
                  <div class="feature">
                    <i class="feature-icon _mr-20 feature-icon-white feature-icon-xl fa fa-trophy"></i>
                    <div class="feature-caption _c-w">
                      <h5 class="feature-title _mb-10">Gifts & Rewards</h5>
                      <p class="feature-subtitle _op-06">Get even more from our service. Spend less and travel more</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 ">
                  <div class="feature">
                    <i class="feature-icon _mr-20 feature-icon-white feature-icon-xl fa fa-credit-card"></i>
                    <div class="feature-caption _c-w">
                      <h5 class="feature-title _mb-10">Best prices</h5>
                      <p class="feature-subtitle _op-06">We compare several events to find best price for you</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 ">
                  <div class="feature">
                    <i class="feature-icon _mr-20 feature-icon-white feature-icon-xl fa fa-users"></i>
                    <div class="feature-caption _c-w">
                      <h5 class="feature-title _mb-10">3.5m Travelers</h5>
                      <p class="feature-subtitle _op-06">Enjoyed our service from all around the world</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 ">
                  <div class="feature">
                    <i class="feature-icon _mr-20 feature-icon-white feature-icon-xl fa fa-calendar"></i>
                    <div class="feature-caption _c-w">
                      <h5 class="feature-title _mb-10">Trip Manager</h5>
                      <p class="feature-subtitle _op-06">Be in control with your trips by using our free and award winning manager</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section theme-page-section-xl theme-page-section-gray">
      <div class="container">
        <div class="theme-page-section-header _ta-l">
          <h5 class="theme-page-section-title">Explore Events</h5>
          <p class="theme-page-section-subtitle">Discover events by category</p>
        </div>
        <div class="row row-col-gap" data-gutter="10">
          <div class="col-md-3 ">
            <div class="banner _br-4 banner-sqr banner-animate banner-animate-zoom-in banner-animate-very-slow banner-animate-mask-out">
              <div class="banner-bg" style="background-image:url(../img/i7a_qufadzg_800x600.jpg);"></div>
              <a class="banner-link" href="results.php?category=workshop"></a>
              <div class="banner-caption _pt-60 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title _tt-uc _fs-sm _fw-b">Workshops</h5>
                <p class="banner-subtitle _fw-n">Being part of the Workshop is like being part of a really big family.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _br-4 banner-sqr banner-animate banner-animate-zoom-in banner-animate-very-slow banner-animate-mask-out">
              <div class="banner-bg" style="background-image:url(../img/bve-xl2eqku_800x600.jpg);"></div>
              <a class="banner-link" href="results.php?category=concert"></a>
              <div class="banner-caption _pt-60 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title _tt-uc _fs-sm _fw-b">Concerts</h5>
                <p class="banner-subtitle _fw-n">A concert is not just a live rendition of an album. It's a theatrical event.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _br-4 banner-sqr banner-animate banner-animate-zoom-in banner-animate-very-slow banner-animate-mask-out">
              <div class="banner-bg" style="background-image:url(../img/mxbylrhq4fk_800x600.jpg);"></div>
              <a class="banner-link" href="results.php?category=art"></a>
              <div class="banner-caption _pt-60 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title _tt-uc _fs-sm _fw-b">Arts</h5>
                <p class="banner-subtitle _fw-n">The true work of art is but a shadow of the divine perfection.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _br-4 banner-sqr banner-animate banner-animate-zoom-in banner-animate-very-slow banner-animate-mask-out">
              <div class="banner-bg" style="background-image:url(../img/food-on-table-326278_800x600.jpeg);"></div>
              <a class="banner-link" href="results.php?category=food & drink"></a>
              <div class="banner-caption _pt-60 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title _tt-uc _fs-sm _fw-b">Food & Drink</h5>
                <p class="banner-subtitle _fw-n">Recite a blessing over them before and after.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _br-4 banner-sqr banner-animate banner-animate-zoom-in banner-animate-very-slow banner-animate-mask-out">
              <div class="banner-bg" style="background-image:url(../img/landscape-scotland-nature_800x600.jpg);"></div>
              <a class="banner-link" href="results.php?category=nature"></a>
              <div class="banner-caption _pt-60 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title _tt-uc _fs-sm _fw-b">Nature</h5>
                <p class="banner-subtitle _fw-n">Look deep into nature, and then you will understand everything better.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _br-4 banner-sqr banner-animate banner-animate-zoom-in banner-animate-very-slow banner-animate-mask-out">
              <div class="banner-bg" style="background-image:url(../img/zoe4nviem4_800x600.jpg);"></div>
              <a class="banner-link" href="results.php?category=history"></a>
              <div class="banner-caption _pt-60 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title _tt-uc _fs-sm _fw-b">History</h5>
                <p class="banner-subtitle _fw-n">Lacking knowledge of past history is like being a tree without roots.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _br-4 banner-sqr banner-animate banner-animate-zoom-in banner-animate-very-slow banner-animate-mask-out">
              <div class="banner-bg" style="background-image:url(../img/xb__kzbpzhq_800x600.jpg);"></div>
              <a class="banner-link" href="results.php?category=entertainment"></a>
              <div class="banner-caption _pt-60 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title _tt-uc _fs-sm _fw-b">Entertainment</h5>
                <p class="banner-subtitle _fw-n">Entertainment is vast and is a reflection of the society we live in.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _br-4 banner-sqr banner-animate banner-animate-zoom-in banner-animate-very-slow banner-animate-mask-out">
              <div class="banner-bg" style="background-image:url(../img/nyrvisodq2m_800x600.jpg);"></div>
              <a class="banner-link" href="results.php?category=nightlife"></a>
              <div class="banner-caption _pt-60 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title _tt-uc _fs-sm _fw-b">Nightlife</h5>
                <p class="banner-subtitle _fw-n">The darker the night, the brighter the stars, adonishing the skies.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container _pv-60">
      <div class="theme-page-section _pb-0 _pt-0 theme-page-section-lg">
        <div class="theme-page-section-header _ta-l _mb-20">
          <h5 class="theme-page-section-title theme-page-section-title-sm">Best Expericences in Lagos</h5>
          <a class="theme-page-section-header-link _tt-n theme-page-section-header-link-rb" href="results.php?state=lagos">+ Find More</a>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
          <div class="owl-carousel" data-items="5" data-loop="false" data-nav="true">
















            <?php
              for($i = 0; $i < count($results_lagos); $i++){
                echo <<<EOD
                <div class="theme-inline-slider-item">
                  <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                    <div class="banner-bg" style="background-image:url({$results_lagos[$i]['pictures'][0]});"></div>
                    <div class="banner-mask"></div>
                    <a class="banner-link" href="listing.php?id={$results_lagos[$i]['event_id']}"></a>
                    <div class="banner-caption _ph-15 _pb-15 _pt-60 banner-caption-bottom banner-caption-grad">
                      <h5 class="banner-title _fw-b _fs-sm">{$results_lagos[$i]['title']}</h5>
                      <p class="banner-subtitle _fw-n _fs-sm _mt-5">
                      
                      <span class="currency-symbol">₦</span><span class="currency-value" data-value="{$results_lagos[$i]['price']}">{$results_lagos[$i]['price']}</span>
                      per person
                      </p>
                    </div>
                  </div>
                </div>
EOD;
              }

            ?>















          </div>
        </div>
      </div>
      <div class="theme-page-section _pb-0 theme-page-section-lg">
        <div class="theme-page-section-header _ta-l _mb-20">
          <h5 class="theme-page-section-title theme-page-section-title-sm">Best Expericences in Abuja</h5>
          <a class="theme-page-section-header-link _tt-n theme-page-section-header-link-rb" href="results.php?state=abuja">+ Find More</a>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
          <div class="owl-carousel" data-items="5" data-loop="false" data-nav="true">
















              <?php
                for($i = 0; $i < count($results_abuja); $i++){
                  echo <<<EOD
                  <div class="theme-inline-slider-item">
                    <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                      <div class="banner-bg" style="background-image:url({$results_abuja[$i]['pictures'][0]});"></div>
                      <div class="banner-mask"></div>
                      <a class="banner-link" href="listing.php?id={$results_abuja[$i]['event_id']}"></a>
                      <div class="banner-caption _ph-15 _pb-15 _pt-60 banner-caption-bottom banner-caption-grad">
                        <h5 class="banner-title _fw-b _fs-sm">{$results_abuja[$i]['title']}</h5>
                        <p class="banner-subtitle _fw-n _fs-sm _mt-5">
                      
                        <span class="currency-symbol">₦</span><span class="currency-value" data-value="{$results_abuja[$i]['price']}">{$results_abuja[$i]['price']}</span>
                        per person
                        
                        </p>
                      </div>
                    </div>
                  </div>
EOD;
                }

              ?>















        </div>
        </div>
      </div>
      <div class="theme-page-section _pb-0 theme-page-section-lg">
        <div class="theme-page-section-header _ta-l _mb-20">
          <h5 class="theme-page-section-title theme-page-section-title-sm">Best Expericences in Kaduna</h5>
          <a class="theme-page-section-header-link _tt-n theme-page-section-header-link-rb" href="results.php?state=kaduna">+ Find More</a>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
          <div class="owl-carousel" data-items="5" data-loop="false" data-nav="true">
















            <?php
              for($i = 0; $i < count($results_kaduna); $i++){
                echo <<<EOD
                <div class="theme-inline-slider-item">
                  <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                    <div class="banner-bg" style="background-image:url({$results_kaduna[$i]['pictures'][0]});"></div>
                    <div class="banner-mask"></div>
                    <a class="banner-link" href="listing.php?id={$results_kaduna[$i]['event_id']}"></a>
                    <div class="banner-caption _ph-15 _pb-15 _pt-60 banner-caption-bottom banner-caption-grad">
                      <h5 class="banner-title _fw-b _fs-sm">{$results_kaduna[$i]['title']}</h5>
                      <p class="banner-subtitle _fw-n _fs-sm _mt-5">
                      
                      <span class="currency-symbol">₦</span><span class="currency-value" data-value="{$results_kaduna[$i]['price']}">{$results_kaduna[$i]['price']}</span>
                      per person
                      
                      </p>
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
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url(../img/ugx2qdjdkkw_1500x800.jpeg);"></div>
        <div class="theme-hero-area-inner-shadow theme-hero-area-inner-shadow-light"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="theme-page-section _p-0">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <div class="theme-mobile-app">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="theme-mobile-app-section">
                        <div class="theme-mobile-app-body">
                          <div class="theme-mobile-app-header">
                            <h2 class="theme-mobile-app-title">Download our app</h2>
                            <p class="theme-mobile-app-subtitle">Book and manage events on the go. Be notified of our hot deals and offers.</p>
                          </div>
                          <ul class="theme-mobile-app-btn-list">
                            <li>
                              <a class="btn btn-dark theme-mobile-app-btn" href="#">
                                <i class="theme-mobile-app-logo">
                                  <img src="../img/brands/apple.png" alt="Image Alternative text" title="Image Title"/>
                                </i>
                                <span>Download on
                                  <br/>
                                  <span>App Store</span>
                                </span>
                              </a>
                            </li>
                            <li>
                              <a class="btn btn-dark theme-mobile-app-btn" href="#">
                                <i class="theme-mobile-app-logo">
                                  <img src="../img/brands/play-market.png" alt="Image Alternative text" title="Image Title"/>
                                </i>
                                <span>Download on
                                  <br/>
                                  <span>Play Market</span>
                                </span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="theme-mobile-app-section"></div>
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
    <script src="../js/fix-events.js"></script>
  </body>
</html>