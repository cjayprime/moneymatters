<?php
  require_once('../database.php');
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Travel</title>
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
    $options = array('page' => 'travel', 'subpage' => 'index');
    require_once('../header.php');
  ?>











  <div class="_pos-r">
      <div class="theme-hero-area _h-desk-100vh">
        <div class="theme-hero-area-bg-wrap">
          <div class="theme-hero-area-bg" style="background-image:url(../img/1500x801.jpeg);" id="hero-banner"></div>
          <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
          <div class="theme-hero-area-inner-shadow"></div>
          <div class="blur-area" data-bg-area="#hero-banner" data-blur-area="#hero-search-form" data-blur="20"></div>
        </div>
        <div class="theme-hero-area-body _pos-desk-v-c _w-f _pv-mob-60">
          <div class="container">
            <div class="row">
              <div class="col-md-11 ">
                <div class="theme-search-area theme-search-area-stacked theme-search-area-white">
                  <div class="theme-search-area-header _mb-20">
                    <h1 class="theme-search-area-title">Cheap Flights, Best Deals</h1>
                    <p class="theme-search-area-subtitle">Search hundreds of travel sites at once</p>
                  </div>
                  <div class="theme-search-area-form" id="hero-search-form">
                    <div class="row" data-gutter="none">
                      <div class="col-md-5 ">
                        <div class="row" data-gutter="none">
                          <div class="col-md-6 ">
                            <div class="theme-search-area-section first theme-search-area-section-curved">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                <input class="theme-search-area-section-input typeahead" id="departure" type="text" placeholder="Departure" data-provide="typeahead"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 ">
                            <div class="theme-search-area-section theme-search-area-section-curved">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                <input class="theme-search-area-section-input typeahead" id="arrival" type="text" placeholder="Arrival" data-provide="typeahead"/>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="row" data-gutter="none">
                          <div class="col-md-4 ">
                            <div class="theme-search-area-section theme-search-area-section-curved">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                <input class="theme-search-area-section-input datePickerStart _mob-h" id="checkin" value="Wed 06/27" type="text" placeholder="Check-in"/>
                                <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 ">
                            <div class="theme-search-area-section theme-search-area-section-curved">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                <input class="theme-search-area-section-input datePickerEnd _mob-h" id="checkout" value="Mon 07/02" type="text" placeholder="Check-out"/>
                                <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 ">
                            <div class="theme-search-area-section theme-search-area-section-curved quantity-selector" data-increment="Passengers">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-people"></i>
                                <input class="theme-search-area-section-input" id="passenger" value="1 Passenger" type="text"/>
                                <div class="quantity-selector-box" id="FlySearchPassengers">
                                  <div class="quantity-selector-inner">
                                    <p class="quantity-selector-title">Passengers</p>
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
                        <button id="search-button" class="theme-search-area-submit _mt-0 theme-search-area-submit-glow theme-search-area-submit-curved">
                          <i class="theme-search-area-submit-icon fa fa-angle-right"></i>
                          <span class="_desk-h">Search</span>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="theme-search-area-options theme-search-area-options-dot-primary-inverse clearfix">
                    <div class="btn-group theme-search-area-options-list" data-toggle="buttons">
                      <label class="btn btn-primary active">
                        <input type="radio" name="flight-options" id="flight-option-1" checked/>Round Trip
                      </label>
                      <label class="btn btn-primary">
                        <input type="radio" name="flight-options" id="flight-option-2"/>One Way
                      </label>
                    </div>
                  </div>
                </div>
                <div class="_pt-60">
                  <div class="row row-col-mob-gap">
                    <div class="col-md-3 ">
                      <div class="feature">
                        <i class="feature-icon feature-icon-white feature-icon-box feature-icon-round feature-icon-xs fa fa-check"></i>
                        <div class="feature-caption _c-w">
                          <h5 class="feature-title">Explore the World</h5>
                          <p class="feature-subtitle _op-04">Start to discover. We help you visit any place you imagine</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 ">
                      <div class="feature">
                        <i class="feature-icon feature-icon-white feature-icon-box feature-icon-round feature-icon-xs fa fa-check"></i>
                        <div class="feature-caption _c-w">
                          <h5 class="feature-title">Gifts & Rewards</h5>
                          <p class="feature-subtitle _op-04">Get even more from our services. Spend less and travel more</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 ">
                      <div class="feature">
                        <i class="feature-icon feature-icon-white feature-icon-box feature-icon-round feature-icon-xs fa fa-check"></i>
                        <div class="feature-caption _c-w">
                          <h5 class="feature-title">Best prices</h5>
                          <p class="feature-subtitle _op-04">We compare hundreds of travel websites to find the best prices for you</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 ">
                      <div class="feature">
                        <i class="feature-icon feature-icon-white feature-icon-box feature-icon-round feature-icon-xs fa fa-check"></i>
                        <div class="feature-caption _c-w">
                          <h5 class="feature-title">24/7 Support</h5>
                          <p class="feature-subtitle _op-04">Contact us anytime, anywhere. We will resolve any issues immediately</p>
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
      <div class="theme-footer-abs">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <p class="theme-footer-abs-copyright">Copyright &copy; 2019
                <a href="">MoneyMatters</a>. All rights reserved.
              </p>
            </div>
            <div class="col-md-6">
              <ul class="theme-social-list theme-footer-abs-social">
                <li>
                  <a class="fa fa-facebook" href="#"></a>
                </li>
                <li>
                  <a class="fa fa-twitter" href="#"></a>
                </li>
                <li>
                  <a class="fa fa-google" href="#"></a>
                </li>
                <li>
                  <a class="fa fa-instagram" href="#"></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
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
    <script src="../js/fix-travel.js"></script>
  </body>
</html>