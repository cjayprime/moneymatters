<?php
    
    
    require_once('../database.php');
    // GET: URL request
    $result_size = 10;
    $result_start = isset($_GET['start']) ? $_GET['start'] : 0;
    $location = isset($_GET['location']) ? $_GET['location'] : 'Lagos';
    $title = isset($_GET['title']) ? $_GET['title'] : '';
    $from = isset($_GET['from']) ? $_GET['from'] : '2019-06-27';
    $to = isset($_GET['to']) ? $_GET['to'] : '2019-06-29';
    $category = isset($_GET['category']) ? $_GET['category'] : array();
    $title = isset($_GET['title']) ? $_GET['title'] : '';
    $rating = isset($_GET['rating']) ? $_GET['rating'] : array();
    
    $result_start = mysqli_real_escape_string($database,$result_start);
    $location_ = mysqli_real_escape_string($database,$location);
    $category_ = mysqli_real_escape_string($database,json_encode($category));
    $rating_ = mysqli_real_escape_string($database,json_encode($rating));
    $sql = "SELECT * FROM `wedding` WHERE 
        ((`full_address` LIKE '%$location_%' OR `country` LIKE '%$location_%' OR `state` LIKE '%$location_%' OR `city` LIKE '%$location_%')
        OR 
        (`time` BETWEEN '$from' AND '$to')
        OR 
        (JSON_CONTAINS(LOWER(`category`),'".strtolower($category_)."') IS NOT NULL)
        OR 
        (JSON_CONTAINS(LOWER(`category`),'".strtolower($rating_)."') IS NOT NULL))
        LIMIT ".$result_start.", ".$result_size;
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    $results = array();
    if($num > 0){
      while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        array_push($results,
          array(
            'id'=>$rows['wedding_id'],
            'title'=>$rows['title'],
            'time'=>$rows['time'],
            'category'=>$rows['category'],
            'views'=>$rows['views'],
            'address'=>$rows['full_address'],
            'district'=>$rows['district'],
            'city'=>$rows['city'],
            'state'=>$rows['state'],
            'country'=>$rows['country'],
            'rating'=>json_decode($rows['rating'],true),
            'images'=>json_decode($rows['pictures'],true)
          )
        );
      }

      /*// The prices must be reset to reflect the search $price_min, EVEN THOUGH ACTUAL SEARCH WILL BE DONE WITH THE PRICE PARAMETERS
      $sql= "SELECT MAX(`price`) AS max, MIN(`price`) AS min FROM `wedding`";
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
      $sql= "SELECT MAX(`duration`) AS max, MIN(`duration`) AS min FROM `wedding`";
      $query = mysqli_query($database,$sql);
      $num = mysqli_num_rows($query);
      if($num > 0){
        $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $duration_current_max = $duration_max;
        $duration_current_min = $duration_min;
        $duration_max = $rows['max'];
        $duration_min = $rows['min'];
      }*/
    }
    
    $result_count = count($results);




    // Admin
    $sql = "SELECT `category`,`rating` FROM `admin` WHERE `title` = 'moneymatters' AND `page` = 'wedding' AND `access` = 'system'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $admin = array();
    if($num > 0){
      $admin = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $admin['category'] = json_decode($admin['category'],true);
      $admin['rating'] = json_decode($admin['rating'],true);
    }
    
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Wedding / Search</title>
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
  $options = array('page' => 'wedding', 'subpage' => 'results');
  require_once('../header.php');
?>











