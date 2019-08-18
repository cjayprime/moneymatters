<?php
    
    require_once('../database.php');

    // GET: URL request
    $result_size = 32;
    $result_start = isset($_GET['start']) ? $_GET['start'] : 0;
    $ownership = isset($_GET['ownership']) && ($_GET['ownership'] == 'Sale' || $_GET['ownership'] == 'Rental' || $_GET['ownership'] == 'All') ? $_GET['ownership'] : 'Sale';
    $location = isset($_GET['location']) && !empty($_GET['location']) ? $_GET['location'] : 'Lagos';
    $type = isset($_GET['type']) ? $_GET['type'] : 'Duplex';
    $amenities = isset($_GET['amenities']) ? $_GET['amenities'] : array();
    $facilities = isset($_GET['facilities']) ? $_GET['facilities'] : array();
    $languages = isset($_GET['languages']) ? $_GET['languages'] : array();
    $price_min = isset($_GET['price']) && isset($_GET['price']['min']) && is_numeric($_GET['price']['min']) ? $_GET['price']['min'] : 1;
    $price_max = isset($_GET['price']) && isset($_GET['price']['max']) && is_numeric($_GET['price']['max']) ? $_GET['price']['max'] : 5000;
    $price_current_max = $price_max;
    $price_current_min = $price_min;

    $result_start = mysqli_real_escape_string($database,$result_start);
    $location_ = mysqli_real_escape_string($database,$location);
    $type_ = mysqli_real_escape_string($database,json_encode($type));
    $ownership_ = mysqli_real_escape_string($database,$ownership);
    
    $sql = "SELECT * FROM `property` WHERE 
        ((`full_address` LIKE '%$location_%' OR `country` LIKE '%$location_%' OR `state` LIKE '%$location_%' OR `city` LIKE '%$location_%') 
        OR 
        (JSON_CONTAINS(LOWER(`type`),'".strtolower($type_)."') IS NOT NULL) 
        OR 
        `ownership` = '$ownership_')
        AND
        (`price` >= '$price_min' AND `price` <= '$price_max')
        ORDER BY `date`
        LIMIT ".$result_start.", ".$result_size;
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);

    $results = array();
    if($num > 0){
      while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        array_push($results,
          array(
            'id'=>$rows['property_id'],
            'price'=>$rows['price'],
            'duration'=>$ownership == 'Sale' ? '' : $rows['duration'],
            'bed'=>$rows['bedroom'],
            'bath'=>$rows['bathroom'],
            'guests'=>$rows['guests'],
            'country'=>$rows['country'],
            'state'=>$rows['state'],
            'address'=>$rows['full_address'],
            'images'=>json_decode($rows['pictures'],true)
          )
        );
      }
    }
    $result_count = count($results);


    // The prices must be reset to reflect the search $price_min, EVEN THOUGH ACTUAL SEARCH WILL BE DONE WITH THE PRICE PARAMETERS
    $sql= "SELECT MAX(`price`) AS max, MIN(`price`) AS min FROM `property`";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    if($num > 0){
      $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $price_current_max = $price_max;
      $price_current_min = $price_min;
      $price_max = $rows['max'];
      $price_min = $rows['min'];
    }

    // Admin
    $sql = "SELECT `type`,`amenities`,`facilities` FROM `admin` WHERE `title` = 'moneymatters' AND `page` = 'property' AND `access` = 'system'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $admin = array();
    if($num > 0){
      $admin = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $admin['type'] = json_decode($admin['type'],true);
      $admin['amenities'] = json_decode($admin['amenities'],true);
      $admin['facilities'] = json_decode($admin['facilities'],true);
    }
    
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Property / Search</title>
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
        $options = array('page' => 'property', 'subpage' => 'result');
        require_once('../header.php');
      ?>











    <div class="theme-page-section theme-page-section-dark">
      <div class="container">
        <div class="theme-search-area _mob-h theme-search-area-white">
          <div class="row">
            <div class="col-md-3 ">
              <div class="theme-search-area-header theme-search-area-header-sm">
                <h1 class="theme-search-area-title">
                  <?php echo $result_count . ' properties found '
                  ?>
                </h1>
              </div>
            </div>
            <div class="col-md-9 ">
              <div class="theme-search-area-form" id="hero-search-form">
                <div class="row" data-gutter="10">
                  <div class="col-md-5 ">
                    <div class="theme-search-area-section first theme-search-area-section-fade-white theme-search-area-section-sm theme-search-area-section-no-border theme-search-area-section-curved">
                      <div class="theme-search-area-section-inner">
                        <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                        <input class="theme-search-area-section-input typeahead" id="location" value="<?php echo $location;?>" type="text" placeholder="Apartment Location" data-provide="typeahead"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 ">
                    <div class="row" data-gutter="10">
                      <div class="col-md-6 ">
                        <div class="theme-search-area-section theme-search-area-section-fade-white theme-search-area-section-sm theme-search-area-section-no-border theme-search-area-section-curved quantity-selector" data-increment="Guests">
                          <div class="theme-search-area-section-inner drop-down-button">
                            <i class="theme-search-area-section-icon lin lin-home"></i>
                            <input class="theme-search-area-section-input" id="type" value="<?php echo $type;?>" placeholder="Rental" type="button" style="text-align:left;"/>
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
                        <div class="theme-search-area-section theme-search-area-section-fade-white theme-search-area-section-sm theme-search-area-section-no-border theme-search-area-section-curved quantity-selector" data-increment="Guests">
                          <div class="theme-search-area-section-inner drop-down-button">
                            <i class="theme-search-area-section-icon fa fa-bookmark-o"></i>
                            <input class="theme-search-area-section-input" id="ownership" value="<?php echo $ownership;?>" placeholder="Rental" type="button" style="text-align:left;"/>
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
                    <button id="search-button" class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-no-border theme-search-area-submit-curved theme-search-area-submit-sm theme-search-area-submit-primary" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);">Edit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
          <h4 class="theme-search-area-inline-title">Paris Homes</h4>
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
                    <input class="theme-search-area-section-input typeahead" value="New York" type="text" placeholder="Apartment Location" data-provide="typeahead"/>
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
                    <div class="theme-search-area-section theme-search-area-section-curved quantity-selector" data-increment="Adults">
                      <label class="theme-search-area-section-label">Adults</label>
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
                    <div class="theme-search-area-section theme-search-area-section-curved quantity-selector" data-increment="Children">
                      <label class="theme-search-area-section-label">Children</label>
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
                <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section theme-page-section-gray">
      <div class="container">
        <div class="row row-col-static" id="sticky-parent">
          <div class="col-md-3 ">
            <div class="sticky-col _mob-h">
              <div class="theme-search-results-sidebar">
                <div class="theme-search-results-sidebar-map-view _mb-20">
                  <div class="theme-search-results-sidebar-map-view-body">
                    <i class="fa fa-search theme-search-results-sidebar-map-view-icon"></i>
                    <p class="theme-search-results-sidebar-map-view-sign">Search Options</p>
                  </div>
                  <div class="theme-search-results-sidebar-map-view-mask" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);"></div>
                </div>
                <div class="theme-search-results-sidebar-sections _mb-20 _br-2 theme-search-results-sidebar-sections-white-wrap">
                  <div class="theme-search-results-sidebar-section">
                    <h5 class="theme-search-results-sidebar-section-title">Price</h5>
                    <div class="theme-search-results-sidebar-section-price">
                      <input id="price-slider" name="price-slider"<?php echo ' data-from="'.$price_current_min.'" data-to="'.$price_current_max.'" data-min="'.$price_min.'" data-max="'.$price_max.'"'?>/>
                    </div>
                  </div>


























