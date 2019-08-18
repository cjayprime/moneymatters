<?php
  require_once('../database.php');
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Weddings / Home</title>
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
  $options = array('page' => 'wedding', 'subpage' => 'index');
  require_once('../header.php');
?>











<div class="theme-hero-area theme-hero-area-primary">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg ws-action" style="background-image:url(../img/o14abktz5iy_1500x800.jpg);" data-parallax="true"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="theme-hero-area-inner-shadow theme-hero-area-inner-shadow-light"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="_pt-250 _pb-200 _pv-mob-50">
          <div class="container">
            <div class="theme-search-area-tabs">
              <div class="theme-search-area-tabs-header _c-w _ta-mob-c">
                <h3 class="theme-search-area-tabs-title">Find wedding services near you</h3>
                <p class="theme-search-area-tabs-subtitle">Compare several wedding service vendors at once</p>
              </div>
              <div class="tabbable">
                <div class="tab-content _pt-20">
                    <div class="theme-search-area theme-search-area-stacked">
                      <div class="theme-search-area-form">
                        <div class="row" data-gutter="none">
                          <div class="col-md-5 ">
                            <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                <input class="theme-search-area-section-input typeahead" id="location" type="text" placeholder="Apartment Location" data-provide="typeahead"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 ">
                            <div class="row" data-gutter="none">
                              <div class="col-md-6 ">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerStart _mob-h" id="from" value="Wed 06/27" type="text" placeholder="Check-in"/>
                                    <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 ">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerEnd _mob-h" id="to" value="Mon 07/02" type="text" placeholder="Check-out"/>
                                    <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-1 ">
                            <button class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved" id="search-button" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);">Search</button>
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
    </div>
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url(img/patterns/travel/2.png);"></div>
        <div class="theme-hero-area-grad-mask"></div>
        <div class="theme-hero-area-inner-shadow theme-hero-area-inner-shadow-light"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="theme-page-section theme-page-section-xxl">
          <div class="container">
            <div class="theme-page-section-header theme-page-section-header-white">
              <h5 class="theme-page-section-title">Weddings in popular cities</h5>
              <p class="theme-page-section-subtitle">View all weddings in these locations</p>
            </div>
            <div class="theme-inline-slider row" data-gutter="10">
              <div class="owl-carousel owl-carousel-nav-white" data-items="5" data-loop="true" data-nav="true">
                <div class="theme-inline-slider-item">
                  <div class="banner _h-40vh _br-3 _bsh-xs banner-animate banner-animate-mask-in banner-animate-slow">
                    <div class="banner-bg" style="background-image:url(../img/lagos.jpg);"></div>
                    <div class="banner-mask"></div>
                    <a class="banner-link" href="results.php?location=lagos"></a>
                    <div class="banner-caption _p-20 _bg-w banner-caption-bottom banner-caption-dark">
                      <h5 class="banner-title _fs _fw-b">Lagos</h5>
                      <p class="banner-subtitle _fw-n _mt-5">City of Excellence</p>
                    </div>
                  </div>
                </div>
                <div class="theme-inline-slider-item">
                  <div class="banner _h-40vh _br-3 _bsh-xs banner-animate banner-animate-mask-in banner-animate-slow">
                    <div class="banner-bg" style="background-image:url(../img/kano.jpg);"></div>
                    <div class="banner-mask"></div>
                    <a class="banner-link" href="results.php?location=kano"></a>
                    <div class="banner-caption _p-20 _bg-w banner-caption-bottom banner-caption-dark">
                      <h5 class="banner-title _fs _fw-b">Kano</h5>
                      <p class="banner-subtitle _fw-n _mt-5">Centre of Commerce</p>
                    </div>
                  </div>
                </div>
                <div class="theme-inline-slider-item">
                  <div class="banner _h-40vh _br-3 _bsh-xs banner-animate banner-animate-mask-in banner-animate-slow">
                    <div class="banner-bg" style="background-image:url(../img/enugu.jpg);"></div>
                    <div class="banner-mask"></div>
                    <a class="banner-link" href="results.php?location=enugu"></a>
                    <div class="banner-caption _p-20 _bg-w banner-caption-bottom banner-caption-dark">
                      <h5 class="banner-title _fs _fw-b">Enugu</h5>
                      <p class="banner-subtitle _fw-n _mt-5">Coal City State</p>
                    </div>
                  </div>
                </div>
                <div class="theme-inline-slider-item">
                  <div class="banner _h-40vh _br-3 _bsh-xs banner-animate banner-animate-mask-in banner-animate-slow">
                    <div class="banner-bg" style="background-image:url(../img/yobe.jpg);"></div>
                    <div class="banner-mask"></div>
                    <a class="banner-link" href="results.php?location=yobe"></a>
                    <div class="banner-caption _p-20 _bg-w banner-caption-bottom banner-caption-dark">
                      <h5 class="banner-title _fs _fw-b">Yobe</h5>
                      <p class="banner-subtitle _fw-n _mt-5">The Young Shall Grow</p>
                    </div>
                  </div>
                </div>
                <div class="theme-inline-slider-item">
                  <div class="banner _h-40vh _br-3 _bsh-xs banner-animate banner-animate-mask-in banner-animate-slow">
                    <div class="banner-bg" style="background-image:url(../img/abia.jpg);"></div>
                    <div class="banner-mask"></div>
                    <a class="banner-link" href="results.php?location=abia"></a>
                    <div class="banner-caption _p-20 _bg-w banner-caption-bottom banner-caption-dark">
                      <h5 class="banner-title _fs _fw-b">Abia</h5>
                      <p class="banner-subtitle _fw-n _mt-5">God’s Own State</p>
                    </div>
                  </div>
                </div>
                <div class="theme-inline-slider-item">
                  <div class="banner _h-40vh _br-3 _bsh-xs banner-animate banner-animate-mask-in banner-animate-slow">
                    <div class="banner-bg" style="background-image:url(../img/abuja.jpg);"></div>
                    <div class="banner-mask"></div>
                    <a class="banner-link" href="results.php?location=abuja"></a>
                    <div class="banner-caption _p-20 _bg-w banner-caption-bottom banner-caption-dark">
                      <h5 class="banner-title _fs _fw-b">Abuja</h5>
                      <p class="banner-subtitle _fw-n _mt-5">Center of Unity</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section theme-page-section-xxl">
      <div class="container">
        <div class="theme-page-section-header">
              <h5 class="theme-page-section-title">What services do you need?</h5>
              <p class="theme-page-section-subtitle">Discover & connect with great vendors</p>
        </div>
        <div class="row row-col-gap" data-gutter="10">
          <div class="col-md-4 ">
            <div class="banner _h-40vh _br-3 banner-animate banner-animate-mask-in banner-animate-very-slow banner-animate-zoom-in">
              <div class="banner-bg" style="background-image:url(../img/Djs.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?category=dj"></a>
              <div class="banner-caption _pt-100 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">DJs</h5>
              </div>
            </div>
          </div>
          <div class="col-md-8 ">
            <div class="banner _h-40vh _br-3 banner-animate banner-animate-mask-in banner-animate-very-slow banner-animate-zoom-in">
              <div class="banner-bg" style="background-image:url(../img/videographjbf.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?category=videographer"></a>
              <div class="banner-caption _pt-100 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Videographer</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _h-33vh _br-3 banner-animate banner-animate-mask-in banner-animate-very-slow banner-animate-zoom-in">
              <div class="banner-bg" style="background-image:url(../img/sdlnfkbnkfhkhg.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?category=security"></a>
              <div class="banner-caption _pt-100 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Security</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _h-33vh _br-3 banner-animate banner-animate-mask-in banner-animate-very-slow banner-animate-zoom-in">
              <div class="banner-bg" style="background-image:url(../img/lkahklsklfns.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?category=caterer"></a>
              <div class="banner-caption _pt-100 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Caterers</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _h-33vh _br-3 banner-animate banner-animate-mask-in banner-animate-very-slow banner-animate-zoom-in">
              <div class="banner-bg" style="background-image:url(../img/lkklsnss.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?category=venue"></a>
              <div class="banner-caption _pt-100 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Venues</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="banner _h-33vh _br-3 banner-animate banner-animate-mask-in banner-animate-very-slow banner-animate-zoom-in">
              <div class="banner-bg" style="background-image:url(../img/ojsgkhskhgkjhs.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?category=photographer"></a>
              <div class="banner-caption _pt-100 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Photographers</h5>
              </div>
            </div>
          </div>
          <div class="col-md-8 ">
            <div class="banner _h-40vh _br-3 banner-animate banner-animate-mask-in banner-animate-very-slow banner-animate-zoom-in">
              <div class="banner-bg" style="background-image:url(../img/Mae-up.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?category=makeup"></a>
              <div class="banner-caption _pt-100 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">Makeup Artists</h5>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="banner _h-40vh _br-3 banner-animate banner-animate-mask-in banner-animate-very-slow banner-animate-zoom-in">
              <div class="banner-bg" style="background-image:url(../img/mc.jpg);"></div>
              <div class="banner-mask"></div>
              <a class="banner-link" href="results.php?category=mc"></a>
              <div class="banner-caption _pt-100 banner-caption-bottom banner-caption-grad">
                <h5 class="banner-title">MCs</h5>
              </div>
            </div>
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
                            <p class="theme-mobile-app-subtitle">Book and manage your trips on the go. Be notified of our hot deals and offers.</p>
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
    <script src="../js/fix-weddings.js"></script>
  </body>
</html>