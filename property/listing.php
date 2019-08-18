<?php
    
    require_once('../database.php');
    
    // GET: URL request
    $property_id = isset($_GET['id']) ? mysqli_real_escape_string($database,$_GET['id']) : 0;
    
    $sql = "SELECT * FROM `property` WHERE `property_id` = '$property_id'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);

    if($num > 0){
      $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $result['pictures'] = json_decode($result['pictures'],true);
      $result['type'] = json_decode($result['type'],true);
      $result['amenities'] = json_decode($result['amenities'],true);
      $result['facilities'] = json_decode($result['facilities'],true);
    }else{
      $result = array();
    }
    

    // Total number of properties in the selected state
    $total_state = 0;
    if(count($result) > 0){
      $sql = "SELECT COUNT(*) AS state FROM `property` WHERE `state` = '".$result['state']."'";
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
      $sql = "SELECT COUNT(*) AS city FROM `property` WHERE `city` = '".$result['city']."'";
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
      $sql = "SELECT COUNT(*) AS district FROM `property` WHERE `district` = '".$result['district']."'";
      $query = mysqli_query($database,$sql);
      $num = mysqli_num_rows($query);

      if($num > 0){
        $total_district = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $total_district = $total_district['district'];
      } 
    }

    // Admin
    /*$sql = "SELECT `fee` FROM `admin` WHERE `title` = 'moneymatters' AND `page` = 'property' AND `access` = 'system'";
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
    <title>Property / Listing</title>
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
      $options = array('page' => 'property', 'subpage' => 'listing');
      require_once('../header.php');
    ?>











    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg theme-hero-area-bg-blur" style="background-image:url(../img/property_header.jpg);"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-strong"></div>
        <div class="theme-hero-area-inner-shadow"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="theme-item-page-header _pt-200 _pb-50 _pt-mob-100 theme-item-page-header-white">
            <div class="theme-item-page-header-body">
              <ul class="theme-item-page-header-features _mob-h">









              
              
              
              
              
              
              
                <li>
                  <i class="theme-item-page-header-features-icon fa fa-car"></i>
                  <p class="theme-item-page-header-features-title"><?php echo (isset($result['garages'])) ? ($result['garages'] > 0 ? $result['garages'].' garages' : $result['garages'].' garage') : '0 guest';?></p>
                </li>
                <li>
                  <i class="theme-item-page-header-features-icon fa fa-building"></i>
                  <p class="theme-item-page-header-features-title"><?php echo (isset($result['floors'])) ? ($result['floors'] > 0 ? $result['floors'].' floors' : $result['floors'].' floor') : '0 floor';?></p>
                </li>
                <li>
                  <i class="theme-item-page-header-features-icon fa fa-male"></i>
                  <p class="theme-item-page-header-features-title"><?php echo (isset($result['guests'])) ? ($result['guests'] > 0 ? $result['guests'].' guests' : $result['guests'].' guest') : '0 guest';?></p>
                </li>
                <li>
                  <i class="theme-item-page-header-features-icon fa fa-bed"></i>
                  <p class="theme-item-page-header-features-title"><?php echo (isset($result['bedroom'])) ? ($result['bedroom'] > 0 ? $result['bedroom'].' beds' : $result['bedroom'].' bed') : '0 bed';?></p>
                </li>
                <li>
                  <i class="theme-item-page-header-features-icon fa fa-bath"></i>
                  <p class="theme-item-page-header-features-title"><?php echo (isset($result['bathroom'])) ? ($result['bathroom'] > 0 ? $result['bathroom'].' baths' : $result['bathroom'].' bath') : '0 bath';?></p>
                </li>
              </ul>
              <h1 class="theme-item-page-header-title _ff-d _fw-200"><?php echo (isset($result['full_address'])) ? $result['full_address'] : ''; ?></h1>
              
              
              
              
              
              
              
              
              
              <div class="theme-item-page-header-price theme-item-page-header-price-xl">
                <p class="theme-item-page-header-price-body">
                  <b><?php echo (isset($result['price'])) ? '<span class="currency-symbol">₦</span>'.'<span class="currency-value" data-value="'.$result["price"].'">'.$result["price"].'</span>' : '$0'; ?></b>
                  <span><?php echo (isset($result['duration']) && isset($result['ownership']) && !empty($result['status']) && $result['ownership'] == 'Sale') ? '/ '.$result['duration'] : ''; ?></span>
                </p>
              </div>
              <ul class="theme-breadcrumbs">
                <li>
                  <p class="theme-breadcrumbs-item-title">
                    <a href="index.html">Home</a>
                  </p>
                </li>
                <li>
                  <p class="theme-breadcrumbs-item-title">
                    <a href="#"><?php echo (isset($result['district'])) ? $result['district'] : ''; ?></a>
                  </p>
                  <p class="theme-breadcrumbs-item-subtitle"><?php echo $total_district; ?> homes</p>
                </li>
                <li>
                  <p class="theme-breadcrumbs-item-title">
                    <a href="#"><?php echo (isset($result['city'])) ? $result['city'] : ''; ?></a>
                  </p>
                  <p class="theme-breadcrumbs-item-subtitle"><?php echo $total_city; ?> homes</p>
                </li>
                <li>
                  <p class="theme-breadcrumbs-item-title">
                    <a href="#"><?php echo (isset($result['state'])) ? $result['state'] : ''; ?> properties</a>
                  </p>
                  <p class="theme-breadcrumbs-item-subtitle"><?php echo $total_state; ?> homes</p>
                </li>
                <li>
                  <p class="theme-breadcrumbs-item-title active"><?php echo (isset($result['full_address'])) ? $result['full_address'] : ''; ?></p>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section">
      <div class="container">
        <div class="row row-col-static" id="sticky-parent" data-gutter="60">
          <div class="col-md-8 ">
            <div class="theme-search-area _desk-h _mb-30 theme-search-area-vert">
              <div class="theme-search-area-header _mb-20 theme-search-area-header-sm">
                <h1 class="theme-search-area-title">Reserve Property</h1>
                <p class="theme-search-area-subtitle">Posuere lobortis primis duis id</p>
              </div>
              <div class="theme-search-area-form">
                <div class="row" data-gutter="10">
                  <div class="col-md-6 ">
                    <div class="theme-search-area-section theme-search-area-section-sm theme-search-area-section-curved">
                      <div class="theme-search-area-section-inner">
                        <i class="theme-search-area-section-icon lin lin-calendar"></i>
                        <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                        <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 ">
                    <div class="theme-search-area-section theme-search-area-section-sm theme-search-area-section-curved">
                      <div class="theme-search-area-section-inner">
                        <i class="theme-search-area-section-icon lin lin-calendar"></i>
                        <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                        <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-search-area-section theme-search-area-section-sm theme-search-area-section-curved quantity-selector" data-increment="Guests">
                  <div class="theme-search-area-section-inner">
                    <i class="theme-search-area-section-icon lin lin-people"></i>
                    <input class="theme-search-area-section-input" value="2 Guests" type="text"/>
                    <div class="quantity-selector-box" id="mobile-RoomSearchGuests">
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
                        <h5 class="theme-item-page-summary-price-item-title">5 nights</h5>
                        <p class="theme-item-page-summary-price-item-subtitle">2 Guests</p>
                        <p class="theme-item-page-summary-price-item-price">$325.00</p>
                      </li>
                      <li class="theme-item-page-summary-price-item">
                        <h5 class="theme-item-page-summary-price-item-title">Clearing fee</h5>
                        <p class="theme-item-page-summary-price-item-subtitle">One time fee</p>
                        <p class="theme-item-page-summary-price-item-price">$54.00</p>
                      </li>
                      <li class="theme-item-page-summary-price-item">
                        <h5 class="theme-item-page-summary-price-item-title">Service fee</h5>
                        <p class="theme-item-page-summary-price-item-subtitle"></p>
                        <p class="theme-item-page-summary-price-item-price">$85.00</p>
                      </li>
                    </ul>
                  </div>
                  <p class="theme-item-page-summary-price-total">Total Stay
                    <span>$464.00</span>
                  </p>
                </div>
                <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Reserve Now</button>
              </div>
            </div>
            <div class="theme-item-page-tabs _mb-30">
              <div class="tabbable">
                <div class="tab-content _pt-30">
                  <div class="tab-pane active" id="HotelPageTabs-1" role="tab-panel">
                    <div class="theme-item-page-overview">
                      <div class="row row-col-mob-gap">
                        <div class="col-md-6 ">
                          <div class="row magnific-gallery row-col-gap" data-gutter="10">
                            <div class="col-xs-3 ">
                              <div class="banner banner-sqr banner-">
                                <div class="banner-bg" style="background-image:url(<?php echo (isset($result['pictures']) && isset($result['pictures'][0])) ? $result['pictures'][0] : '';?>);"></div>
                                <a class="banner-link" href="<?php echo (isset($result['pictures']) && isset($result['pictures'][0])) ? $result['pictures'][0] : '';?>"></a>
                              </div>
                            </div>
                            <div class="col-xs-3 ">
                              <div class="banner banner-sqr banner-">
                                <div class="banner-bg" style="background-image:url(<?php echo (isset($result['pictures']) && isset($result['pictures'][1])) ? $result['pictures'][1] : '';?>);"></div>
                                <a class="banner-link" href="<?php echo (isset($result['pictures']) && isset($result['pictures'][1])) ? $result['pictures'][1] : '';?>"></a>
                              </div>
                            </div>
                            <div class="col-xs-3 ">
                              <div class="banner banner-sqr banner-">
                                <div class="banner-bg" style="background-image:url(<?php echo (isset($result['pictures']) && isset($result['pictures'][2])) ? $result['pictures'][2] : '';?>);"></div>
                                <a class="banner-link" href="<?php echo (isset($result['pictures']) && isset($result['pictures'][2])) ? $result['pictures'][2] : '';?>"></a>
                              </div>
                            </div>
                            <div class="col-xs-3 ">
                              <div class="banner banner-sqr banner-">
                                <div class="banner-bg" style="background-image:url(<?php echo (isset($result['pictures']) && isset($result['pictures'][3])) ? $result['pictures'][3] : '';?>);"></div>
                                <a class="banner-link" href="<?php echo (isset($result['pictures']) && isset($result['pictures'][3])) ? $result['pictures'][3] : '';?>"></a>
                              </div>
                            </div>
                            <div class="col-xs-3 ">
                              <div class="banner banner-sqr banner-">
                                <div class="banner-bg" style="background-image:url(<?php echo (isset($result['pictures']) && isset($result['pictures'][4])) ? $result['pictures'][4] : '';?>);"></div>
                                <a class="banner-link" href="<?php echo (isset($result['pictures']) && isset($result['pictures'][4])) ? $result['pictures'][4] : '';?>"></a>
                              </div>
                            </div>
                            <div class="col-xs-3 ">
                              <div class="banner banner-sqr banner-">
                                <div class="banner-bg" style="background-image:url(<?php echo (isset($result['pictures']) && isset($result['pictures'][5])) ? $result['pictures'][5] : '';?>);"></div>
                                <a class="banner-link" href="<?php echo (isset($result['pictures']) && isset($result['pictures'][5])) ? $result['pictures'][5] : '';?>"></a>
                              </div>
                            </div>
                            <div class="col-xs-3 ">
                              <div class="banner banner-sqr banner-">
                                <div class="banner-bg" style="background-image:url(<?php echo (isset($result['pictures']) && isset($result['pictures'][6])) ? $result['pictures'][6] : '';?>);"></div>
                                <a class="banner-link" href="<?php echo (isset($result['pictures']) && isset($result['pictures'][6])) ? $result['pictures'][6] : '';?>"></a>
                              </div>
                            </div>
                            <div class="col-xs-3 ">
                              <div class="banner banner-sqr banner-">
                                <div class="banner-bg" style="background-image:url(<?php echo (isset($result['pictures']) && isset($result['pictures'][7])) ? $result['pictures'][7] : '';?>);"></div>
                                <a class="banner-link" href="<?php echo (isset($result['pictures']) && isset($result['pictures'][7])) ? $result['pictures'][7] : '';?>"></a>
                              </div>
                            </div>
                            <div class="col-xs-3 ">
                              <div class="banner banner-sqr banner-">
                                <div class="banner-bg" style="background-image:url(<?php echo (isset($result['pictures']) && isset($result['pictures'][8])) ? $result['pictures'][7] : '';?>);"></div>
                                <a class="banner-link" href="<?php echo (isset($result['pictures']) && isset($result['pictures'][8])) ? $result['pictures'][8] : '';?>"></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-item-page-desc">
                            <p><?php echo (isset($result['description']) && isset($result['description'])) ? $result['description'] : '';?></p>
                          </div>
                        </div>
                      </div>
                      <div class="theme-item-page-details">
                      <div class="theme-item-page-details-section">
                          <div class="row">
                            <div class="col-md-3 ">
                              <h5 class="theme-item-page-details-section-title">Property Type</h5>
                            </div>
                            <div class="col-md-9 ">
                              <div class="row">
                                <div class="col-md-4 ">
                                  <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                    
                                    
                                    
                                    
                                    
                                    




                                    
                                    
                                    <?php

                                      if(isset($result['type']))
                                      for($i = 0; $i < 0.3 * count($result['type']); $i++)
                                      echo '<li>'.$result['type'][$i].'</li>';
                                      
                                    ?>

                                  </ul>
                                </div>
                                <div class="col-md-4 ">
                                  <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                    
                                    <?php

                                      if(isset($result['type']))
                                      for($i = 0.3 * count($result['type']); $i < 0.6 * count($result['type']); $i++)
                                      echo '<li>'.$result['type'][$i].'</li>';
                                      
                                    ?>
                                    
                                  </ul>
                                </div>
                                <div class="col-md-4 ">
                                  <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                    
                                    <?php

                                      if(isset($result['type']))
                                      for($i = 0.6 * count($result['type']); $i < count($result['type']); $i++)
                                      echo '<li>'.$result['type'][$i].'</li>';
                                      
                                    ?>
                                    





                                    



                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="theme-item-page-details-section">
                          <div class="row">
                            <div class="col-md-3 ">
                              <h5 class="theme-item-page-details-section-title">Amenities</h5>
                            </div>
                            <div class="col-md-9 ">
                              <div class="row">
                                <div class="col-md-4 ">
                                  <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                    
                                    
                                    
                                    
                                    
                                    




                                    
                                    
                                    <?php

                                      if(isset($result['amenities']))
                                      for($i = 0; $i < 0.3 * count($result['amenities']); $i++)
                                      echo '<li>'.$result['amenities'][$i].'</li>';
                                      
                                    ?>

                                  </ul>
                                </div>
                                <div class="col-md-4 ">
                                  <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                    
                                    <?php

                                      if(isset($result['amenities']))
                                      for($i = 0.3 * count($result['amenities']); $i < 0.6 * count($result['amenities']); $i++)
                                      echo '<li>'.$result['amenities'][$i].'</li>';
                                      
                                    ?>
                                    
                                  </ul>
                                </div>
                                <div class="col-md-4 ">
                                  <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                    
                                    <?php

                                      if(isset($result['amenities']))
                                      for($i = 0.6 * count($result['amenities']); $i < count($result['amenities']); $i++)
                                      echo '<li>'.$result['amenities'][$i].'</li>';
                                      
                                    ?>
                                    





                                    



                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="theme-item-page-details-section">
                          <div class="row">
                            <div class="col-md-3 ">
                              <h5 class="theme-item-page-details-section-title">Facilities</h5>
                            </div>
                            <div class="col-md-9 ">
                              <div class="row">
                                <div class="col-md-4 ">
                                  <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                    
                                    
                                    
                                    
                                    
                                    




                                    
                                    
                                    <?php

                                      if(isset($result['facilities']))
                                      for($i = 0; $i < 0.3 * count($result['facilities']); $i++)
                                      echo '<li>'.$result['facilities'][$i].'</li>';
                                      
                                    ?>

                                  </ul>
                                </div>
                                <div class="col-md-4 ">
                                  <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                    
                                    <?php

                                      if(isset($result['facilities']))
                                      for($i = ceil(0.3 * count($result['facilities'])); $i < 0.6 * count($result['facilities']); $i++)
                                      echo '<li>'.$result['facilities'][$i].'</li>';
                                      
                                    ?>

                                  </ul>
                                </div>
                                <div class="col-md-4 ">
                                  <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                  
                                    <?php

                                      if(isset($result['facilities']))
                                      for($i = ceil(0.6 * count($result['facilities'])); $i < count($result['facilities']); $i++)
                                      echo '<li>'.$result['facilities'][$i].'</li>';
                                      
                                    ?>






                                  
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="theme-item-page-details-section">
                          <div class="row">
                            <div class="col-md-3 ">
                              <h5 class="theme-item-page-details-section-title">House & Vicinity Rules</h5>
                            </div>
                            <div class="col-md-9 ">
                            <?php echo (isset($result['rules'])) ? $result['rules'] : '';?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="HotelPageTabs-2" role="tab-panel">
                    <div class="theme-item-page-map google-map" data-lat="40.7483624" data-lng="-73.9900896"></div>
                  </div>
                  <div class="tab-pane" id="HotelPageTabs-3" role="tab-panel">
                    <div class="theme-reviews">
                      <div class="theme-reviews-list">
                        <article class="theme-reviews-item">
                          <div class="row" data-gutter="10">
                            <div class="col-md-3 ">
                              <div class="theme-reviews-item-info">
                                <img class="theme-reviews-item-avatar" src=".././img/70x70.png" alt="Image Alternative text" title="Image Title"/>
                                <p class="theme-reviews-item-date">Reviewed Sun, Jun 24</p>
                                <p class="theme-reviews-item-author">by Leah Kerr</p>
                              </div>
                            </div>
                            <div class="col-md-9 ">
                              <div class="theme-reviews-rating">
                                <ul class="theme-reviews-rating-stars">
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
                                    <i class="fa fa-star-o"></i>
                                  </li>
                                </ul>
                              </div>
                              <div class="theme-reviews-item-body">
                                <p class="theme-reviews-item-text">Inceptos erat phasellus sed parturient a nascetur ligula leo tortor ipsum duis rhoncus elit sapien tristique curae morbi consequat cubilia hendrerit luctus sit bibendum erat quisque dictum orci suspendisse turpis platea eros cursus himenaeos at senectus iaculis odio etiam sit molestie porta amet facilisis varius sodales donec condimentum in</p>
                              </div>
                            </div>
                          </div>
                        </article>
                        <article class="theme-reviews-item">
                          <div class="row" data-gutter="10">
                            <div class="col-md-3 ">
                              <div class="theme-reviews-item-info">
                                <img class="theme-reviews-item-avatar" src=".././img/70x70.png" alt="Image Alternative text" title="Image Title"/>
                                <p class="theme-reviews-item-date">Reviewed Sat, Jun 23</p>
                                <p class="theme-reviews-item-author">by Elizabeth Wallace</p>
                              </div>
                            </div>
                            <div class="col-md-9 ">
                              <div class="theme-reviews-rating">
                                <ul class="theme-reviews-rating-stars">
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
                                    <i class="fa fa-star-half-o"></i>
                                  </li>
                                </ul>
                              </div>
                              <div class="theme-reviews-item-body">
                                <p class="theme-reviews-item-text">Ultricies cursus per dolor volutpat dolor tristique aliquet massa sodales tempus praesent vehicula etiam ante dis aliquet taciti etiam tincidunt</p>
                              </div>
                            </div>
                          </div>
                        </article>
                        <article class="theme-reviews-item">
                          <div class="row" data-gutter="10">
                            <div class="col-md-3 ">
                              <div class="theme-reviews-item-info">
                                <img class="theme-reviews-item-avatar" src=".././img/70x70.png" alt="Image Alternative text" title="Image Title"/>
                                <p class="theme-reviews-item-date">Reviewed Fri, Jun 22</p>
                                <p class="theme-reviews-item-author">by Oliver Ross</p>
                              </div>
                            </div>
                            <div class="col-md-9 ">
                              <div class="theme-reviews-rating">
                                <ul class="theme-reviews-rating-stars">
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
                                    <i class="fa fa-star-o"></i>
                                  </li>
                                  <li>
                                    <i class="fa fa-star-o"></i>
                                  </li>
                                </ul>
                              </div>
                              <div class="theme-reviews-item-body">
                                <p class="theme-reviews-item-text">Platea volutpat amet dolor sociis urna ultrices rutrum donec vitae viverra enim sociosqu est cras ridiculus id ante lacus dolor turpis malesuada volutpat taciti habitasse sed purus himenaeos facilisis sociis iaculis volutpat sit lacinia dis penatibus habitasse consequat libero nascetur class lectus semper urna posuere vel posuere blandit</p>
                              </div>
                            </div>
                          </div>
                        </article>
                        <article class="theme-reviews-item">
                          <div class="row" data-gutter="10">
                            <div class="col-md-3 ">
                              <div class="theme-reviews-item-info">
                                <img class="theme-reviews-item-avatar" src=".././img/70x70.png" alt="Image Alternative text" title="Image Title"/>
                                <p class="theme-reviews-item-date">Reviewed Thu, Jun 21</p>
                                <p class="theme-reviews-item-author">by John Doe</p>
                              </div>
                            </div>
                            <div class="col-md-9 ">
                              <div class="theme-reviews-rating">
                                <ul class="theme-reviews-rating-stars">
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
                                    <i class="fa fa-star-o"></i>
                                  </li>
                                </ul>
                              </div>
                              <div class="theme-reviews-item-body">
                                <p class="theme-reviews-item-text">Mi hendrerit in hendrerit purus imperdiet dignissim dapibus netus suscipit mi posuere fames class scelerisque purus turpis proin ligula suspendisse lectus montes tellus neque sodales rutrum egestas convallis nascetur duis egestas class neque nulla ligula feugiat ac parturient malesuada nibh massa aenean facilisis semper</p>
                              </div>
                            </div>
                          </div>
                        </article>
                        <article class="theme-reviews-item">
                          <div class="row" data-gutter="10">
                            <div class="col-md-3 ">
                              <div class="theme-reviews-item-info">
                                <img class="theme-reviews-item-avatar" src=".././img/70x70.png" alt="Image Alternative text" title="Image Title"/>
                                <p class="theme-reviews-item-date">Reviewed Mon, Jun 18</p>
                                <p class="theme-reviews-item-author">by Cheryl Gustin</p>
                              </div>
                            </div>
                            <div class="col-md-9 ">
                              <div class="theme-reviews-rating">
                                <ul class="theme-reviews-rating-stars">
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
                                    <i class="fa fa-star-o"></i>
                                  </li>
                                  <li>
                                    <i class="fa fa-star-o"></i>
                                  </li>
                                </ul>
                              </div>
                              <div class="theme-reviews-item-body">
                                <p class="theme-reviews-item-text">Torquent eu natoque quisque taciti ipsum morbi blandit montes consectetur fames ridiculus dui torquent in pharetra egestas integer feugiat pretium a sociosqu quam fames pellentesque tempor interdum egestas turpis enim enim scelerisque molestie senectus nascetur inceptos elementum consequat magna sagittis elementum scelerisque nam</p>
                              </div>
                            </div>
                          </div>
                        </article>
                        <div class="row">
                          <div class="col-md-9 col-md-offset-3">
                            <a class="theme-reviews-more" href="#">&#x2b; More Reviews</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="sticky-col">
              <div class="theme-search-area _mb-20 _p-20 _b _bc-dw _mob-h theme-search-area-vert">
                <div class="theme-search-area-header _mb-20 theme-search-area-header-sm">
                  <h1 class="theme-search-area-title">Reserve Property</h1>
                  <p class="theme-search-area-subtitle">You pay 5% of the property value to reserve it</p>
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
                          <h5 class="theme-item-page-summary-price-item-title">Reservation fee (5%)</h5>
                          <p class="theme-item-page-summary-price-item-subtitle"></p>
                          <p class="theme-item-page-summary-price-item-price" data-price="<?php echo isset($result['price']) ? 0.05 * $result['price'] : '0';?>"><span class="currency-symbol">₦</span><?php echo isset($result['price']) ? '<span class="currency-value" data-value="'.(0.05 * $result['price']).'">'.(0.05 * $result['price']).'</span>' : '0';?></p>
                        </li>
                      </ul>
                    </div>
                    <p class="theme-item-page-summary-price-total" id="total-booking" data-id="<?php echo isset($property_id) ? $property_id : '0';?>">Total Due
                      <span><span class="currency-symbol">₦</span><?php echo isset($result['price']) ? '<span class="currency-value" data-value="'.(0.05 * $result['price']).'">'.(0.05 * $result['price']).'</span>' : '0';?></span>
                    </p>
                  </div>
                  <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved" id="book" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);">Reserve Now</button>
                </div>
              </div>
              <div class="theme-sidebar-section _mb-10">
                <ul class="theme-sidebar-section-features-list">
                  <li>
                    <h5 class="theme-sidebar-section-features-list-title">Manage your reservations!</h5>
                    <p class="theme-sidebar-section-features-list-body">You're in control of your reservation - no registration required.</p>
                  </li>
                  <li>
                    <h5 class="theme-sidebar-section-features-list-title">Customer support available 24/7 worldwide!</h5>
                    <p class="theme-sidebar-section-features-list-body">Website and customer support in English and several other languages.</p>
                  </li>
                </ul>
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
    <script src="../js/fix-properties.js"></script>
  </body>
</html>