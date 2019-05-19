<?php
  require_once('../database.php');
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Hotels / Home</title>
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
    $options = array('page' => 'hotel', 'subpage' => 'index');
    require_once('../header.php');
  ?>











  <div class="_pt-90 container _pt-mob-30">
      <div class="row">
        <div class="col-md-5 ">
          <div class="theme-search-area-tabs">
            <div class="theme-search-area-tabs-header">
              <h1 class="theme-search-area-tabs-title">Save Big on Hotel Bookings</h1>
              <p class="theme-search-area-tabs-subtitle theme-search-area-tabs-subtitle-sm">Find, compare and book great deals from local & international hotels.</p>
            </div>
            <div class="tabbable">
              <div class="tab-content _pt-20">
                <div class="tab-pane active" id="SearchAreaTabs-1" role="tab-panel">
                  <div class="theme-search-area theme-search-area-vert">
                    <div class="theme-search-area-form">
                      <div class="theme-search-area-section first theme-search-area-section-line">
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                          <input class="theme-search-area-section-input typeahead" id="location" type="text" placeholder="Hotel Location" data-provide="typeahead"/>
                        </div>
                      </div>
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerStart _mob-h" id="checkin" value="Wed 06/27" type="text" placeholder="Check-in"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerEnd _mob-h" id="checkout" value="Mon 07/02" type="text" placeholder="Check-out"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Rooms">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-tag"></i>
                              <input class="theme-search-area-section-input" id="room" value="1 Room" type="text"/>
                              <div class="quantity-selector-box" id="HotelSearchRooms">
                                <div class="quantity-selector-inner">
                                  <p class="quantity-selector-title">Rooms</p>
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
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Guests">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-people"></i>
                              <input class="theme-search-area-section-input" id="guest" value="2 Guests" type="text"/>
                              <div class="quantity-selector-box" id="HotelSearchGuests">
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
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <button id="search-button" class="theme-search-area-submit _mt-20 theme-search-area-submit-curved theme-search-area-submit-primary">Search</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="SearchAreaTabs-2" role="tab-panel">
                  <div class="theme-search-area theme-search-area-vert">
                    <div class="theme-search-area-form">
                      <div class="theme-search-area-section first theme-search-area-section-line">
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                          <input class="theme-search-area-section-input typeahead" type="text" placeholder="Apartment Location" data-provide="typeahead"/>
                        </div>
                      </div>
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Adults">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-people"></i>
                              <input class="theme-search-area-section-input" value="2 Adults" type="text"/>
                              <div class="quantity-selector-box" id="RoomSearchAdults">
                                <div class="quantity-selector-inner">
                                  <p class="quantity-selector-title">Adults</p>
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
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Children">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-people"></i>
                              <input class="theme-search-area-section-input" value="0 Children" type="text"/>
                              <div class="quantity-selector-box" id="RoomSearchChildren">
                                <div class="quantity-selector-inner">
                                  <p class="quantity-selector-title">Children</p>
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
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <button class="theme-search-area-submit _mt-20 theme-search-area-submit-curved theme-search-area-submit-primary">Search</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="SearchAreaTabs-3" role="tab-panel">
                  <div class="theme-search-area theme-search-area-vert">
                    <div class="theme-search-area-form">
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section first theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                              <input class="theme-search-area-section-input typeahead" type="text" placeholder="Departure" data-provide="typeahead"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                              <input class="theme-search-area-section-input typeahead" type="text" placeholder="Arrival" data-provide="typeahead"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Passengers">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-people"></i>
                              <input class="theme-search-area-section-input" value="1 Passenger" type="text"/>
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
                        <div class="col-md-6 "></div>
                      </div>
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <button class="theme-search-area-submit _mt-20 theme-search-area-submit-curved theme-search-area-submit-primary">Search</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="SearchAreaTabs-4" role="tab-panel">
                  <div class="theme-search-area theme-search-area-vert">
                    <div class="theme-search-area-form">
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section first theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                              <input class="theme-search-area-section-input typeahead" type="text" placeholder="Pick up location" data-provide="typeahead"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                              <input class="theme-search-area-section-input typeahead" type="text" placeholder="Drop off location" data-provide="typeahead"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <button class="theme-search-area-submit _mt-20 theme-search-area-submit-curved theme-search-area-submit-primary">Search</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="SearchAreaTabs-5" role="tab-panel">
                  <div class="theme-search-area theme-search-area-vert">
                    <div class="theme-search-area-form">
                      <div class="theme-search-area-section first theme-search-area-section-line">
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                          <input class="theme-search-area-section-input typeahead" type="text" placeholder="Destination" data-provide="typeahead"/>
                        </div>
                      </div>
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Guests">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-people"></i>
                              <input class="theme-search-area-section-input" value="2 Guests" type="text"/>
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
                      <div class="row" data-gutter="30">
                        <div class="col-md-6 ">
                          <button class="theme-search-area-submit _mt-20 theme-search-area-submit-curved theme-search-area-submit-primary">Search</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7 ">
          <div class="theme-tab-slider _mob-h" id="slideTabsSlides">
            <img class="active" src=".././img/700x570.jpg" alt="Image Alternative text" title="Image Title" data-tab="SearchAreaTabs-1"/>
            <img src=".././img/700x570.png" alt="Image Alternative text" title="Image Title" data-tab="SearchAreaTabs-2"/>
            <img src=".././img/700x570.png" alt="Image Alternative text" title="Image Title" data-tab="SearchAreaTabs-3"/>
            <img src=".././img/700x570.png" alt="Image Alternative text" title="Image Title" data-tab="SearchAreaTabs-4"/>
            <img src=".././img/700x570.png" alt="Image Alternative text" title="Image Title" data-tab="SearchAreaTabs-5"/>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section _pt-desk-30 theme-page-section-xxl">
      <div class="container">
        <div class="row row-col-mob-gap" data-gutter="60">
          <div class="col-md-3 ">
            <div class="feature">
              <i class="feature-icon feature-icon-gray feature-icon-box feature-icon-round fa fa-globe"></i>
              <div class="feature-caption _op-07">
                <h5 class="feature-title">Explore Hotels Worldwide</h5>
                <p class="feature-subtitle">Discover and book hotels from around the globe. No matter your destination, your ideal comfort is guaranteed.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="feature">
              <i class="feature-icon feature-icon-gray feature-icon-box feature-icon-round fa fa-gift"></i>
              <div class="feature-caption _op-07">
                <h5 class="feature-title">Exclusive Discounts</h5>
                <p class="feature-subtitle">Get even more from us. Our occasional exclusive deals ensure you save even more on hotel bookings.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="feature">
              <i class="feature-icon feature-icon-gray feature-icon-box feature-icon-round fa fa-credit-card"></i>
              <div class="feature-caption _op-07">
                <h5 class="feature-title">Great Prices Always</h5>
                <p class="feature-subtitle">We search through thousands of hotels to find the best rates, and make sure you always get the best deals.</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ">
            <div class="feature">
              <i class="feature-icon feature-icon-gray feature-icon-box feature-icon-round fa fa-comments-o"></i>
              <div class="feature-caption _op-07">
                <h5 class="feature-title">24/7 Support</h5>
                <p class="feature-subtitle">Issues with your booking? Feel free to contact us anytime, anywhere. We're always happy to help.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section _pt-0 theme-page-section-lg">
      <div class="container">
        <div class="theme-page-section-header _ta-l">
          <h5 class="theme-page-section-title">Recommended Places</h5>
          <p class="theme-page-section-subtitle">Top destinations picked by our stuff</p>
          <a class="theme-page-section-header-link theme-page-section-header-link-rb" href="#">+ More Reccomendations</a>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
          <div class="owl-carousel" data-items="5" data-loop="true" data-nav="true">
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/lagos.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Lagos</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/abuja.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Abuja</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/abia.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Abia</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/enugu.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Enugu</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/kano.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Kano</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/yobe.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Yobe</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section theme-page-section-lg">
      <div class="container">
        <div class="theme-page-section-header _ta-l">
          <h5 class="theme-page-section-title">Most Visited</h5>
          <p class="theme-page-section-subtitle">Popular places in 2018</p>
          <a class="theme-page-section-header-link theme-page-section-header-link-rb" href="#">+ Find More</a>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
          <div class="owl-carousel" data-items="5" data-loop="true" data-nav="true">
          <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/lagos.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Lagos</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/abuja.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Abuja</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/abia.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Abia</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/enugu.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Enugu</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/kano.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Kano</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/yobe.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Yobe</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section theme-page-section-lg">
      <div class="container">
        <div class="theme-page-section-header _ta-l">
          <h5 class="theme-page-section-title">Trending Cities</h5>
          <p class="theme-page-section-subtitle">Most searched cities in June</p>
          <a class="theme-page-section-header-link theme-page-section-header-link-rb" href="#">+ Explore</a>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
          <div class="owl-carousel" data-items="5" data-loop="true" data-nav="true">
          <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/lagos.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Lagos</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/abuja.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Abuja</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/abia.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Abia</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/enugu.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Enugu</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/kano.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Kano</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
            <div class="theme-inline-slider-item">
              <div class="banner _br-4 banner-sqr banner-animate banner-animate-mask-in">
                <div class="banner-bg" style="background-image:url(../img/yobe.jpg);"></div>
                <div class="banner-mask"></div>
                <a class="banner-link" href="#"></a>
                <div class="banner-caption _pt-40 _ph-25 _pb-20 banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title _fs">Yobe</h5>
                  <p class="banner-subtitle _fw-n">Nigeria</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url(../img/friendship_1500x800.jpeg);"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="theme-page-section _pv-100">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="theme-hero-text theme-hero-text-white theme-hero-text-center">
                  <div class="theme-hero-text-header">
                    <h2 class="theme-hero-text-title">Sign up & Save more</h2>
                    <p class="theme-hero-text-subtitle">Subscribe today to unlock even greater deals! Be the first to know, and Save up to 50% on select hotel booking offers.</p>
                  </div>
                  <a class="btn _tt-uc _mt-20 btn-white btn-ghost btn-lg" href="signup.php">Sign Up Now</a>
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
    <script src="../js/fix-hotels.js"></script>
  </body>
</html>