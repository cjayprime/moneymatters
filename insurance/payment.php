<?php
    
    require_once('../database.php');
    
    // GET: URL request
    $property_id = isset($_GET['id']) ? mysqli_real_escape_string($database,$_GET['id']) : 0;
    $firstname = isset($_GET['firstname']) ? mysqli_real_escape_string($database,$_GET['firstname']) : 0;
    $lastname = isset($_GET['lastname']) ? mysqli_real_escape_string($database,$_GET['lastname']) : 0;
    $email = isset($_GET['email']) ? mysqli_real_escape_string($database,$_GET['email']) : 0;
    
    $sql = "SELECT * FROM `property` WHERE `property_id` = '$property_id'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);

    if($num > 0){
      $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $result['address'] = $result['full_address'];
      $result['pictures'] = json_decode($result['pictures'],true);
    }else{
      $result = array();
    }
    

    // Admin
    $sql = "SELECT `fee` FROM `admin` WHERE `title` = 'moneymatters' AND `page` = 'property' AND `access` = 'system'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $admin = array();
    if($num > 0){
      $admin = mysqli_fetch_array($query,MYSQLI_ASSOC);
      //$admin['price'] = json_decode($result['price'],true);
    }

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Property / Booking</title>
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
    <nav class="navbar navbar-default navbar-inverse navbar-theme" id="main-nav">
      <div class="container">
        <div class="navbar-inner nav">
          <div class="navbar-header">
            <button class="navbar-toggle collapsed" data-target="#navbar-main" data-toggle="collapse" type="button" area-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">
              <img src="img/logo.png" alt="Image Alternative text" title="Image Title"/>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbar-main">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a class="dropdown-toggle" href="index.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                <div class="dropdown-menu dropdown-menu-lg">
                  <div class="row">
                    <div class="col-md-4">
                      <h5 class="dropdown-meganav-list-title">Homepages</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="index.html">Index 1</a>
                        </li>
                        <li>
                          <a href="index-2.html">Index 2</a>
                        </li>
                        <li>
                          <a href="index-3.html">Index 3</a>
                        </li>
                        <li>
                          <a href="index-4.html">Index 4</a>
                        </li>
                        <li>
                          <a href="index-5.html">Index 5</a>
                        </li>
                        <li>
                          <a href="index-6.html">Index 6</a>
                        </li>
                        <li>
                          <a href="index-7.html">Index 7</a>
                        </li>
                        <li>
                          <a href="index-8.html">Index 8</a>
                        </li>
                        <li>
                          <a href="index-9.html">Index 9</a>
                        </li>
                        <li>
                          <a href="index-10.html">Index 10</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5 class="dropdown-meganav-list-title">Misc</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="blog.html">Blog</a>
                        </li>
                        <li>
                          <a href="blog-post.html">Blog Post</a>
                        </li>
                        <li>
                          <a href="404.html">404</a>
                        </li>
                        <li>
                          <a href="about-us.html">About Us</a>
                        </li>
                        <li>
                          <a href="contact.html">Contact</a>
                        </li>
                        <li>
                          <a href="login.html">Login</a>
                        </li>
                        <li>
                          <a href="login-2.html">Login 2</a>
                        </li>
                        <li>
                          <a href="register.html">Register</a>
                        </li>
                        <li>
                          <a href="pwd-reset.html">Reset password</a>
                        </li>
                        <li>
                          <a href="payment-success.html">Sucess Payment</a>
                        </li>
                        <li>
                          <a href="coming-soon.html">Coming Soon</a>
                        </li>
                        <li>
                          <a href="loading.html">Loading</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5 class="dropdown-meganav-list-title">Country/City</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="index-city-1.html">Index City 1</a>
                        </li>
                        <li>
                          <a href="index-city-2.html">Index City 2</a>
                        </li>
                        <li>
                          <a href="index-city-3.html">Index City 3</a>
                        </li>
                        <li>
                          <a href="index-country-1.html">Index Country 1</a>
                        </li>
                        <li>
                          <a href="index-country-2.html">Index Country 2</a>
                        </li>
                        <li>
                          <a href="index-country-3.html">Index Country 3</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" href="hotel-index-1.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hotels</a>
                <div class="dropdown-menu dropdown-menu-xl">
                  <div class="row">
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Homepages</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="hotel-index-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="hotel-index-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="hotel-index-3.html">Layout 3</a>
                        </li>
                        <li>
                          <a href="hotel-index-4.html">Layout 4</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Search Results</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="hotel-results-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="hotel-results-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="hotel-results-3.html">Layout 3</a>
                        </li>
                        <li>
                          <a href="hotel-results-4.html">Layout 4</a>
                        </li>
                        <li>
                          <a href="hotel-results-5.html">Layout 5</a>
                        </li>
                        <li>
                          <a href="hotel-results-6.html">Layout 6</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Hotel Pages</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="hotel-page-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="hotel-page-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="hotel-page-3.html">Layout 3</a>
                        </li>
                        <li>
                          <a href="hotel-page-4.html">Layout 4</a>
                        </li>
                        <li>
                          <a href="hotel-page-5.html">Layout 5</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Payment</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="hotel-payment-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="hotel-payment-2.html">Layout 2</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
              <li class="active dropdown">
                <a class="dropdown-toggle" href="room-index-1.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Rooms</a>
                <div class="dropdown-menu dropdown-menu-xl">
                  <div class="row">
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Homepages</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="room-index-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="room-index-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="room-index-3.html">Layout 3</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Search Results</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="room-results-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="room-results-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="room-results-3.html">Layout 3</a>
                        </li>
                        <li>
                          <a href="room-results-4.html">Layout 4</a>
                        </li>
                        <li>
                          <a href="room-results-5.html">Layout 5</a>
                        </li>
                        <li>
                          <a href="room-results-6.html">Layout 6</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Room Pages</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="room-page-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="room-page-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="room-page-3.html">Layout 3</a>
                        </li>
                        <li>
                          <a href="room-page-4.html">Layout 4</a>
                        </li>
                        <li>
                          <a href="room-page-5.html">Layout 5</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Payment</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="room-payment-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="room-payment-2.html">Layout 2</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" href="flight-index-1.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Flights</a>
                <div class="dropdown-menu dropdown-menu-lg">
                  <div class="row">
                    <div class="col-md-4">
                      <h5 class="dropdown-meganav-list-title">Homepages</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="flight-index-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="flight-index-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="flight-index-3.html">Layout 3</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5 class="dropdown-meganav-list-title">Search Results</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="flight-results-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="flight-results-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="flight-results-3.html">Layout 3</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5 class="dropdown-meganav-list-title">Payment</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="flight-payment-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="flight-payment-2.html">Layout 2</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" href="car-index-1.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cars</a>
                <div class="dropdown-menu dropdown-menu-lg">
                  <div class="row">
                    <div class="col-md-4">
                      <h5 class="dropdown-meganav-list-title">Homepages</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="car-index-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="car-index-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="car-index-3.html">Layout 3</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5 class="dropdown-meganav-list-title">Search Results</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="car-results-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="car-results-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="car-results-3.html">Layout 3</a>
                        </li>
                        <li>
                          <a href="car-results-4.html">Layout 4</a>
                        </li>
                        <li>
                          <a href="car-results-5.html">Layout 5</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5 class="dropdown-meganav-list-title">Payment</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="car-payment-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="car-payment-2.html">Layout 2</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" href="exp-index-1.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Experiences</a>
                <div class="dropdown-menu dropdown-menu-xl">
                  <div class="row">
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Homepages</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="exp-index-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="exp-index-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="exp-index-3.html">Layout 3</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Search Results</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="exp-results-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="exp-results-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="exp-results-3.html">Layout 3</a>
                        </li>
                        <li>
                          <a href="exp-results-4.html">Layout 4</a>
                        </li>
                        <li>
                          <a href="exp-results-5.html">Layout 5</a>
                        </li>
                        <li>
                          <a href="exp-results-6.html">Layout 6</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Event Pages</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="exp-page-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="exp-page-2.html">Layout 2</a>
                        </li>
                        <li>
                          <a href="exp-page-3.html">Layout 3</a>
                        </li>
                        <li>
                          <a href="exp-page-4.html">Layout 4</a>
                        </li>
                        <li>
                          <a href="exp-page-5.html">Layout 5</a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <h5 class="dropdown-meganav-list-title">Payment</h5>
                      <ul class="dropdown-meganav-list-items">
                        <li>
                          <a href="exp-payment-1.html">Layout 1</a>
                        </li>
                        <li>
                          <a href="exp-payment-2.html">Layout 2</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="_desk-h">Currency</span>
                  <b>USD</b>
                </a>
                <div class="dropdown-menu dropdown-menu-xxl">
                  <h5 class="dropdown-meganav-select-list-title">Popular Currencies</h5>
                  <div class="row" data-gutter="10">
                    <div class="col-md-3">
                      <ul class="dropdown-meganav-select-list-currency">
                        <li>
                          <a href="#">
                            <span>€</span>Euro
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>£</span>Pound sterling
                          </a>
                        </li>
                        <li class="active">
                          <a href="#">
                            <span>US$</span>U.S. dollar
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <ul class="dropdown-meganav-select-list-currency">
                        <li>
                          <a href="#">
                            <span>CAD</span>Canadian dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>AUD</span>Australian dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>RUB</span>Russian Ruble
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <ul class="dropdown-meganav-select-list-currency">
                        <li>
                          <a href="#">
                            <span>S$</span>Singapore dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>CNY</span>Chinese yuan
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>¥</span>Japanese yen
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <hr/>
                  <h5 class="dropdown-meganav-select-list-title">All Currencies</h5>
                  <div class="row" data-gutter="10">
                    <div class="col-md-3">
                      <ul class="dropdown-meganav-select-list-currency">
                        <li>
                          <a href="#">
                            <span>AR$</span>Argentine peso
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>AUD</span>Australian dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>AZN</span>Azerbaijan, New Ma...
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>BHD</span>Bahrain dinar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>BRL</span>Brazilian real
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>BGN</span>Bulgarian lev
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>CAD</span>Canadian dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>XOF</span>CFA Franc BCEAO
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>CL$</span>Chilean peso
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>CNY</span>Chinese yuan
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>COP</span>Colombian peso
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>Kč</span>Czech koruna
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>DKK</span>Danish krone
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <ul class="dropdown-meganav-select-list-currency">
                        <li>
                          <a href="#">
                            <span>EGP</span>Egyptian pound
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>€</span>Euro
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>FJD</span>Fijian dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>GEL</span>Georgian lari
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>HK$</span>Hong Kong Dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>HUF</span>Hungarian forint
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>Rs.</span>Indian rupee
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>Rp</span>Indonesian rupiah
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>₪</span>Israeli new sheqel
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>¥</span>Japanese yen
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>JOD</span>Jordanian dinar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>KZT</span>Kazakhstani tenge
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>KRW</span>Korean won
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <ul class="dropdown-meganav-select-list-currency">
                        <li>
                          <a href="#">
                            <span>KWD</span>Kuwaiti dinar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>MYR</span>Malaysian ringgit
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>MXN</span>Mexican peso
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>MDL</span>Moldovan leu
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>NAD</span>Namibian Dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>TWD</span>New Taiwan Dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>NZD</span>New Zealand dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>NOK</span>Norwegian krone
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>OMR</span>Omani rial
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>zł</span>Polish zloty
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>£</span>Pound sterling
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>QAR</span>Qatar riyal
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>lei</span>Romanian new leu
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <ul class="dropdown-meganav-select-list-currency">
                        <li>
                          <a href="#">
                            <span>RUB</span>Russian Ruble
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>SAR</span>Saudi Arabian riyal
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>S$</span>Singapore dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>ZAR</span>South African rand
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>SEK</span>Swedish krona
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>CHF</span>Swiss franc
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>THB</span>Thai baht
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>TL</span>Turkish lira
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>AED</span>U.A.E. dirham
                          </a>
                        </li>
                        <li class="active">
                          <a href="#">
                            <span>US$</span>U.S. dollar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>UAH</span>Ukraine Hryvnia
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <span>UZS</span>Uzbekistan, Sums
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="_desk-h">Language</span>
                  <img class="navbar-flag" src="img/flags/USA.png" alt="Image Alternative text" title="Image Title"/>
                </a>
                <div class="dropdown-menu dropdown-menu-xxl">
                  <h5 class="dropdown-meganav-select-list-title">Languages</h5>
                  <div class="row" data-gutter="10">
                    <div class="col-md-3">
                      <ul class="dropdown-meganav-select-list-lang">
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/UK.png" alt="Image Alternative text" title="Image Title"/>English(UK)
                          </a>
                        </li>
                        <li class="active">
                          <a href="#">
                            <img src="img/flag_codes/US.png" alt="Image Alternative text" title="Image Title"/>English(US)
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/DE.png" alt="Image Alternative text" title="Image Title"/>Deutsch
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/NED.png" alt="Image Alternative text" title="Image Title"/>Nederlands
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/FR.png" alt="Image Alternative text" title="Image Title"/>Français
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/SP.png" alt="Image Alternative text" title="Image Title"/>Español
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/ARG.png" alt="Image Alternative text" title="Image Title"/>Español (AR)
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/IT.png" alt="Image Alternative text" title="Image Title"/>Italiano
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/PT.png" alt="Image Alternative text" title="Image Title"/>Português (PT)
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/BR.png" alt="Image Alternative text" title="Image Title"/>Português (BR)
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/NR.png" alt="Image Alternative text" title="Image Title"/>Norsk
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <ul class="dropdown-meganav-select-list-lang">
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/FIN.png" alt="Image Alternative text" title="Image Title"/>Suomi
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/SW.png" alt="Image Alternative text" title="Image Title"/>Svenska
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/DEN.png" alt="Image Alternative text" title="Image Title"/>Dansk
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/CZ.png" alt="Image Alternative text" title="Image Title"/>Čeština
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/HUN.png" alt="Image Alternative text" title="Image Title"/>Magyar
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/ROM.png" alt="Image Alternative text" title="Image Title"/>Română
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/JP.png" alt="Image Alternative text" title="Image Title"/>日本語
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/CN.png" alt="Image Alternative text" title="Image Title"/>简体中文
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/PL.png" alt="Image Alternative text" title="Image Title"/>Polski
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/GR.png" alt="Image Alternative text" title="Image Title"/>Ελληνικά
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/RU.png" alt="Image Alternative text" title="Image Title"/>Русский
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <ul class="dropdown-meganav-select-list-lang">
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/TUR.png" alt="Image Alternative text" title="Image Title"/>Türkçe
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/BUL.png" alt="Image Alternative text" title="Image Title"/>Български
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/ARB.png" alt="Image Alternative text" title="Image Title"/>العربية
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/KOR.png" alt="Image Alternative text" title="Image Title"/>한국어
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/ISR.png" alt="Image Alternative text" title="Image Title"/>עברית
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/LAT.png" alt="Image Alternative text" title="Image Title"/>Latviski
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/UKR.png" alt="Image Alternative text" title="Image Title"/>Українська
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/IND.png" alt="Image Alternative text" title="Image Title"/>Bahasa Indonesia
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/MAL.png" alt="Image Alternative text" title="Image Title"/>Bahasa Malaysia
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/TAI.png" alt="Image Alternative text" title="Image Title"/>ภาษาไทย
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/EST.png" alt="Image Alternative text" title="Image Title"/>Eesti
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3">
                      <ul class="dropdown-meganav-select-list-lang">
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/CRO.png" alt="Image Alternative text" title="Image Title"/>Hrvatski
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/LIT.png" alt="Image Alternative text" title="Image Title"/>Lietuvių
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/SLO.png" alt="Image Alternative text" title="Image Title"/>Slovenčina
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/SERB.png" alt="Image Alternative text" title="Image Title"/>Srpski
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/SLOVE.png" alt="Image Alternative text" title="Image Title"/>Slovenščina
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/NAM.png" alt="Image Alternative text" title="Image Title"/>Tiếng Việt
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/PHI.png" alt="Image Alternative text" title="Image Title"/>Filipino
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <img src="img/flag_codes/ICE.png" alt="Image Alternative text" title="Image Title"/>Íslenska
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
              <li class="navbar-nav-item-user dropdown">
                <a class="dropdown-toggle" href="account.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user-circle-o navbar-nav-item-user-icon"></i>My Account
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="account.html">Preferences</a>
                  </li>
                  <li>
                    <a href="account-notifications.html">Notifications</a>
                  </li>
                  <li>
                    <a href="account-cards.html">Payment Methods</a>
                  </li>
                  <li>
                    <a href="account-travelers.html">Travelers</a>
                  </li>
                  <li>
                    <a href="account-history.html">History</a>
                  </li>
                  <li>
                    <a href="account-bookmarks.html">Bookmarks</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <div class="theme-page-section theme-page-section-lg">
      <div class="container">
        <div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">
          <div class="col-md-8 ">
            <div class="theme-payment-page-sections">
              <div class="theme-payment-page-sections-item">
                <div class="theme-search-results-item theme-payment-page-item-thumb">
                  <div class="row" data-gutter="20">
                    <div class="col-md-9 ">
                      <h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo isset($result['address']) ? $result['address'] : '' ?></h5>
                      <ul class="theme-search-results-item-room-feature-list">
                        <li>
                          <i class="fa fa-car theme-search-results-item-room-feature-list-icon"></i>
                          <span class="theme-search-results-item-room-feature-list-title"><?php echo (isset($result['garages'])) ? ($result['garages'] > 0 ? $result['garages'].' garages' : $result['garages'].' garage') : '0 guest';?></span>
                        </li>
                        <li>
                          <i class="fa fa-building theme-search-results-item-room-feature-list-icon"></i>
                          <span class="theme-search-results-item-room-feature-list-title"><?php echo (isset($result['floors'])) ? ($result['floors'] > 0 ? $result['floors'].' floors' : $result['floors'].' floor') : '0 floor';?></span>
                        </li>
                        <li>
                          <i class="fa fa-male theme-search-results-item-room-feature-list-icon"></i>
                          <span class="theme-search-results-item-room-feature-list-title"><?php echo (isset($result['guests'])) ? ($result['guests'] > 0 ? $result['guests'].' guests' : $result['guests'].' guest') : '0 guest';?></span>
                        </li>
                        <li>
                          <i class="fa fa-bed theme-search-results-item-room-feature-list-icon"></i>
                          <span class="theme-search-results-item-room-feature-list-title"><?php echo (isset($result['bedroom'])) ? ($result['bedroom'] > 0 ? $result['bedroom'].' beds' : $result['bedroom'].' bed') : '0 bed';?></span>
                        </li>
                        <li>
                          <i class="fa fa-bath theme-search-results-item-room-feature-list-icon"></i>
                          <span class="theme-search-results-item-room-feature-list-title"><?php echo (isset($result['bathroom'])) ? ($result['bathroom'] > 0 ? $result['bathroom'].' beds' : $result['bathroom'].' bed') : '0 bed';?></span>
                        </li>
                      </ul>
                      <p class="theme-search-results-item-location">
                        <i class="fa fa-map-marker"></i>
                        <?php 
                          echo (isset($result['city'])) ? $result['city'] : '';
                          echo (isset($result['state'])) ? ', '.$result['state'] : '';
                          echo (isset($result['country'])) ? ', '.$result['country'] : '';
                        ?>
                      </p>
                    </div>
                    <div class="col-md-3 ">
                      <div class="theme-search-results-item-img-wrap">
                        <img class="theme-search-results-item-img" src="<?php echo (isset($result['pictures']) && isset($result['pictures'][0])) ? $result['pictures'][0] : '';?>" alt="Image Alternative text" title="Image Title"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-payment-page-sections-item">
                <h3 class="theme-payment-page-sections-item-title">Confirm Details</h3>
                <div class="theme-payment-page-form">
                  <div class="row row-col-gap" data-gutter="20">
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="firstname" placeholder="First Name"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="lastname" placeholder="Last Name"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="email" placeholder="Email Address"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="phone" placeholder="Phone Number"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--

              <div class="theme-payment-page-sections-item">
                <h3 class="theme-payment-page-sections-item-title">Select Card</h3>
                <div class="row">
                  <div class="col-md-6 ">
                    <div class="theme-payment-page-form-item form-group">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>**** **** **** 1388 Visa</option>
                        <option>**** **** **** 9763 MasterCard</option>
                        <option>**** **** **** 4845 Visa</option>
                        <option>**** **** **** 4053 Visa</option>
                        <option>**** **** **** 3558 MasterCard</option>
                      </select>
                    </div>
                  </div>
                </div>
                <a class="theme-payment-page-sections-item-new-link" href="#AddNewCard" data-toggle="collapse" aria-expanded="false" aria-controls="AddNewCard">+ Add New Card</a>
                <div class="collapse theme-payment-page-sections-item-new-extend" id="AddNewCard">
                  <div class="theme-payment-page-form _mb-20">
                    <h3 class="theme-payment-page-form-title">Billing Address</h3>
                    <div class="row row-col-gap" data-gutter="20">
                      <div class="col-md-6 ">
                        <div class="theme-payment-page-form-item form-group">
                          <input class="form-control" type="text" placeholder="Street (line 1)"/>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="theme-payment-page-form-item form-group">
                          <input class="form-control" type="text" placeholder="Street (line 2)"/>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="theme-payment-page-form-item form-group">
                          <input class="form-control" type="text" placeholder="Postal Code"/>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="theme-payment-page-form-item form-group">
                          <input class="form-control" type="text" placeholder="City"/>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="theme-payment-page-form-item form-group">
                          <i class="fa fa-angle-down"></i>
                          <select class="form-control">
                            <option>State/Region</option>
                            <option>Alabama</option>
                            <option>Alaska</option>
                            <option>American Samoa</option>
                            <option>Arizona</option>
                            <option>Arkansas</option>
                            <option>California</option>
                            <option>Colorado</option>
                            <option>Connecticut</option>
                            <option>Delaware</option>
                            <option>District Of Columbia</option>
                            <option>Federated States Of Micronesia</option>
                            <option>Florida</option>
                            <option>Georgia</option>
                            <option>Guam</option>
                            <option>Hawaii</option>
                            <option>Idaho</option>
                            <option>Illinois</option>
                            <option>Indiana</option>
                            <option>Iowa</option>
                            <option>Kansas</option>
                            <option>Kentucky</option>
                            <option>Louisiana</option>
                            <option>Maine</option>
                            <option>Marshall Islands</option>
                            <option>Maryland</option>
                            <option>Massachusetts</option>
                            <option>Michigan</option>
                            <option>Minnesota</option>
                            <option>Mississippi</option>
                            <option>Missouri</option>
                            <option>Montana</option>
                            <option>Nebraska</option>
                            <option>Nevada</option>
                            <option>New Hampshire</option>
                            <option>New Jersey</option>
                            <option>New Mexico</option>
                            <option>New York</option>
                            <option>North Carolina</option>
                            <option>North Dakota</option>
                            <option>Northern Mariana Islands</option>
                            <option>Ohio</option>
                            <option>Oklahoma</option>
                            <option>Oregon</option>
                            <option>Palau</option>
                            <option>Pennsylvania</option>
                            <option>Puerto Rico</option>
                            <option>Rhode Island</option>
                            <option>South Carolina</option>
                            <option>South Dakota</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Utah</option>
                            <option>Vermont</option>
                            <option>Virgin Islands</option>
                            <option>Virginia</option>
                            <option>Washington</option>
                            <option>West Virginia</option>
                            <option>Wisconsin</option>
                            <option>Wyoming</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="theme-payment-page-form-item form-group">
                          <i class="fa fa-angle-down"></i>
                          <select class="form-control">
                            <option>Select Country</option>
                            <option>Afghanistan</option>
                            <option>Albania</option>
                            <option>Algeria</option>
                            <option>American Samoa</option>
                            <option>AndorrA</option>
                            <option>Angola</option>
                            <option>Anguilla</option>
                            <option>Antarctica</option>
                            <option>Antigua and Barbuda</option>
                            <option>Argentina</option>
                            <option>Armenia</option>
                            <option>Aruba</option>
                            <option>Australia</option>
                            <option>Austria</option>
                            <option>Azerbaijan</option>
                            <option>Bahamas</option>
                            <option>Bahrain</option>
                            <option>Bangladesh</option>
                            <option>Barbados</option>
                            <option>Belarus</option>
                            <option>Belgium</option>
                            <option>Belize</option>
                            <option>Benin</option>
                            <option>Bermuda</option>
                            <option>Bhutan</option>
                            <option>Bolivia</option>
                            <option>Bosnia and Herzegovina</option>
                            <option>Botswana</option>
                            <option>Bouvet Island</option>
                            <option>Brazil</option>
                            <option>British Indian Ocean Territory</option>
                            <option>Brunei Darussalam</option>
                            <option>Bulgaria</option>
                            <option>Burkina Faso</option>
                            <option>Burundi</option>
                            <option>Cambodia</option>
                            <option>Cameroon</option>
                            <option>Canada</option>
                            <option>Cape Verde</option>
                            <option>Cayman Islands</option>
                            <option>Central African Republic</option>
                            <option>Chad</option>
                            <option>Chile</option>
                            <option>China</option>
                            <option>Christmas Island</option>
                            <option>Cocos (Keeling) Islands</option>
                            <option>Colombia</option>
                            <option>Comoros</option>
                            <option>Congo</option>
                            <option>Congo, The Democratic Republic of the</option>
                            <option>Cook Islands</option>
                            <option>Costa Rica</option>
                            <option>Cote D"Ivoire</option>
                            <option>Croatia</option>
                            <option>Cuba</option>
                            <option>Cyprus</option>
                            <option>Czech Republic</option>
                            <option>Denmark</option>
                            <option>Djibouti</option>
                            <option>Dominica</option>
                            <option>Dominican Republic</option>
                            <option>Ecuador</option>
                            <option>Egypt</option>
                            <option>El Salvador</option>
                            <option>Equatorial Guinea</option>
                            <option>Eritrea</option>
                            <option>Estonia</option>
                            <option>Ethiopia</option>
                            <option>Falkland Islands (Malvinas)</option>
                            <option>Faroe Islands</option>
                            <option>Fiji</option>
                            <option>Finland</option>
                            <option>France</option>
                            <option>French Guiana</option>
                            <option>French Polynesia</option>
                            <option>French Southern Territories</option>
                            <option>Gabon</option>
                            <option>Gambia</option>
                            <option>Georgia</option>
                            <option>Germany</option>
                            <option>Ghana</option>
                            <option>Gibraltar</option>
                            <option>Greece</option>
                            <option>Greenland</option>
                            <option>Grenada</option>
                            <option>Guadeloupe</option>
                            <option>Guam</option>
                            <option>Guatemala</option>
                            <option>Guernsey</option>
                            <option>Guinea</option>
                            <option>Guinea-Bissau</option>
                            <option>Guyana</option>
                            <option>Haiti</option>
                            <option>Heard Island and Mcdonald Islands</option>
                            <option>Holy See (Vatican City State)</option>
                            <option>Honduras</option>
                            <option>Hong Kong</option>
                            <option>Hungary</option>
                            <option>Iceland</option>
                            <option>India</option>
                            <option>Indonesia</option>
                            <option>Iran, Islamic Republic Of</option>
                            <option>Iraq</option>
                            <option>Ireland</option>
                            <option>Isle of Man</option>
                            <option>Israel</option>
                            <option>Italy</option>
                            <option>Jamaica</option>
                            <option>Japan</option>
                            <option>Jersey</option>
                            <option>Jordan</option>
                            <option>Kazakhstan</option>
                            <option>Kenya</option>
                            <option>Kiribati</option>
                            <option>Korea, Democratic People"S Republic of</option>
                            <option>Korea, Republic of</option>
                            <option>Kuwait</option>
                            <option>Kyrgyzstan</option>
                            <option>Lao People"S Democratic Republic</option>
                            <option>Latvia</option>
                            <option>Lebanon</option>
                            <option>Lesotho</option>
                            <option>Liberia</option>
                            <option>Libyan Arab Jamahiriya</option>
                            <option>Liechtenstein</option>
                            <option>Lithuania</option>
                            <option>Luxembourg</option>
                            <option>Macao</option>
                            <option>Macedonia, The Former Yugoslav Republic of</option>
                            <option>Madagascar</option>
                            <option>Malawi</option>
                            <option>Malaysia</option>
                            <option>Maldives</option>
                            <option>Mali</option>
                            <option>Malta</option>
                            <option>Marshall Islands</option>
                            <option>Martinique</option>
                            <option>Mauritania</option>
                            <option>Mauritius</option>
                            <option>Mayotte</option>
                            <option>Mexico</option>
                            <option>Micronesia, Federated States of</option>
                            <option>Moldova, Republic of</option>
                            <option>Monaco</option>
                            <option>Mongolia</option>
                            <option>Montserrat</option>
                            <option>Morocco</option>
                            <option>Mozambique</option>
                            <option>Myanmar</option>
                            <option>Namibia</option>
                            <option>Nauru</option>
                            <option>Nepal</option>
                            <option>Netherlands</option>
                            <option>Netherlands Antilles</option>
                            <option>New Caledonia</option>
                            <option>New Zealand</option>
                            <option>Nicaragua</option>
                            <option>Niger</option>
                            <option>Nigeria</option>
                            <option>Niue</option>
                            <option>Norfolk Island</option>
                            <option>Northern Mariana Islands</option>
                            <option>Norway</option>
                            <option>Oman</option>
                            <option>Pakistan</option>
                            <option>Palau</option>
                            <option>Palestinian Territory, Occupied</option>
                            <option>Panama</option>
                            <option>Papua New Guinea</option>
                            <option>Paraguay</option>
                            <option>Peru</option>
                            <option>Philippines</option>
                            <option>Pitcairn</option>
                            <option>Poland</option>
                            <option>Portugal</option>
                            <option>Puerto Rico</option>
                            <option>Qatar</option>
                            <option>Reunion</option>
                            <option>Romania</option>
                            <option>Russian Federation</option>
                            <option>RWANDA</option>
                            <option>Saint Helena</option>
                            <option>Saint Kitts and Nevis</option>
                            <option>Saint Lucia</option>
                            <option>Saint Pierre and Miquelon</option>
                            <option>Saint Vincent and the Grenadines</option>
                            <option>Samoa</option>
                            <option>San Marino</option>
                            <option>Sao Tome and Principe</option>
                            <option>Saudi Arabia</option>
                            <option>Senegal</option>
                            <option>Serbia and Montenegro</option>
                            <option>Seychelles</option>
                            <option>Sierra Leone</option>
                            <option>Singapore</option>
                            <option>Slovakia</option>
                            <option>Slovenia</option>
                            <option>Solomon Islands</option>
                            <option>Somalia</option>
                            <option>South Africa</option>
                            <option>South Georgia and the South Sandwich Islands</option>
                            <option>Spain</option>
                            <option>Sri Lanka</option>
                            <option>Sudan</option>
                            <option>Suriname</option>
                            <option>Svalbard and Jan Mayen</option>
                            <option>Swaziland</option>
                            <option>Sweden</option>
                            <option>Switzerland</option>
                            <option>Syrian Arab Republic</option>
                            <option>Taiwan, Province of China</option>
                            <option>Tajikistan</option>
                            <option>Tanzania, United Republic of</option>
                            <option>Thailand</option>
                            <option>Timor-Leste</option>
                            <option>Togo</option>
                            <option>Tokelau</option>
                            <option>Tonga</option>
                            <option>Trinidad and Tobago</option>
                            <option>Tunisia</option>
                            <option>Turkey</option>
                            <option>Turkmenistan</option>
                            <option>Turks and Caicos Islands</option>
                            <option>Tuvalu</option>
                            <option>Uganda</option>
                            <option>Ukraine</option>
                            <option>United Arab Emirates</option>
                            <option>United Kingdom</option>
                            <option>United States</option>
                            <option>United States Minor Outlying Islands</option>
                            <option>Uruguay</option>
                            <option>Uzbekistan</option>
                            <option>Vanuatu</option>
                            <option>Venezuela</option>
                            <option>Viet Nam</option>
                            <option>Virgin Islands, British</option>
                            <option>Virgin Islands, U.S.</option>
                            <option>Wallis and Futuna</option>
                            <option>Western Sahara</option>
                            <option>Yemen</option>
                            <option>Zambia</option>
                            <option>Zimbabwe</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="theme-payment-page-form">
                    <h3 class="theme-payment-page-form-title">Card Details</h3>
                    <div class="row row-col-gap" data-gutter="20">
                      <div class="col-md-6 ">
                        <div class="theme-payment-page-form-item form-group">
                          <input class="form-control" type="text" placeholder="Name on Card"/>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="theme-payment-page-form-item form-group">
                          <input class="form-control" type="text" placeholder="Credit/Debit Card Number"/>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="row row-col-gap" data-gutter="10">
                          <div class="col-md-4 ">
                            <div class="theme-payment-page-form-item form-group">
                              <i class="fa fa-angle-down"></i>
                              <select class="form-control">
                                <option>(1) Jan</option>
                                <option>(2) Feb</option>
                                <option>(3) Mar</option>
                                <option>(4) Apr</option>
                                <option>(5) May</option>
                                <option>(6) Jun</option>
                                <option>(7) Jul</option>
                                <option>(8) Aug</option>
                                <option>(9) Sep</option>
                                <option>(10) Oct</option>
                                <option>(11) Nov</option>
                                <option>(12) Dec</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 ">
                            <div class="theme-payment-page-form-item form-group">
                              <i class="fa fa-angle-down"></i>
                              <select class="form-control">
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                                <option>2026</option>
                                <option>2027</option>
                                <option>2028</option>
                                <option>2029</option>
                                <option>2030</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 ">
                            <div class="theme-payment-page-form-item form-group">
                              <input class="form-control" type="text" placeholder="Security Code"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <ul class="theme-payment-page-card-list">
                          <li>
                            <img src="img/credit-icons/mastercard-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                          </li>
                          <li>
                            <img src="img/credit-icons/visa-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                          </li>
                          <li>
                            <img src="img/credit-icons/visa-electron-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                          </li>
                          <li>
                            <img src="img/credit-icons/discover-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                          </li>
                          <li>
                            <img src="img/credit-icons/maestro-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                          </li>
                          <li>
                            <img src="img/credit-icons/american-express-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              -->
              <div class="theme-payment-page-sections-item">
                <div class="theme-payment-page-booking">
                  <div class="theme-payment-page-booking-header">
                    <h3 class="theme-payment-page-booking-title">Total price for this reservation</h3>
                    <p class="theme-payment-page-booking-subtitle">By clicking reserve now button you agree with terms and conditionals and money back gurantee. Thank you for trusting our service.</p>
                    <p class="theme-payment-page-booking-price"><?php echo (isset($result['price'])) ? '$'.(0.05 * $result['price']) : '$0'; ?></p>
                  </div>
                  <a class="btn _tt-uc btn-primary-inverse btn-lg btn-block" id="book-now" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);" href="order.php">Reserve Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="sticky-col">
              <div class="theme-sidebar-section _mb-10">
                <h5 class="theme-sidebar-section-title">Charges</h5>
                <div class="theme-sidebar-section-charges">
                  <ul class="theme-sidebar-section-charges-list">
                    <li class="theme-sidebar-section-charges-item">
                      <h5 class="theme-sidebar-section-charges-item-title">Reservation fee</h5>
                      <p class="theme-sidebar-section-charges-item-subtitle">5% of the property's value</p>
                      <p class="theme-sidebar-section-charges-item-price"><?php echo (isset($result['price'])) ? '$'.(0.05 * $result['price']) : '$0'; ?></p>
                    </li>
                  </ul>
                  <p class="theme-sidebar-section-charges-total">Total
                    <span><?php echo (isset($result['price'])) ? '$'.(0.05 * $result['price']) : '$0'; ?></span>
                  </p>
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
                    <p class="theme-sidebar-section-features-list-body">Website and customer support in English and 41 other languages.</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-footer" id="mainFooter">
      <div class="container _ph-mob-0">
        <div class="row row-eq-height row-mob-full" data-gutter="60">
          <div class="col-md-3">
            <div class="theme-footer-section theme-footer-">
              <a class="theme-footer-brand _mb-mob-30" href="#">
                <img src="img/logo-black.png" alt="Image Alternative text" title="Image Title"/>
              </a>
              <div class="theme-footer-brand-text">
                <p>Parturient mattis feugiat sapien imperdiet primis cursus ridiculus cum non ridiculus magnis nascetur natoque odio</p>
                <p>Mollis nullam sociosqu urna morbi diam auctor ullamcorper adipiscing habitasse euismod vulputate class montes nisi</p>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-4">
                <div class="theme-footer-section theme-footer-">
                  <h5 class="theme-footer-section-title">Travel Mate</h5>
                  <ul class="theme-footer-section-list">
                    <li>
                      <a href="#">About Travel Mate</a>
                    </li>
                    <li>
                      <a href="#">Mobile App</a>
                    </li>
                    <li>
                      <a href="#">Customer Support</a>
                    </li>
                    <li>
                      <a href="#">Advertising</a>
                    </li>
                    <li>
                      <a href="#">Jobs</a>
                    </li>
                    <li>
                      <a href="#">Privacy Policy</a>
                    </li>
                    <li>
                      <a href="#">Terms of Use</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4">
                <div class="theme-footer-section theme-footer-">
                  <h5 class="theme-footer-section-title">Explore</h5>
                  <ul class="theme-footer-section-list">
                    <li>
                      <a href="#">Countries</a>
                    </li>
                    <li>
                      <a href="#">Regions</a>
                    </li>
                    <li>
                      <a href="#">Cities</a>
                    </li>
                    <li>
                      <a href="#">Districs</a>
                    </li>
                    <li>
                      <a href="#">Airports</a>
                    </li>
                    <li>
                      <a href="#">Hotels</a>
                    </li>
                    <li>
                      <a href="#">Places of Interest</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4">
                <div class="theme-footer-section theme-footer-">
                  <h5 class="theme-footer-section-title">Book</h5>
                  <ul class="theme-footer-section-list">
                    <li>
                      <a href="#">Apartments</a>
                    </li>
                    <li>
                      <a href="#">Resorts</a>
                    </li>
                    <li>
                      <a href="#">Villas</a>
                    </li>
                    <li>
                      <a href="#">Hostels</a>
                    </li>
                    <li>
                      <a href="#">B&Bs</a>
                    </li>
                    <li>
                      <a href="#">Guesthouses</a>
                    </li>
                    <li>
                      <a href="#">Hotel Chains</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="theme-footer-section theme-footer-section-subscribe bg-grad _mt-mob-30">
              <div class="theme-footer-section-subscribe-bg" style="background-image:url(img/footer/footer_subscribe_bg.png);"></div>
              <div class="theme-footer-section-subscribe-content">
                <h5 class="theme-footer-section-title">Save up to 50% off your next trip</h5>
                <p class="text-muted">Subscribe to unlock our secret deals</p>
                <form>
                  <div class="form-group">
                    <input class="form-control theme-footer-subscribe-form-control" type="email" placeholder="Type your e-mail here"/>
                  </div>
                  <button class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" type="submit">Get deals</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-copyright">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p class="theme-copyright-text">Copyright &copy; 2018
              <a href="#">Bookify</a>. All rights reserved.
            </p>
          </div>
          <div class="col-md-6">
            <ul class="theme-copyright-social">
              <li>
                <a class="fa fa-facebook" href="#"></a>
              </li>
              <li>
                <a class="fa fa-google" href="#"></a>
              </li>
              <li>
                <a class="fa fa-twitter" href="#"></a>
              </li>
              <li>
                <a class="fa fa-youtube-play" href="#"></a>
              </li>
              <li>
                <a class="fa fa-instagram" href="#"></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
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
    <script src="../js/fix-properties.js"></script>
  </body>
</html>