<?php

    require_once('../database.php');

    if( !isset($_GET['firstname']) || empty($_GET['firstname']) 
    || !isset($_GET['lastname']) || empty($_GET['lastname']) 
    || !isset($_GET['email']) || empty($_GET['email']) 
    || !isset($_GET['phone']) || empty($_GET['phone']) ){
      //header('Location: ./');
    }

    // GET: URL request
    $result_size = 32;
    $result_start = isset($_GET['start']) ? mysqli_real_escape_string($database,$_GET['start']) : 0;
    $firstname = isset($_GET['firstname']) ? $_GET['firstname'] : '';
    $lastname = isset($_GET['lastname']) ? $_GET['lastname'] : '';
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    $phone = isset($_GET['phone']) ? $_GET['phone'] : '';
    //$address = isset($_GET['address']) ? $_GET['address'] : '';
    $type = isset($_GET['type']) ? mysqli_real_escape_string($database,$_GET['type']) : '';
    
    //Optional Get parameters
    //Risk insurance && Fire insurance && Travel insurance
    $duration = isset($_GET['duration']) ? mysqli_real_escape_string($database,$_GET['duration']) : '';
    //Homeowner's insurance
    $business = isset($_GET['business']) ? mysqli_real_escape_string($database,$_GET['business']) : '';
    //Prices
    $price_min = isset($_GET['price']) && isset($_GET['price']['min']) && is_numeric($_GET['price']['min']) ? mysqli_real_escape_string($database,$_GET['price']['min']) : 100;
    $price_max = isset($_GET['price']) && isset($_GET['price']['max']) && is_numeric($_GET['price']['max']) ? mysqli_real_escape_string($database,$_GET['price']['max']) : 500;
    $price_current_max = $price_max;
    $price_current_min = $price_min;

    $addSql = '';
    

    $sql = "SELECT * FROM `finance` INNER JOIN `vendor` WHERE ".$addSql."
        ((`description` LIKE '%$type%') 
        OR 
        (`tags` LIKE '%$type%')
        OR 
        (`finance`.`type` = '$type'))
        AND
        (`price` >= '$price_min' AND `price` <= '$price_max')
        LIMIT ".$result_start.", ".$result_size;
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    echo mysqli_error($database);
    $results = array();
    if($num > 0){
      while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        array_push($results,
          array(
            'id'=>$rows['finance_id'],
            'price'=>$rows['price'],
            'description'=>$rows['description'],
            'title'=>$rows['title'],
            'provider'=>$rows['business_name'],
            'images'=>$rows['business_logo']
          )
        );
      }

      // The prices must be reset to reflect the search $price_min, EVEN THOUGH ACTUAL SEARCH WILL BE DONE WITH THE PRICE PARAMETERS
      $sql= "SELECT MAX(`price`) AS max, MIN(`price`) AS min FROM `insurance`";
      $query = mysqli_query($database,$sql);
      $num = mysqli_num_rows($query);
      if($num > 0){
        $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $price_current_max = $price_max;
        $price_current_min = $price_min;
        $price_max = $rows['max'];
        $price_min = $rows['min'];
      }
    }
    
    $result_count = count($results);




    // Admin
    $sql = "SELECT `category` FROM `admin` WHERE `title` = 'moneymatters' AND `page` = 'insurance' AND `access` = 'system'";
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
    <title>Finance / Results</title>
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
  $options = array('page' => 'finance', 'subpage' => 'results');
  require_once('../header.php');
?>











