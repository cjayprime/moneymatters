<?php
    
    require_once('../database.php');

    // GET: URL request
    $result_size = 30;
    $result_start = isset($_GET['start']) ? $_GET['start'] : 0;
    $location = isset($_GET['location']) ? $_GET['location'] : 'Lagos';
    $from = isset($_GET['from']) ? $_GET['from'] : '2019-06-27';
    $to = isset($_GET['to']) ? $_GET['to'] : '2019-06-29';
    $guests = isset($_GET['guests']) ? $_GET['guests'] : 1;
    $category = isset($_GET['category']) ? $_GET['category'] : array();
    $title = isset($_GET['title']) ? $_GET['title'] : '';
    $price_min = isset($_GET['price']) && isset($_GET['price']['min']) && is_numeric($_GET['price']['min']) ? $_GET['price']['min'] : 0;
    $price_max = isset($_GET['price']) && isset($_GET['price']['max']) && is_numeric($_GET['price']['max']) ? $_GET['price']['max'] : 500;
    $price_current_max = $price_max;
    $price_current_min = $price_min;
    $duration_min = isset($_GET['duration']) && isset($_GET['duration']['min']) && is_numeric($_GET['duration']['min']) ? $_GET['duration']['min'] : 0;
    $duration_max = isset($_GET['duration']) && isset($_GET['duration']['max']) && is_numeric($_GET['duration']['max']) ? $_GET['duration']['max'] : 100;
    $duration_current_max = $duration_max;
    $duration_current_min = $duration_min;

    $result_start = mysqli_real_escape_string($database,$result_start);
    $location_ = mysqli_real_escape_string($database,$location);
    $category_ = mysqli_real_escape_string($database,json_encode($category));
    $sql = "SELECT * FROM `event` WHERE 
        ((`full_address` LIKE '%$location_%' OR `country` LIKE '%$location_%' OR `state` LIKE '%$location_%' OR `city` LIKE '%$location_%')
        OR 
        (`time` BETWEEN '$from' AND '$to')
        OR 
        (`guests` BETWEEN '0' AND '$guests')
        OR 
        (JSON_CONTAINS(LOWER(`category`),'".strtolower($category_)."') = 1))
        AND
        (`price` >= '$price_min' AND `price` <= '$price_max')
        LIMIT ".$result_start.", ".$result_size;
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);