<div class="theme-hero-area front">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url(../img/gmtx7uc6lnc_1500x800.jpg);" id="hero-banner"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="blur-area" data-bg-area="#hero-banner" data-blur-area="#hero-search-form" data-blur="20"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="_pb-100 _pt-150 _pv-mob-50">
            <div class="theme-search-area _mob-h theme-search-area-stacked theme-search-area-white">
              <div class="theme-search-area-form" id="hero-search-form">
                <div class="row" data-gutter="none">
                  <div class="col-md-6 ">
                    <div class="theme-search-area-section first theme-search-area-section-curved">
                      <div class="theme-search-area-section-inner">
                        <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                        <input class="theme-search-area-section-input typeahead" id="location" value="<?php echo $location;?>" type="text" placeholder="Hotel Location" data-provide="typeahead"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5 ">
                    <div class="row" data-gutter="none">
                      <div class="col-md-6 ">
                        <div class="theme-search-area-section theme-search-area-section-curved">
                          <div class="theme-search-area-section-inner">
                            <i class="theme-search-area-section-icon lin lin-calendar"></i>
                            <input class="theme-search-area-section-input datePickerStart _mob-h" id="from" value="Wed 06/27" type="text" placeholder="Check-in"/>
                            <input class="theme-search-area-section-input _desk-h mobile-picker" value="<?php echo $from;?>" type="date"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="theme-search-area-section theme-search-area-section-curved">
                          <div class="theme-search-area-section-inner">
                            <i class="theme-search-area-section-icon lin lin-calendar"></i>
                            <input class="theme-search-area-section-input datePickerEnd _mob-h" id="to" value="Mon 07/02" type="text" placeholder="Check-out"/>
                            <input class="theme-search-area-section-input _desk-h mobile-picker" value="<?php echo $to;?>" type="date"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-1 ">
                    <button id="search-button" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);" class="theme-search-area-submit _mt-0 theme-search-area-submit-curved theme-search-area-submit-primary">Change</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
              <h4 class="theme-search-area-inline-title">New York Hotels</h4>
              <p class="theme-search-area-inline-details">June 27 &rarr; July 02, 1 Room</p>
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
                        <input class="theme-search-area-section-input typeahead" value="New York" type="text" placeholder="Hotel Location" data-provide="typeahead"/>
                      </div>
                    </div>
                    <div class="row" data-gutter="10">
                      <div class="col-md-6 ">
                        <div class="theme-search-area-section theme-search-area-section-curved">
                          <label class="theme-search-area-section-label">Check In</label>
                          <div class="theme-search-area-section-inner">
                            <i class="theme-search-area-section-icon lin lin-calendar"></i>
                            <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                            <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="theme-search-area-section theme-search-area-section-curved">
                          <label class="theme-search-area-section-label">Check Out</label>
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
                        <div class="theme-search-area-section theme-search-area-section-curved quantity-selector" data-increment="Rooms">
                          <label class="theme-search-area-section-label">Rooms</label>
                          <div class="theme-search-area-section-inner">
                            <i class="theme-search-area-section-icon lin lin-tag"></i>
                            <input class="theme-search-area-section-input" value="1 Room" type="text"/>
                            <div class="quantity-selector-box" id="mobile-HotelSearchRooms">
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
                        <div class="theme-search-area-section theme-search-area-section-curved quantity-selector" data-increment="Guests">
                          <label class="theme-search-area-section-label">Guests</label>
                          <div class="theme-search-area-section-inner">
                            <i class="theme-search-area-section-icon lin lin-people"></i>
                            <input class="theme-search-area-section-input" value="2 Guests" type="text"/>
                            <div class="quantity-selector-box" id="mobile-HotelSearchGuests">
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
                    <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>
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
          <div class="col-md-2-5 ">
            <div class="sticky-col _mob-h">
              <div class="theme-search-results-sidebar">
                <div class="theme-search-results-sidebar-map-view">
                  <a class="theme-search-results-sidebar-map-view-link" href=""></a>
                  <div class="theme-search-results-sidebar-map-view-body">
                    <i class="fa fa-search theme-search-results-sidebar-map-view-icon"></i>
                    <p class="theme-search-results-sidebar-map-view-sign">Search Options</p>
                  </div>
                  <div class="theme-search-results-sidebar-map-view-mask"></div>
                </div>
                <div class="theme-search-results-sidebar-sections">
                  <div class="theme-search-results-sidebar-section">
                    <h5 class="theme-search-results-sidebar-section-title">Search Titles</h5>
                    <div class="theme-search-results-sidebar-section-search">
                      <input id="title" class="theme-search-results-sidebar-section-search-input" value="<?php echo $title; ?>" type="text" placeholder="Title"/>
                      <a class="fa fa-search theme-search-results-sidebar-section-search-btn" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);" href="#"></a>
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
                        if($key == 'rating'){
                          $sql = "SELECT COUNT(*) AS total FROM `wedding` WHERE JSON_CONTAINS(LOWER(`wedding`.`".$key."`),'{\"rating\":".strtolower($admin[$key][$i])."}','$') != 0";
                        }else{
                          $sql = "SELECT COUNT(*) AS total FROM `wedding` WHERE JSON_SEARCH(LOWER(`wedding`.`".$key."`),'one','".strtolower($admin[$key][$i])."') IS NOT NULL";
                        }
                        $query = mysqli_query($database,$sql);
                        $num = mysqli_num_rows($query);
                        
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
                        // $$key is a variable's variable used to reference the GET parameter that $key resolves to,
                        // therefore it is the same as$_GET[$key]
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
              <div class="theme-ad">
                <a class="theme-ad-link" href="#"></a>
                <p class="theme-ad-sign">Advertisement</p>
                <img class="theme-ad-img" src="./img/320x1280.png" alt="Image Alternative text" title="Image Title"/>
              </div>
            </div>
          </div>
          <div class="col-md-9-5 ">
            <div class="theme-search-results">
              <div class="_mob-h">
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                <?php
                  for($i = 0; $i < count($results); $i++){
                    $total_rating = 0;
                    $color_code = '#FFF';
                    for($j = 0; $j < count($results[$i]['rating']); $j++){
                      if($j != count($results[$i]['rating']) - 1){
                        $total_rating += $results[$i]['rating'][$j]['rating'] + $results[$i]['rating'][$j + 1]['rating'];
                      }else{
                        $score = ($total_rating /  ($j+1));
                        $score_comment = (($score == 10) ? 'Excellent' : (($score > 7) ? 'Very Good' : (($score > 5 && $score <= 7) ? 'Good' : (($score >= 3 && $score <= 5) ? 'Fair' : 'Poor'))));
                        $color_code = (($score == 10) ? 'green' : (($score > 7) ? 'blue' : (($score > 5 && $score <= 7) ? 'sky blue' : (($score >= 3 && $score <= 5) ? 'pink' : 'red'))));
                        $total_rating = $score .' '. $score_comment;
                      }
                    }
                    $total_rating = $total_rating ? $total_rating : 'Not yet rated';
                    $rating = count($results[$i]['rating']);
                    $address = $results[$i]['address'] . ', '. $results[$i]['district'] . ', '. $results[$i]['city'] . ', '. $results[$i]['state'] . ', '. $results[$i]['country'];
                    echo <<<EOT
                    <div class="theme-search-results-item _mb-10 theme-search-results-item-full">
                      <div class="theme-search-results-item-preview">
                        <div class="row row-no-gutter row-eq-height">
                          <div class="col-md-4 ">
                            <div class="banner theme-search-results-item-img-full banner-">
                              <div class="banner-bg" style="background-image:url({$results[$i]['images'][0]});"></div>
                              <a class="banner-link" href="#"></a>
                            </div>
                          </div>
                          <div class="col-md-8 ">
                            <div class="theme-search-results-item-body">
                              <div class="row row-eq-height" data-gutter="20">
                                <div class="col-md-9 ">
                                  <ul class="theme-search-results-item-hotel-stars">
                                    <li>
                                      <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                      <i class="fa fa-star"></i>
                                    </li>
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
                                  <h5 class="theme-search-results-item-title theme-search-results-item-title-lg">{$results[$i]['title']}</h5>
                                  <div class="theme-search-results-item-hotel-rating">
                                    <p class="theme-search-results-item-hotel-rating-title">
                                      <b style="color:{$color_code}">{$total_rating}</b>
                                    </p>
                                  </div>
                                  <p class="theme-search-results-item-location">
                                    <i class="fa fa-map-marker"></i>{$address}
                                  </p>
                                  <p class="theme-search-results-item-hotel-book-count">
                                    Rated by
                                    <b>{$rating}</b> users
                                  </p>
                                </div>
                                <div class="col-md-3 ">
                                  <div class="theme-search-results-item-book">
                                    <div class="theme-search-results-item-price">
                                      <p class="theme-search-results-item-price-tag">{$results[$i]['views']}</p>
                                      <p class="theme-search-results-item-price-sign">views</p>
                                    </div>
                                    <a class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn theme-search-results-item-bookmark-bottom" href="listing.php?id={$results[$i]['id']}" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);">View Now</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
EOT;
                  }
                ?>  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
              </div>
              <div class="_desk-h">
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
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
                      <h5 class="theme-search-results-item-title _fs">Radisson Martinque on Broadway</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>9.2 Excellent</b>
                              <br/>5845 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$140</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
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
                      <h5 class="theme-search-results-item-title _fs">Park Central New York</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>6.6 Good</b>
                              <br/>8424 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$231</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                      </ul>
                      <h5 class="theme-search-results-item-title _fs">New York Hilton Midtown</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>6.4 Good</b>
                              <br/>5601 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$122</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
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
                      <h5 class="theme-search-results-item-title _fs">Refinery Hotel</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>5 Okay</b>
                              <br/>8213 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$265</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                      </ul>
                      <h5 class="theme-search-results-item-title _fs">Viceroy New York</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>5 Okay</b>
                              <br/>5524 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$107</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
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
                      <h5 class="theme-search-results-item-title _fs">The Quin</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>9.3 Excellent</b>
                              <br/>9712 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$141</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
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
                      <h5 class="theme-search-results-item-title _fs">11 Howard</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>10 Excellent</b>
                              <br/>7144 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$227</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                      </ul>
                      <h5 class="theme-search-results-item-title _fs">1 Hotel Central Park</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>10 Excellent</b>
                              <br/>8008 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$487</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                      </ul>
                      <h5 class="theme-search-results-item-title _fs">The Pearl New York</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>7.7 Good</b>
                              <br/>7165 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$497</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
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
                      <h5 class="theme-search-results-item-title _fs">The Nolitan</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>8.1 Excellent</b>
                              <br/>7570 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$367</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
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
                      <h5 class="theme-search-results-item-title _fs">Archer Hotel New York</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>6.6 Good</b>
                              <br/>5377 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$417</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                      </ul>
                      <h5 class="theme-search-results-item-title _fs">The Kitano New York</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>7.8 Good</b>
                              <br/>8706 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$420</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
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
                      <h5 class="theme-search-results-item-title _fs">NoMo SoHo</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>6.4 Good</b>
                              <br/>9282 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$336</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
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
                      <h5 class="theme-search-results-item-title _fs">Hotel Hugo</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>9.1 Excellent</b>
                              <br/>9531 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$123</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                      </ul>
                      <h5 class="theme-search-results-item-title _fs">San Carlos Hotel</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>6.6 Good</b>
                              <br/>6166 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$278</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
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
                      <h5 class="theme-search-results-item-title _fs">The Roxy Hotel</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>8.9 Excellent</b>
                              <br/>6940 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$108</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="banner _h-30vh banner-">
                    <div class="banner-bg" style="background-image:url(./img/315x225.png);"></div>
                  </div>
                  <div class="theme-search-results-item-grid-body">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <ul class="theme-search-results-item-hotel-stars">
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
                        <li>
                          <i class="fa fa-star"></i>
                        </li>
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
                      <h5 class="theme-search-results-item-title _fs">InterContinental New York Barclay</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-9 ">
                          <div class="theme-search-results-item-hotel-rating">
                            <p class="theme-search-results-item-hotel-rating-title">
                              <b>9.6 Excellent</b>
                              <br/>5297 reviews
                            </p>
                          </div>
                        </div>
                        <div class="col-xs-3 ">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag">$136</p>
                            <p class="theme-search-results-item-price-sign">avg/night</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-search-results-mobile-filters" id="mobileFilters">
                <a class="theme-search-results-mobile-filters-btn magnific-inline" href="#MobileFilters">
                  <i class="fa fa-filter"></i>Filters
                </a>
                <div class="magnific-popup mfp-hide" id="MobileFilters">
                  <div class="theme-search-results-sidebar">
                    <div class="theme-search-results-sidebar-sections">
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Search Hotels</h5>
                        <div class="theme-search-results-sidebar-section-search">
                          <input class="theme-search-results-sidebar-section-search-input" type="text" placeholder="Hotel name, address"/>
                          <a class="fa fa-search theme-search-results-sidebar-section-search-btn" href="#"></a>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Hotel Class</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">5 Stars</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">322</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">4 Stars</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">245</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">3 Stars</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">101</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">2 Stars</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">123</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">1 Star</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">216</span>
                            </div>
                          </div>
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
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">268</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Okay</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">143</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Mediocre</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">358</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Poor</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">421</span>
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
                        <h5 class="theme-search-results-sidebar-section-title">Freebies</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Free Breakfast</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">217</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Free Interntet</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">362</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Free Parking</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">180</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Free Cancellation</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">292</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Free Shuttle</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">308</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Neighborhoods</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Midtown</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">201</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Midtown East</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">314</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Hell's Kitchen</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">294</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Midtown East</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">353</span>
                            </div>
                          </div>
                          <div class="collapse" id="mobile-SearchResultsCheckboxNeighborhoods">
                            <div class="theme-search-results-sidebar-section-checkbox-list-items theme-search-results-sidebar-section-checkbox-list-items-expand">
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Flatiron District</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">403</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Financial District</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">179</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Chelsea</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">334</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">West Side</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">199</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">East Side</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">249</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Chinatown</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">297</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Little Italy</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">132</span>
                              </div>
                            </div>
                          </div>
                          <a class="theme-search-results-sidebar-section-checkbox-list-expand-link" role="button" data-toggle="collapse" href="#mobile-SearchResultsCheckboxNeighborhoods" aria-expanded="false">Show more
                            <i class="fa fa-angle-down"></i>
                          </a>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Amenities</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Air-conditioned</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">488</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Airport Shuttle</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">212</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Fitness</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">268</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Wi-Fi</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">318</span>
                            </div>
                          </div>
                          <div class="collapse" id="mobile-SearchResultsCheckboxAmenities">
                            <div class="theme-search-results-sidebar-section-checkbox-list-items theme-search-results-sidebar-section-checkbox-list-items-expand">
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Non-smoking</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">115</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Parking</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">101</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Pet Friendly</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">216</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Pool</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">259</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Restaurant</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">480</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Spa</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">377</span>
                              </div>
                            </div>
                          </div>
                          <a class="theme-search-results-sidebar-section-checkbox-list-expand-link" role="button" data-toggle="collapse" href="#mobile-SearchResultsCheckboxAmenities" aria-expanded="false">Show more
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

                echo '<a class="btn _tt-uc _fs-sm btn-dark btn-block btn-lg" href="'.$url.$get.'">Load More Results</a>';
              }else{
                if($result_count == 0){
                  echo '<a class="btn _tt-uc _fs-sm btn-dark btn-block btn-lg" href="./">No Results Found</a>';
                }else{
                  echo '<a class="btn _tt-uc _fs-sm btn-dark btn-block btn-lg" href="./">No More Results</a>';
                }
              }
            ?>






          
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
    <script src="../js/fix-weddings.js"></script>
  </body>
</html>