<!--
                  <div class="theme-search-results-sidebar-section">
                    <h5 class="theme-search-results-sidebar-section-title">Rental Type</h5>
                    <div class="theme-search-results-sidebar-section-checkbox-list">
                      <div class="theme-search-results-sidebar-section-checkbox-list-items">
                        <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                          <label class="icheck-label">
                            <input class="icheck" type="checkbox"/>
                            <span class="icheck-title">Entire Home</span>
                          </label>
                          <span class="theme-search-results-sidebar-section-checkbox-list-amount">464</span>
                        </div>
                        <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                          <label class="icheck-label">
                            <input class="icheck" type="checkbox"/>
                            <span class="icheck-title">Private Room</span>
                          </label>
                          <span class="theme-search-results-sidebar-section-checkbox-list-amount">306</span>
                        </div>
                        <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                          <label class="icheck-label">
                            <input class="icheck" type="checkbox"/>
                            <span class="icheck-title">Shared Room</span>
                          </label>
                          <span class="theme-search-results-sidebar-section-checkbox-list-amount">189</span>
                        </div>
                      </div>
                    </div>
                  </div>
-->
                  <?php
                    // SEARCH: The parameters for search
                    foreach($admin as $key => $value){
                      if($key == 'type')continue;

                      echo '
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">'.$key.'</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          ';
                      
                      for($i = 0; $i < (count($admin[$key])); $i++){
                        $sql = "SELECT COUNT(*) AS total FROM `property` WHERE JSON_SEARCH(LOWER(`property`.`".$key."`),'one','".strtolower($admin[$key][$i])."') IS NOT NULL";
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
                  // RESULTS: Display the results of the query

                  for($i = 0; $i < count($results); $i++){
                    $bed = ($results[$i]["bed"] > 0) ? "beds" : "bed";
                    $dur = $results[$i]["duration"] ? '/' : '';
                    echo <<<EOD
                      <div class="col-md-3 ">
                        <div class="theme-search-results-item _br-3 _mb-10 theme-search-results-item-bs theme-search-results-item-lift theme-search-results-item-grid">
                            <div class="banner _h-20vh _h-mob-30vh banner-">
                              <div class="banner-bg" style="background-image:url({$results[$i]["images"][0]});"></div>
                            </div>
                            <div class="theme-search-results-item-grid-body">
                              <a class="theme-search-results-item-mask-link" href="listing.php?id={$results[$i]["id"]}"></a>
                              <div class="theme-search-results-item-grid-header">
                                <h5 class="theme-search-results-item-title">{$results[$i]["address"]} , {$results[$i]["state"]} , {$results[$i]["country"]}</h5>
                              </div>
                              <div class="theme-search-results-item-grid-caption">
                                <div class="row" data-gutter="10">
                                  <div class="col-xs-9 ">
                                    <div class="theme-search-results-item-rating">
                                      <ul class="theme-search-results-item-rating-stars">
                                        <i class="fa fa-bed"></i>
                                        {$results[$i]["bed"]} $bed
                                      </ul>
                                      <p class="theme-search-results-item-rating-title">
                                        <i class="fa fa-bath"></i>
                                        30 beds
                                      </p>
                                    </div>
                                  </div>
                                  <div class="col-xs-3 ">
                                    <div class="theme-search-results-item-price">
                                      <p class="theme-search-results-item-price-tag"><span class="currency-symbol">₦</span><span class="currency-value" data-value="{$results[$i]["price"]}">{$results[$i]["price"]}</span></p>
                                      <p class="theme-search-results-item-price-sign">{$dur}{$results[$i]["duration"]}</p>
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
              <div class="theme-search-results-mobile-filters" id="mobileFilters">
                <a class="theme-search-results-mobile-filters-btn magnific-inline" href="#MobileFilters">
                  <i class="fa fa-filter"></i>Filters
                </a>
                <div class="magnific-popup mfp-hide" id="MobileFilters">
                  <div class="theme-search-results-sidebar">
                    <div class="theme-search-results-sidebar-sections">
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
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">278</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Good</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">253</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Okay</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">454</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Mediocre</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">304</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Poor</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">161</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Rental Type</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Entire Home</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">100</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Private Room</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">365</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Shared Room</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">419</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Amenities</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Heating</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">331</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">TV</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">148</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Kitchen</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">458</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Wireless Internet</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">321</span>
                            </div>
                          </div>
                          <div class="collapse" id="mobile-SearchResultsCheckboxAmenities">
                            <div class="theme-search-results-sidebar-section-checkbox-list-items theme-search-results-sidebar-section-checkbox-list-items-expand">
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Air Conditioning</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">259</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Breakfast</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">255</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Buzzer</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">459</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Doorman</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">249</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Dryer</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">198</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Family/Kid Friendly</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">370</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Hair Dryer</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">433</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Hangers</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">287</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Indoor Fireplace</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">214</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Iron</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">157</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Laptop Workspace</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">145</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Lock on Bedroom</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">280</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Self Check-in</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">202</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Shampoo</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">337</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Washer</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">249</span>
                              </div>
                            </div>
                          </div>
                          <a class="theme-search-results-sidebar-section-checkbox-list-expand-link" role="button" data-toggle="collapse" href="#mobile-SearchResultsCheckboxAmenities" aria-expanded="false">Show more
                            <i class="fa fa-angle-down"></i>
                          </a>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Facilities</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Elevator</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">120</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Free Parking</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">255</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Hot Tub</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">381</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Wheelchair acce..</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">105</span>
                            </div>
                          </div>
                          <div class="collapse" id="mobile-SearchResultsCheckboxFacilities">
                            <div class="theme-search-results-sidebar-section-checkbox-list-items theme-search-results-sidebar-section-checkbox-list-items-expand">
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Gym</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">125</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Pool</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">441</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">SPA</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">142</span>
                              </div>
                            </div>
                          </div>
                          <a class="theme-search-results-sidebar-section-checkbox-list-expand-link" role="button" data-toggle="collapse" href="#mobile-SearchResultsCheckboxFacilities" aria-expanded="false">Show more
                            <i class="fa fa-angle-down"></i>
                          </a>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">House Rules</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Pets Allowed</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">161</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Smoking Allowed</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">450</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Suitable for Events</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">492</span>
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
                                <span class="icheck-title">Montmartre</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">289</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">XI Arrondissement</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">298</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">XVI Arrondissement</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">136</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">XVIII Arrondissement</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">340</span>
                            </div>
                          </div>
                          <div class="collapse" id="mobile-SearchResultsCheckboxNeighborhoods">
                            <div class="theme-search-results-sidebar-section-checkbox-list-items theme-search-results-sidebar-section-checkbox-list-items-expand">
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Austerlitz</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">249</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Auteuil</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">290</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Bastille</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">186</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Batignolles</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">200</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Bercy</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">127</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Canal Saint-Martin</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">365</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Commerce - Dupleix</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">302</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Gare de Lyon</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">256</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">I Arrondissement</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">162</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">IX Arrondissement</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">130</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">La Chapelle</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">417</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">La Villette</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">414</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Le Marais</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">266</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Louvre - Tuileries</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">282</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Monceau</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">132</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Montparnasse</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">486</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Nation</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">430</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Palais Royal</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">241</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Paris</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">260</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Passy</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">106</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Port-Royal</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">166</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Porte de Versailles</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">215</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Quartier Latin</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">232</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Saint-Lazare</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">149</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Saint-Michel</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">190</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Ternes</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">176</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Vaugirard</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">153</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">XV Arrondissement</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">461</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">XVII Arrondissement</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">116</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">XX Arrondissement</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">215</span>
                              </div>
                            </div>
                          </div>
                          <a class="theme-search-results-sidebar-section-checkbox-list-expand-link" role="button" data-toggle="collapse" href="#mobile-SearchResultsCheckboxNeighborhoods" aria-expanded="false">Show more
                            <i class="fa fa-angle-down"></i>
                          </a>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Host Language</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">English</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">224</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">French</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">355</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Spanish</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">357</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Italian</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">238</span>
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