<div class="theme-page-section theme-page-section-dark theme-page-section-lg">
      <div class="container">
        <div class="row row-col-static" id="sticky-parent" data-gutter="20">
          <div class="col-md-3 ">
            <div class="sticky-col _mob-h">
              <div class="theme-search-results-sidebar">
                
                <input type="hidden" id="email" value="<?php echo (isset($email) && !empty($email)) ? $email : '';?>"/>
                <input type="hidden" id="firstname" value="<?php echo (isset($firstname) && !empty($firstname)) ? $firstname : '';?>"/>
                <input type="hidden" id="lastname" value="<?php echo (isset($lastname) && !empty($lastname)) ? $lastname : '';?>"/>
                <input type="hidden" id="phone" value="<?php echo (isset($phone) && !empty($phone)) ? $phone : '';?>"/>

                <div class="theme-search-results-sidebar-map-view _mb-10 theme-search-results-sidebar-map-view-primary">
                  <a class="theme-search-results-sidebar-map-view-link" id="search-button" href="#"></a>
                  <div class="theme-search-results-sidebar-map-view-body">
                    <i class="fa fa-search theme-search-results-sidebar-map-view-icon"></i>
                    <p class="theme-search-results-sidebar-map-view-sign">Search Options</p>
                  </div>
                  <div class="theme-search-results-sidebar-map-view-mask" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);"></div>
                </div>
                <div class="theme-search-results-sidebar-sections _mb-20 _br-2 _b-n theme-search-results-sidebar-sections-white-wrap">
                  <div class="theme-search-results-sidebar-section">
                    <h5 class="theme-search-results-sidebar-section-title">Price</h5>
                    <div class="theme-search-results-sidebar-section-price">
                      <input id="price-slider" name="price-slider"<?php echo ' data-from="'.$price_current_min.'" data-to="'.$price_current_max.'" data-min="'.$price_min.'" data-max="'.$price_max.'"'?>/>
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
                      
                      $sql = "SELECT COUNT(*) AS total FROM `insurance` WHERE `insurance`.`".$key."`= '".strtolower(mysqli_real_escape_string($database,$admin[$key][$i]))."'";
                      $query = mysqli_query($database,$sql);
                      $num = mysqli_num_rows($query);
                      //echo $sql;
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
                            <input class="icheck search-options checkbox2radio" data-name="{$key}-{$name}" type="checkbox" {$checked}/>
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
          <div class="col-md-8-5 ">
            <div class="theme-search-results">
              <div class="_mob-h">
                
              




















              <?php
              for($i = 0; $i < count($results); $i++){
                echo 
                  <<<EOD
                  <div class="theme-search-results-item _mb-10 _b-n theme-search-results-item-rounded theme-search-results-item-">
                    <div class="theme-search-results-item-preview">
                      <div class="row" data-gutter="20">
                        <div class="col-md-5 ">
                          <div class="theme-search-results-item-img-wrap" style="width:300px;height:150px;">
                            <img class="theme-search-results-item-img" src="{$results[$i]['images']}" alt="Image Alternative text" title="Image Title"/>
                          </div>
                        </div>
                        <div class="col-md-5 " style="max-height:150px;text-overflow:ellipsis;overflow:auto;">
                          <h5 class="theme-search-results-item-title _fw-b _mb-5 _fs theme-search-results-item-title-lg">{$results[$i]['provider']}</h5>
                          <h5 class="theme-search-results-item-title _fw-b _mb-20 _fs theme-search-results-item-title-lg">{$results[$i]['title']}</h5>
                          <div class="theme-search-results-item-title _fw-b _mb-5 _fs theme-search-results-item-title-lg">{$results[$i]['description']}</div>
                        </div>
                        <div class="col-md-2 ">
                          <div class="theme-search-results-item-book">
                            <div class="theme-search-results-item-price">
                              <p class="theme-search-results-item-price-tag"><span class="currency-symbol">₦</span><span class="currency-value" data-value="{$results[$i]['price']}">{$results[$i]['price']}</span></p>
                              <p class="theme-search-results-item-price-sign">per subscription</p>
                            </div>
                            <div class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn purchase-now" data-value="{$results[$i]['id']}" data-price="{$results[$i]['price']}" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);">Purchase Now</div>
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
                        <h5 class="theme-search-results-sidebar-section-title">Pickup Location</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">LGA: LaGuardia</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">452</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">EWR: Newark</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">135</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">JFK: John F. Ken...</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">198</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Non-airport</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">200</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Passengers</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">1 to 2 passengers</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">411</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">3 to 5 passengers</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">190</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">6 or more</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">450</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Bags</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">1 to 2 bags</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">365</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">3 to 4 bags</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">498</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">5 or more</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">350</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Car Type</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Small</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">405</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Large</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">101</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Medium</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">486</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">SUV</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">295</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Van</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">435</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Commercial</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">278</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Luxury</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">260</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Pickup truck</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">450</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Convertable</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">355</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Payment Type</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Pay now</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">440</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Pay at counter</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">157</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Rental Agency</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Ace</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">453</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Action</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">393</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Advantage</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">463</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Alamo</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">157</span>
                            </div>
                          </div>
                          <div class="collapse" id="mobile-SearchResultsCheckboxRentalAgency">
                            <div class="theme-search-results-sidebar-section-checkbox-list-items theme-search-results-sidebar-section-checkbox-list-items-expand">
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Avis</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">291</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Budget</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">408</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Dollar</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">378</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Enterprise</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">200</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Hertz</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">168</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">National</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">121</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Payless</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">413</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Prestige Car Rental</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">382</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Special rate</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">129</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">Thrifty</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">301</span>
                              </div>
                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                <label class="icheck-label">
                                  <input class="icheck" type="checkbox"/>
                                  <span class="icheck-title">U-Save</span>
                                </label>
                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">136</span>
                              </div>
                            </div>
                          </div>
                          <a class="theme-search-results-sidebar-section-checkbox-list-expand-link" role="button" data-toggle="collapse" href="#mobile-SearchResultsCheckboxRentalAgency" aria-expanded="false">Show more
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
    <script src="../js/fix-finance.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
  </body>
</html>