//echo $sql;
//echo mysqli_error($database);

    $results = array();
    if($num > 0){
      while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        array_push($results,
          array(
            'id'=>$rows['event_id'],
            'title'=>$rows['title'],
            'time'=>$rows['time'],
            'price'=>$rows['price'],
            'duration'=>$rows['duration'],
            'category'=>$rows['category'],
            'guests'=>$rows['guests'],
            'images'=>json_decode($rows['pictures'],true)
          )
        );
      }
    }
    $result_count = count($results);

    // The prices must be reset to reflect the search $price_min, EVEN THOUGH ACTUAL SEARCH WILL BE DONE WITH THE PRICE PARAMETERS
    $sql= "SELECT MAX(`price`) AS max, MIN(`price`) AS min FROM `event`";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    if($num > 0){
      $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $price_current_max = $price_max;
      $price_current_min = $price_min;
      $price_max = $rows['max'];
      $price_min = $rows['min'];
    }

    // The duration must be reset to reflect the search $price_min, EVEN THOUGH ACTUAL SEARCH WILL BE DONE WITH THE PRICE PARAMETERS
    $sql= "SELECT MAX(`duration`) AS max, MIN(`duration`) AS min FROM `event`";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    if($num > 0){
      $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $duration_current_max = $duration_max;
      $duration_current_min = $duration_min;
      $duration_max = $rows['max'];
      $duration_min = $rows['min'];
    }



    // Admin
    $sql = "SELECT `category` FROM `admin` WHERE `title` = 'moneymatters' AND `page` = 'event' AND `access` = 'system'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $admin = array();
    if($num > 0){
      $admin = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $admin['category'] = json_decode($admin['category'],true);
    }
    
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Events / Search</title>
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
      $options = array('page' => 'events', 'subpage' => 'results');
      require_once('../header.php');
    ?>










    
    <div class="theme-hero-area front">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg theme-hero-area-bg-blur" style="background-image:url(../img/gmtx7uc6lnc_1500x800.jpg);"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-strong"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row _pv-100 _pv-mob-50">
            <div class="col-md-9 ">
              <div class="theme-search-area _mob-h theme-search-area-white">
                <div class="theme-search-area-header _mb-20">
                  <h1 class="theme-search-area-title theme-search-area-title-sm">We found <?php echo $result_count; ?> events</h1>
                  <p class="theme-search-area-subtitle">You can change the search criterion below and search again</p>
                </div>
                <div class="theme-search-area-form" id="hero-search-form">
                  <div class="row" data-gutter="20">
                    <div class="col-md-5 ">
                      <div class="theme-search-area-section first theme-search-area-section-line theme-search-area-section-sm">
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                          <input class="theme-search-area-section-input typeahead" id="location" value="<?php echo $location;?>" type="text" placeholder="Hotel Location" data-provide="typeahead"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 ">
                      <div class="row" data-gutter="20">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line theme-search-area-section-sm">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerStart _mob-h" id="from" value="Wed 06/27" type="text" placeholder="Check-in"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="<?php echo $from;?>" type="date"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-line theme-search-area-section-sm">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerEnd _mob-h" id="to" value="Mon 07/02" type="text" placeholder="Check-out"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="<?php echo $to;?>" type="date"/>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2 ">
                      <div class="row" data-gutter="20">
                        <div class="col-md-12 ">
                          <div class="theme-search-area-section theme-search-area-section-line theme-search-area-section-sm quantity-selector" data-increment="Guests">
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-people"></i>
                              <input class="theme-search-area-section-input" id="guests" value="<?php echo $guests;?> Guests" type="text"/>
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
                    </div>
                    <div class="col-md-1 ">
                      <button id="search-button" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);" class="theme-search-area-submit _mt-0 theme-search-area-submit-curved theme-search-area-submit-sm">
                        <i class="theme-search-area-submit-icon fa fa-angle-right"></i>
                        <span class="_desk-h">Search</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
                <h4 class="theme-search-area-inline-title">London Experiences</h4>
                <p class="theme-search-area-inline-details">June 27 &rarr; July 02, 2 Guests</p>
                <a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal">
                  <i class="fa fa-pencil"></i>Edit
                </a>
                <div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">
                  <div class="theme-search-area theme-search-area-vert">
                    <div class="theme-search-area-header">
                      <h1 class="theme-search-area-title theme-search-area-title-sm">Edit your Search</h1>
                      <p class="theme-search-area-subtitle">Prices might be different from current results</p>
                    </div>
                    <div class="theme-search-area-form">
                      <div class="theme-search-area-section first theme-search-area-section-curved">
                        <label class="theme-search-area-section-label">Where</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                          <input class="theme-search-area-section-input typeahead" value="New York" type="text" placeholder="Destination" data-provide="typeahead"/>
                        </div>
                      </div>
                      <div class="row" data-gutter="10">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved">
                            <label class="theme-search-area-section-label">From</label>
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved">
                            <label class="theme-search-area-section-label">To</label>
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row" data-gutter="10">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved quantity-selector" data-increment="Guests">
                            <label class="theme-search-area-section-label">Guests</label>
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
                        </div>
                      </div>
                      <div class="row" data-gutter="10">
                        <div class="col-md-6 ">
                          <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>
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
    <div class="theme-page-section theme-page-section-gray">
      <div class="container">
        <div class="row row-col-static" id="sticky-parent">
          <div class="col-md-9 ">
            <div class="theme-search-results-sort-select _desk-h">
              <select>
                <option>Price</option>
                <option>Guest Rating</option>
                <option>Property Class</option>
                <option>Property Name</option>
                <option>Recommended</option>
                <option>Most Popular</option>
                <option>Trendy Now</option>
                <option>Best Deals</option>
              </select>
            </div>
            <div class="theme-search-results _mb-10">
              <div class="row row-col-gap" data-gutter="10">
                
                
                
                
                
                
                
                
                
                
            <?php
                for($i = 0; $i < count($results); $i++){
                  $date = date("F jS, Y", strtotime($results[$i]['time']));
                  echo 

                    <<<EOT
                      <div class="col-md-4 ">
                        <div class="theme-search-results-item _br-3 theme-search-results-item-grid">
                          <div class="theme-search-results-item-grid-body-full">
                            <div class="banner _h-45vh banner-">
                              <div class="banner-bg" style="background-image:url({$results[$i]['images'][0]});"></div>
                              <div class="banner-caption banner-caption-bottom banner-caption-grad">
                                <div class="theme-search-results-item-grid-header">
                                  <h5 class="theme-search-results-item-title _fs">{$results[$i]['title']}</h5>
                                </div>
                                <div class="theme-search-results-item-grid-caption">
                                  <div class="row" data-gutter="10">
                                    <div class="col-xs-9 ">
                                      <div class="theme-search-results-item-rating">
                                      <p class="theme-search-results-item-rating-title">
                                        <i class="fa fa-male"></i> 
                                        {$results[$i]['guests']} guests
                                      </p>
                                      <p class="theme-search-results-item-rating-title">
                                        <i class="fa fa-calendar"></i> 
                                         {$date}
                                      </p>
                                      </div>
                                    </div>
                                    <div class="col-xs-3 ">
                                      <div class="theme-search-results-item-price">
                                        <p class="theme-search-results-item-price-tag"><span class="currency-symbol">₦</span><span class="currency-value" data-value="{$results[$i]['price']}">{$results[$i]['price']}</span></p>
                                        <p class="theme-search-results-item-price-sign">/ person</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <a class="theme-search-results-item-mask-link" href="listing.php?id={$results[$i]['id']}"></a>
                          </div>
                        </div>
                      </div>
EOT;
                }          
                
                
                


                ?>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
              </div>
              <div class="theme-search-results-mobile-filters" id="mobileFilters">
                <a class="theme-search-results-mobile-filters-btn magnific-inline" href="#MobileFilters">
                  <i class="fa fa-filter"></i>Filters
                </a>
                <div class="magnific-popup mfp-hide" id="MobileFilters">
                  <div class="theme-search-results-sidebar">
                    <div class="theme-search-results-sidebar-sections">
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Type</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Immersions
                                  <span class="icheck-sub-title">Happen over multiple days</span>
                                </span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">386</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Experiences
                                  <span class="icheck-sub-title">Last 2 or more hours</span>
                                </span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">384</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Price</h5>
                        <div class="theme-search-results-sidebar-section-price">
                          <input id="price-slider-mob" name="price-slider" data-min="100" data-max="500"/>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Review Score</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Excellent</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">171</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Good</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">163</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Okay</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">265</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Mediocre</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">449</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Poor</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">346</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Category</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Arts</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">377</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Business</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">222</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Entertainment</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">111</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Fashion</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">172</span>
                            </div>
                          </div>
                          <div class="collapse" id="mobile-SearchResultsCheckboxCategory">
                            <div class="theme-search-results-sidebar-section-checkbox-list-items theme-search-results-sidebar-section-checkbox-list-items-expand">
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Food &amp; Drink</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">124</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">History</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">293</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Music</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">330</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Lifestyle</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">133</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Nature</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">186</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Nightlife</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">163</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Social Impact</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">390</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Sports</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">251</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Technology</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">462</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Wellness</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">123</span>
                              </div>
                            </div>
                          </div>
                          <a class="theme-search-results-sidebar-section-checkbox-list-expand-link" role="button" data-toggle="collapse" href="#mobile-SearchResultsCheckboxCategory" aria-expanded="false">Show more
                            <i class="fa fa-angle-down"></i>
                          </a>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Neighborhoods</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Westminster</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">361</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Kensington</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">418</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Camden</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">310</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Hammersmith</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">242</span>
                            </div>
                          </div>
                          <div class="collapse" id="mobile-SearchResultsCheckboxNeighborhoods">
                            <div class="theme-search-results-sidebar-section-checkbox-list-items theme-search-results-sidebar-section-checkbox-list-items-expand">
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Southwark</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">255</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Tower Hamlets</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">439</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Islington</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">122</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">City of London</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">478</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Lambeth</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">150</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Hackney</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">499</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Greenwich</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">360</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Wandsworth</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">464</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Lewisham</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">410</span>
                              </div>
                            </div>
                          </div>
                          <a class="theme-search-results-sidebar-section-checkbox-list-expand-link" role="button" data-toggle="collapse" href="#mobile-SearchResultsCheckboxNeighborhoods" aria-expanded="false">Show more
                            <i class="fa fa-angle-down"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
            
            
            
            
            
            <?php
              // Redirect to the same page for pagination

              // If equivalent then check for more
              if($result_count == $result_size){
                $url = "http".(!empty($_SERVER['HTTPS'])?"s":"")."://".$_SERVER['SERVER_NAME'].parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
              
                if(count($_GET) > 0){
                  $_GET['start'] = ($result_count + $result_start);
                  $get = '';
                  $i = 0;
                  foreach($_GET as $key => $value){
                    if(gettype($value) == 'array'){
                      foreach($value as $key_ => $value_){
                      $get .= $i == 0 ? '?'.$key.'['.$key_.']='.$value_ : '&'.$key.'['.$key_.']='.$value_;}
                    }else{
                      $get .= $i == 0 ? '?'.$key.'='.$value : '&'.$key.'='.$value;
                    }
                    $i++;
                  }
                }else $get = '?start=10';

                echo '<a class="btn _tt-uc _fs-sm btn-white btn-block btn-lg" href="'.$url.$get.'">Load More Results</a>';
              }else{
                if($result_count == 0){
                  echo '<a class="btn _tt-uc _fs-sm btn-white btn-block btn-lg" href="./">No Results Found</a>';
                }else{
                  echo '<a class="btn _tt-uc _fs-sm btn-white btn-block btn-lg" href="./">No More Results</a>';
                }
              }
            ?>







          </div>
          <div class="col-md-3 ">
            <div class="sticky-col _mob-h">
              <div class="theme-search-results-sidebar">
                <div class="theme-search-results-sidebar-map-view">
                  <a class="theme-search-results-sidebar-map-view-link" href="#"></a>
                  <div class="theme-search-results-sidebar-map-view-body">
                    <i class="fa fa-search theme-search-results-sidebar-map-view-icon"></i>
                    <p class="theme-search-results-sidebar-map-view-sign">Search Options</p>
                  </div>
                  <div class="theme-search-results-sidebar-map-view-mask"></div>
                </div>
                <div class="theme-search-results-sidebar-sections _mb-20 _br-2">
                  <div class="theme-search-results-sidebar-section">
                    <h5 class="theme-search-results-sidebar-section-title">Price</h5>
                    <div class="theme-search-results-sidebar-section-price">
                      <input id="price-slider" name="price-slider"<?php echo ' data-from="'.$price_current_min.'" data-to="'.$price_current_max.'" data-min="'.$price_min.'" data-max="'.$price_max.'"'?>/>
                    </div>
                  </div>
                  <div class="theme-search-results-sidebar-section">
                    <h5 class="theme-search-results-sidebar-section-title">Duration</h5>
                    <div class="theme-search-results-sidebar-section-price">
                      <input id="duration" name="duration" <?php echo ' data-from="'.$duration_current_min.'" data-to="'.$duration_current_max.'" data-min="'.$duration_min.'" data-max="'.$duration_max.'"'?>/>
                    </div>
                  </div>
                  <div class="theme-search-results-sidebar-section">
                    <h5 class="theme-search-results-sidebar-section-title">Title</h5>
                    <div class="theme-search-results-sidebar-section-price">
                      <input id="title" name="title" placeholder="Enter a title" value="<?php echo $title;?>" type="text" style="width:100%" />
                    </div>
                  </div>
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  <?php
                    // SEARCH: The parameters for search
                    foreach($admin as $key => $value){
                      echo '
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">'.$key.'</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          ';
                      for($i = 0; $i < (count($admin[$key])); $i++){
                        
                        $sql = "SELECT COUNT(*) AS total FROM `event` WHERE JSON_SEARCH(LOWER(`event`.`".$key."`),'one','".strtolower(mysqli_real_escape_string($database,$admin[$key][$i]))."') IS NOT NULL";
                        $query = mysqli_query($database,$sql);
                        $num = mysqli_num_rows($query);
                        //echo mysqli_error($database);
                        $amount = 0;
                        if($num > 0){
                          $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
                          $amount = $row['total'];
                        }

                        if($i == 0){
                          // First set of tags (which are outside of the slider)
                          echo '<div class="theme-search-results-sidebar-section-checkbox-list-items">';
                        }elseif($i == ceil(0.5 * count($admin[$key]))){
                          // Opening tags of slider that opens for more options
                          $ref = 'SearchResultsCheckbox'.ucwords($key);
                          echo '<div class="collapse" id="'.$ref.'">
                                <div class="theme-search-results-sidebar-section-checkbox-list-items theme-search-results-sidebar-section-checkbox-list-items-expand">';
                        }

                        $checked = '';
                        //$$key is a variable's variable used to reference the GET parameter that $key resolves to.
                        if(isset($$key) && !empty($$key) && is_array($$key)){
                          $loop = $$key;
                          for($j = 0; $j < count($loop); $j++){
                            if(strtolower($admin[$key][$i]) == strtolower($loop[$j]))
                            $checked = 'checked="true"';
                          }
                        }
                        $name = strtolower($admin[$key][$i]);
                        echo <<<EOD
                          <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                            <label class="icheck-label">
                              <input class="icheck search-options" data-name="{$key}-{$name}" type="checkbox" {$checked}/>
                              <span class="icheck-title">{$admin[$key][$i]}</span>
                            </label>
                            <span class="theme-search-results-sidebar-section-checkbox-list-amount">{$amount}</span>
                          </div>
EOD;
                        if($i == ceil(0.5 * count($admin[$key])) - 1){
                          // -1 because this must run before the elseif above
                          // Closing of the first set of tags (which are outside of the slider)
                          echo '</div>';
                        }elseif($i == count($admin[$key]) - 1){
                          // Closing of the tags of the slider that opens for more options
                          echo '</div>
                                </div>
                                <a href="#'.$ref.'" class="theme-search-results-sidebar-section-checkbox-list-expand-link" role="button" data-toggle="collapse" aria-expanded="false">
                                  Show more
                                  <i class="fa fa-angle-down"></i>
                                </a>';
                        }

                      } 
                      
                      echo '</div></div>';
                    }
                  ?>





























                  
                  
                  
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