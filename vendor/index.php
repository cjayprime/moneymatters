<?php

    require_once('../database.php');

    
    //GET Parameters
    $start = isset($_GET['start']) ? mysqli_real_escape_string($database,$_GET['start']) : '2019-03-01';
    $end = isset($_GET['end']) ? mysqli_real_escape_string($database,$_GET['end']) : '2019-03-30';
    $category = isset($_GET['end']) ? mysqli_real_escape_string($database,$_GET['category']) : 'revenue';
    $_type = isset($_GET['type']) ? mysqli_real_escape_string($database,$_GET['type']) : 'hotels';
    

    //Convert all currencies to $currency or revert to USD if currency doesn't exist
    $sql = "SELECT * FROM `admin` WHERE `page` = 'settings' AND `title` = 'admin'";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $admin = array();
    if($num > 0){
      $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $admin['currency'] = json_decode($rows['currency'],true);
    }

    
    
    //GET Parameters
    $currency = isset($_GET['currency']) && array_key_exists($_GET['currency'],$admin['currency']) ? mysqli_real_escape_string($database,strtoupper($_GET['currency'])) : 'NGN';

    $sql = "SELECT * FROM `booking` WHERE (`vendor_id` = '$vendor_id') AND (`status` != '-1') AND (`type` = '$_type') AND (`date` BETWEEN '$start' AND '$end') ORDER BY `date` ASC";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $result = array();
    // All booking data
    if($num > 0)
    while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
      array_push($result,$rows);
    }

    function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' ){
      $datetime1 = date_create($date_1);
      $datetime2 = date_create($date_2);
    
      $interval = date_diff($datetime1, $datetime2);
    
      return $interval->format($differenceFormat);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130582519-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-130582519-1');
    </script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Azia">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/azia/img/azia-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/azia">
    <meta property="og:title" content="Azia">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <title>Vendor / Dashboard</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="../lib/morris.js/morris.css" rel="stylesheet">
    <link href="../lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="../lib/jqvmap/jqvmap.min.css" rel="stylesheet">
    <link href="../lib/pickerjs/picker.min.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">

  </head>
  <body class="az-body az-body-sidebar">

    
    <?php
      
      $options = array('page' => 'index','subpage'=>'');
      require_once('sidebar.php');
    ?>




    <div class="az-content az-content-dashboard-two">
      
    

    
    
      <?php
        require_once('header.php');
      ?>
    
    
    
      
    
    
      <div class="az-content-header d-block d-md-flex">
        <div>
          <h2 class="az-content-title tx-24 mg-b-5 mg-b-lg-8">Hi, welcome back to the Moneymatters Vendor Admin Panel!</h2>
          <p class="mg-b-0">Your sales monitoring dashboard.</p>
        </div>
      </div><!-- az-content-header -->
      <div class="az-content-body">
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div class="card card-dashboard-seven">
          <div class="card-header">
            <div class="row row-sm">
              <div class="col-6 col-md-4 col-xl">
                <div class="media">
                  <div><i class="icon ion-ios-calendar"></i></div>
                  <div class="media-body">
                    <label>Start Date</label>
                    <div class="date">
                      <span id="start" style="cursor:pointer;white-space:pre;overflow:hidden;text-overflow:ellipsis;" data-date="2019-3-1"><?php 
                      
                      $date = strtotime($start);
                      $date_ = getdate($date);
                      echo $date_['month'] . ' ' . $date_['mday'] . ', ' . $date_['year'];
                      
                      ?></span> &nbsp;<i class="icon ion-md-arrow-dropdown"></i>
                    </div>
                  </div>
                </div><!-- media -->
              </div>
              <div class="col-6 col-md-4 col-xl">
                <div class="media">
                  <div><i class="icon ion-ios-calendar"></i></div>
                  <div class="media-body">
                    <label>End Date</label>
                    <div class="date">
                      <span id="end" style="cursor:pointer;white-space:pre;overflow:hidden;text-overflow:ellipsis;" data-date="2019-3-30"><?php 
                      
                      $date = strtotime($end);
                      $date_ = getdate($date);
                      echo $date_['month'] . ' ' . $date_['mday'] . ', ' . $date_['year'];
                      
                      ?></span> &nbsp;<i class="icon ion-md-arrow-dropdown"></i>
                    </div>
                  </div>
                </div><!-- media -->
              </div>
              <div class="col-6 col-md-4 col-xl mg-t-15 mg-md-t-0">
                <div class="media">
                  <div><i class="icon ion-logo-usd"></i></div>
                  <div class="media-body az-header-menu">
                    <label>Category</label>
                    <div class="date nav-item">
                      <span id="category" class="nav-item with-sub" style="cursor:pointer;"><?php echo ucwords($category)?></span> <a href=""><i class="icon ion-md-arrow-dropdown"></i></a>
                      <nav class="az-menu-sub" style="z-index:10000; color:#000;">
                        <div class="nav-link" style="cursor:pointer;color:#000;">Revenue</div>
                        <div class="nav-link" style="cursor:pointer;color:#000;">Quantity</div>
                        <div class="nav-link" style="cursor:pointer;color:#000;">Fees</div>
                        <div class="nav-link" style="cursor:pointer;color:#000;">Profit</div>
                      </nav>
                    </div>
                  </div>
                </div><!-- media -->
              </div>
              <div class="col-6 col-md-4 col-xl mg-t-15 mg-xl-t-0">
                <div class="media">
                  <div><i class="icon ion-md-person"></i></div>
                  <div class="media-body az-header-menu">
                    <label>Type</label>
                    <div class="date nav-item">
                      <span id="type" class="nav-item with-sub" style="cursor:pointer;"><?php echo ucwords($_type)?></span> <a href=""><i class="icon ion-md-arrow-dropdown"></i></a>
                      <nav class="az-menu-sub" style="z-index:10000; color:#000;">
                        <div class="nav-link" style="cursor:pointer;color:#000;">Hotels</div>
                        <div class="nav-link" style="cursor:pointer;color:#000;">Travel</div>
                        <div class="nav-link" style="cursor:pointer;color:#000;">Finance</div>
                        <div class="nav-link" style="cursor:pointer;color:#000;">Insurance</div>
                        <div class="nav-link" style="cursor:pointer;color:#000;">Wedding</div>
                        <div class="nav-link" style="cursor:pointer;color:#000;">Events</div>
                        <div class="nav-link" style="cursor:pointer;color:#000;">Property</div>
                      </nav>
                    </div>
                  </div>
                </div><!-- media -->
              </div>
              <div class="col-md-4 col-xl mg-t-15 mg-xl-t-0">
                <div class="media">
                  <div><i class="icon ion-md-stats"></i></div>
                  <div class="media-body az-header-menu">
                    <label>Currency</label>
                    <div class="date nav-item">
                      <span id="currency" class="nav-item with-sub" style="cursor:pointer;"><?php echo $currency?></span> <a href=""><i class="icon ion-md-arrow-dropdown"></i></a>
                      <nav class="az-menu-sub" style="z-index:10000; color:#000;">

                        
                        
                        
                        
                        
                        
                        <?php
                          foreach($admin['currency'] as $key => $value){
                            echo '<div class="nav-link" style="cursor:pointer;color:#000;">'.$key.'</div>';
                          }
                        ?>






                      </nav>
                    </div>
                  </div>
                </div><!-- media -->
              </div>
              <div class="col-md-4 col-xl mg-t-15 mg-xl-t-0">
                <div class="media">
                  <input id="load" type="button" value="Load" style="width:100px;height:34px;border:0;background:#97A3B9;color:#FFF;" />
                </div><!-- media -->
              </div>
            </div><!-- row -->
          </div><!-- card-header -->
          <div class="card-body">
            <div class="row row-sm">
              <div class="col-6 col-lg-3">
                <label class="az-content-label">Total Sales</label>
                






                  
                  
                  <?php
                  //Graph of the quantity per day for the entire selected period (i.e quantity against time(day))
                    $accumulate = array();
                    for($i = 0; $i < count($result); $i++){
                      $date = explode(' ',$result[$i]['date']);
                      $date = $date[0];
                      $quantity = 1;
                      
                      if(isset($accumulate[$date])){
                        $accumulate[$date] += $quantity;
                      }else{
                        $accumulate[$date] = $quantity;
                      }
                    }
  
                    $lines = '';
                    $m = 0;
                    $min = 1;
                    $max = 1;
                    $total_quantity = 0;
                    foreach($accumulate as $key => $value){
                      $total_quantity += $accumulate[$key];
                      if($value <= $min)$min = $value;
                      if($value > $max)$max = $value;
                      $lines .= $m == count($accumulate) - 1 ? $accumulate[$key] : $accumulate[$key].',';
                      $m++;
                    }
  
                    $percentage = $min == 0 ? 0 : round((($max - $min) / $min) * 100, 2);
                    $direction = $percentage <= 0 ? 'down' : 'up';
                    $days = isset($result[0]['date']) ? dateDifference($result[0]['date'],$result[count($result) - 1]['date']) : 0;
                    
                    echo '<h2>'.number_format($total_quantity).'</h2>';
                    echo '
                        <div class="desc '.$direction.'">
                          <i class="icon ion-md-stats"></i>
                          <span><strong>'.$percentage.'%</strong> ('.$days.' days)</span>
                        </div>';
                    echo  '<span id="compositeline2">'.$lines.'</span>';
                  ?>
                  
  
  
  
  
  





              </div><!-- col -->
              <div class="col-6 col-lg-3">
                <label class="az-content-label">Total Fees</label>
                






                <?php
                //Graph of the quantity per day for the entire selected period (i.e quantity against time(day))

                  $accumulate = array();
                  for($i = 0; $i < count($result); $i++){
                    $date = explode(' ',$result[$i]['date']);
                    $date = $date[0];
                    $fee = $result[$i]['fee'];

                    //Convert all currencies to $currency and if it fails convert to USD
                    if($currency != $result[$i]['currency']){
                      if($currency != 'USD'){
                        //First convert to USD
                        $usd = $fee / $result[$i]['rate'];
                        //Then convert to $currency
                        if(isset($admin['currency'][$currency])){
                          $fee = $usd * $admin['currency'][$currency];
                        }else continue;
                      }else{
                        $fee = $fee * $admin['currency'][$currency];
                      }
                    }
                    
                    if(isset($accumulate[$date])){
                      $accumulate[$date] += $fee;
                    }else{
                      $accumulate[$date] = $fee;
                    }
                  }

                  $lines = '';
                  $m = 0;
                  $total_fee = 0;
                  foreach($accumulate as $key => $value){
                    $total_fee += $accumulate[$key];
                    $lines .= $m == count($accumulate) - 1 ? $accumulate[$key] : $accumulate[$key].',';
                    $m++;
                  }

                  $min = isset($result[0]['fee']) ? $result[0]['fee'] : 1;
                  $max = isset($result[0]['fee']) ? $result[count($result) - 1]['fee'] : 1;
                  $percentage = $min == 0 ? 0 : round((($max - $min) / $min) * 100, 2);
                  $direction = $percentage <= 0 ? 'down' : 'up';
                  $days = isset($result[0]['date']) ? dateDifference($result[0]['date'],$result[count($result) - 1]['date']) : 0;

                  echo '<h2><span>'.$currency.' </span>'.number_format($total_fee).'</h2>';
                  echo '
                      <div class="desc '.$direction.'">
                        <i class="icon ion-md-stats"></i>
                        <span><strong>'.$percentage.'%</strong> ('.$days.' days)</span>
                      </div>';
                  echo  '<span id="compositeline">'.$lines.'</span>';
                ?>
                







            </div><!-- col -->
              <div class="col-6 col-lg-3 mg-t-20 mg-lg-t-0">
                <label class="az-content-label">Total Revenue</label>
                






                <?php
                //Graph of the quantity per day for the entire selected period (i.e quantity against time(day))

                  $accumulate = array();
                  for($i = 0; $i < count($result); $i++){
                    $date = explode(' ',$result[$i]['date']);
                    $date = $date[0];
                    $amount = $result[$i]['amount'];
                    
                    //Convert all currencies to $currency and if it fails convert to USD
                    if($currency != $result[$i]['currency']){
                      if($currency != 'USD'){
                        //First convert to USD
                        $usd = $amount / $result[$i]['rate'];//$admin['currency'][$result[$i]['currency']]
                        //Then convert to $currency
                        if(isset($admin['currency'][$currency])){
                          $amount = $usd * $admin['currency'][$currency];
                        }else continue;
                        //echo $amount.'/'.$admin['currency'][$currency].'<br>';
                      }else{
                        $amount = $amount * $admin['currency'][$currency];
                      }
                    }
                    
                    if(isset($accumulate[$date])){
                      $accumulate[$date] += $amount;
                    }else{
                      $accumulate[$date] = $amount;
                    }
                  }

                  $lines = '';
                  $m = 0;
                  $total_revenue = 0;
                  foreach($accumulate as $key => $value){
                    $total_revenue += $accumulate[$key];
                    $lines .= $m == count($accumulate) - 1 ? $accumulate[$key] : $accumulate[$key].',';
                    $m++;
                  }

                  $min = isset($result[0]['amount']) ? $result[0]['amount'] : 1;
                  $max = isset($result[0]['amount']) ? $result[count($result) - 1]['amount'] : 1;
                  $percentage = $min == 0 ? 0 : round((($max - $min) / $min) * 100, 2);
                  $direction = $percentage <= 0 ? 'down' : 'up';
                  $days = isset($result[0]['date']) ? dateDifference($result[0]['date'],$result[count($result) - 1]['date']) : 0;
                  $revenue = $accumulate;

                  echo '<h2><span>'.$currency.' </span>'.number_format($total_revenue).'</h2>';
                  echo '
                      <div class="desc '.$direction.'">
                        <i class="icon ion-md-stats"></i>
                        <span><strong>'.$percentage.'%</strong> ('.$days.' days)</span>
                      </div>';
                  echo  '<span id="compositeline4">'.$lines.'</span>';
                ?>
                







            </div><!-- col -->
              <div class="col-6 col-lg-3 mg-t-20 mg-lg-t-0">
                <label class="az-content-label">Total Profit</label>
                






                <?php
                  //Graph of the quantity per day for the entire selected period (i.e quantity against time(day))
                  $accumulate = array();
                  for($i = 0; $i < count($result); $i++){
                    $date = explode(' ',$result[$i]['date']);
                    $date = $date[0];
                    $profit = $result[$i]['amount'] - $result[$i]['fee'];
                    
                    //Convert all currencies to $currency and if it fails convert to USD
                    if($currency != $result[$i]['currency']){
                      if($currency != 'USD'){
                        //First convert to USD
                        $usd = $profit / $result[$i]['rate'];
                        //Then convert to $currency
                        if(isset($admin['currency'][$currency])){
                          $profit = $usd * $admin['currency'][$currency];
                        }else continue;
                      }else{
                        $profit = $profit * $admin['currency'][$currency];
                      }
                    }
                    
                    if(isset($accumulate[$date])){
                      $accumulate[$date] += $profit;
                    }else{
                      $accumulate[$date] = $profit;
                    }
                  }

                  $lines = '';
                  $m = 0;
                  $total_profit = 0;
                  foreach($accumulate as $key => $value){
                    $total_profit += $accumulate[$key];
                    $lines .= $m == count($accumulate) - 1 ? $accumulate[$key] : $accumulate[$key].',';
                    $m++;
                  }

                  $min = isset($result[0]['amount']) && isset($result[0]['fee']) ? $result[0]['amount'] - $result[0]['fee'] : 1;
                  $max = isset($result[0]['amount']) && isset($result[0]['fee']) ? $result[count($result) - 1]['amount'] - $result[count($result) - 1]['fee'] : 1;
                  $percentage = $min == 0 ? 0 : round((($max - $min) / $min) * 100, 2);
                  $direction = $percentage <= 0 ? 'down' : 'up';
                  $days = isset($result[0]['date']) ? dateDifference($result[0]['date'],$result[count($result) - 1]['date']) : 0;
                  $profit = $accumulate;
                  
                  echo '<h2><span>'.$currency.' </span>'.number_format($total_profit).'</h2>';
                  echo '
                      <div class="desc '.$direction.'">
                        <i class="icon ion-md-stats"></i>
                        <span><strong>'.$percentage.'%</strong> ('.$days.' days)</span>
                      </div>';
                  echo  '<span id="compositeline3">'.$lines.'</span>';
                ?>
                







            </div><!-- col -->
            </div><!-- row -->
          </div><!-- card-body -->
        </div><!-- card -->

        <div class="row row-sm mg-b-15 mg-sm-b-20">
          <div class="col-lg-12 col-xl-12">
            <div class="card card-dashboard-six">
              <div class="card-header">
                <div>
                  <label class="az-content-label">This Year's Total Revenue</label>
                  <span class="d-block">Sales Performance for Online and Offline Revenue</span>
                </div>
                <div class="chart-legend">
                  <div><span>Revenue</span> <span class="bg-indigo"></span></div>
                  <div><span>Profit</span> <span class="bg-teal"></span></div>
                </div>
              </div><!-- card-header -->
              <div id="morrisBar1" class="ht-200 ht-lg-250 wd-100p" 
              
              






              
              data-morris='<?php
                $morrisData = array();
                foreach($revenue as $date => $total){
                  $timestamp = strtotime($date);
                  $phpDate = getdate($timestamp);
                  $bar = array('y' => $phpDate['month'] .' '. $phpDate['mday'], 'revenue' => $revenue[$date], 'profit' => $profit[$date]);
                  array_push($morrisData,$bar);
                }
                echo json_encode($morrisData);
              ?>'
              
              
              






              
              ></div>
            </div><!-- card -->
          </div><!-- col -->
        </div><!-- row -->

        <div class="row row-sm mg-b-20 mg-lg-b-0">
          <div class="col-md-6 col-xl-7">
            <div class="card card-table-two">
              <h6 class="card-title">Your Most Recent Earnings</h6>
              <span class="d-block mg-b-20">This is your most recent earnings by date.</span>
              <div class="table-responsive">
                <table class="table table-striped table-dashboard-two">
                  <thead>
                    <tr>
                      <th class="wd-lg-25p">Date</th>
                      <th class="wd-lg-25p tx-right">Currency</th>
                      <th class="wd-lg-25p tx-right">Amount</th>
                      <th class="wd-lg-25p tx-right">Rate</th>
                      <th class="wd-lg-25p tx-right">Fee</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    
                    
                    
                    
                    
                    
                    
                    <?php
                      for($i = count($result) - 1; $i >= 0; $i--){
                        if($i == (count($result) - 6))break;
                        $_currency = $result[$i]['currency'];
                        $amount = $result[$i]['amount'];
                        $rate = $result[$i]['rate'];
                        $fee = $result[$i]['fee'];
                        $timestamp = strtotime($result[$i]['date']);
                        $phpDate = getdate($timestamp);
                        $date = $phpDate['mday'] . ' ' . $phpDate['month'] . ' ' . $phpDate['year'];
                        echo <<<EOT
                          <tr>
                            <td>{$date}</td>
                            <td class="tx-right tx-medium tx-inverse">{$_currency}</td>
                            <td class="tx-right tx-medium tx-inverse">{$amount}</td>
                            <td class="tx-right tx-medium tx-inverse">{$rate}</td>
                            <td class="tx-right tx-medium tx-danger">-{$fee}</td>
                          </tr>
EOT;
                      }
                    ?>








                  
                    
                  </tbody>
                </table>
              </div><!-- table-responsive -->
            </div><!-- card-dashboard-five -->
          </div>
          <div class="col-md-6 col-xl-5 mg-t-20 mg-md-t-0">
            <div class="card card-dashboard-eight">
              <h6 class="card-title">Your most recent gains</h6>
              <span class="d-block mg-b-20">This is your most recent profit by date</span>

              <div class="list-group">
                    
                    
                    
                    
                    
                    
                    
                    
                    <?php
                      for($i = count($result) - 1; $i >= 0; $i--){
                        if($i == (count($result) - 6))break;
                        $profit = $result[$i]['amount'] - $result[$i]['fee'];
                        $_currency = $result[$i]['currency'];
                        $timestamp = strtotime($result[$i]['date']);
                        $phpDate = getdate($timestamp);
                        $date = $phpDate['mday'] . ' ' . $phpDate['month'] . ' ' . $phpDate['year'];
                        echo <<<EOT
                          <div class="list-group-item">
                            <p>{$date}</p>
                            <span class="tx-danger">{$_currency} {$profit}</span>
                          </div><!-- list-group-item -->
EOT;
                      }
                    ?>
                    
                    
                    
                    
                    
                    
                    
                    
              </div><!-- list-group -->
            </div><!-- card -->
          </div><!-- col -->
        </div><!-- row -->
      </div><!-- az-content-body -->
      <div class="az-footer ht-40">
        <div class="container-fluid pd-t-0-f ht-100p">
          <span>&copy; 2019 Moneymatters Admin Page</span>
          <span>Designed by: GreyLoft</span>
        </div><!-- container -->
      </div><!-- az-footer -->
    </div><!-- az-content -->



















    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>
    <script src="../lib/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../lib/raphael/raphael.min.js"></script>
    <script src="../lib/morris.js/morris.min.js"></script>
    <script src="../lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="../lib/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="../lib/pickerjs/picker.min.js"></script>

    <script src="../js/admin/azia.js"></script>
    <script>
      $(function(){
        'use strict'

        $('.az-sidebar .with-sub').on('click', function(e){
          e.preventDefault();
          $(this).parent().toggleClass('show');
          $(this).parent().siblings().removeClass('show');
        })

        $(document).on('click touchstart', function(e){
          e.stopPropagation();

          // closing of sidebar menu when clicking outside of it
          if(!$(e.target).closest('.az-header-menu-icon').length) {
            var sidebarTarg = $(e.target).closest('.az-sidebar').length;
            if(!sidebarTarg) {
              $('body').removeClass('az-sidebar-show');
            }
          }
        });


        $('#azSidebarToggle').on('click', function(e){
          e.preventDefault();

          if(window.matchMedia('(min-width: 992px)').matches) {
            $('body').toggleClass('az-sidebar-hide');
          } else {
            $('body').toggleClass('az-sidebar-show');
          }
        })

        /* ----------------------------------- */
        /* Dashboard content */

        $('#compositeline').sparkline('html', {
          lineColor: '#cecece',
          lineWidth: 2,
          spotColor: false,
          minSpotColor: false,
          maxSpotColor: false,
          highlightSpotColor: null,
          highlightLineColor: null,
          fillColor: '#f9f9f9',
          //chartRangeMin: 0,
          //chartRangeMax: 10,
          width: '100%',
          height: 20,
          disableTooltips: true
        });

        $('#compositeline2').sparkline('html', {
          lineColor: '#cecece',
          lineWidth: 2,
          spotColor: false,
          minSpotColor: false,
          maxSpotColor: false,
          highlightSpotColor: null,
          highlightLineColor: null,
          fillColor: '#f9f9f9',
          composite: false,
          enableTagOptions:true,
          //chartRangeMin: 0,
          //chartRangeMax: 10,
          width: '100%',
          height: 20,
          disableTooltips: true
        });

        $('#compositeline3').sparkline('html', {
          lineColor: '#cecece',
          lineWidth: 2,
          spotColor: false,
          minSpotColor: false,
          maxSpotColor: false,
          highlightSpotColor: null,
          highlightLineColor: null,
          fillColor: '#f9f9f9',
          //chartRangeMin: 0,
          //chartRangeMax: 10,
          width: '100%',
          height: 20,
          disableTooltips: true
        });

        $('#compositeline4').sparkline('html', {
          lineColor: '#cecece',
          lineWidth: 2,
          spotColor: false,
          minSpotColor: false,
          maxSpotColor: false,
          highlightSpotColor: null,
          highlightLineColor: null,
          fillColor: '#f9f9f9',
          //chartRangeMin: 0,
          //chartRangeMax: 10,
          width: '100%',
          height: 20,
          disableTooltips: true
        });

        $('#compositeline,#compositeline2,#compositeline3,#compositeline4').each(function(){
          $(this).css({width:'100%'})
          .find('canvas').css({width:'100%'});
        });
      

        var morrisData = $('#morrisBar1').data('morris');
        if(morrisData.length){
          new Morris.Bar({
            element: 'morrisBar1',
            data: morrisData,
            xkey: 'y',
            ykeys: ['revenue', 'profit'],
            labels: ['Revenue', 'Profit'],
            barColors: ['#560bd0', '#00cccc'],
            preUnits: '<?php echo $currency;?> ',
            barSizeRatio: 0.55,
            gridTextSize: 11,
            gridTextColor: '#494c57',
            gridTextWeight: 'bold',
            gridLineColor: '#999',
            gridStrokeWidth: 0.25,
            hideHover: 'auto',
            resize: true,
            padding: 5
          });
        }





        /* ----------------------------------- */
        // Added by GreyLoft

        $(document).ready(function(){

          var picker_start = new Picker($('#start')[0], {
            headers: true,
            format: 'MMMM DD, YYYY',
            text: {
                title: 'Pick a Date and Time',
                year: 'Year',
                month: 'Month',
                day: 'Day',
                hour: 'Hour',
                minute: 'Minute'
            },
            pick: function(){
              var d = (new Date(picker_start.getDate(true)));
              $('#start')
              .text(picker_start.getDate(true))
              .data('date',d.getFullYear() +'-'+ (d.getMonth()+1) +'-'+ d.getDate());
            }
          });

          var picker_end = new Picker($('#end')[0], {
            headers: true,
            format: 'MMMM DD, YYYY',
            text: {
                title: 'Pick a Date and Time',
                year: 'Year',
                month: 'Month',
                day: 'Day',
                hour: 'Hour',
                minute: 'Minute'
            },
            pick: function(){
              var d = (new Date(picker_end.getDate(true)));
              $('#end')
              .text(picker_end.getDate(true))
              .data('date',d.getFullYear() +'-'+ (d.getMonth()+1) +'-'+ d.getDate());
            }
          });
          
          $('.nav-link').click(function(){
            if($(this).parent('.az-menu-sub').length == 1){
              $(this).parent('.az-menu-sub').prevAll('span.nav-item.with-sub').text($(this).text());
              $(this).parents('.nav-item').removeClass('show');
            }
          });

          $('#load').click(function(){
            var start = $('#start').data('date');
            var end = $('#end').data('date');
            var category = $('#category').text().toLowerCase();
            var type = $('#type').text().toLowerCase();
            var currency = $('#currency').text();
            window.location = '?start='+start+'&end='+end+'&category='+category+'&type='+type+'&currency='+currency;
          });
          
        });

      });
    </script>
  </body>
</html>
