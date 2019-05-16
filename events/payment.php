<?php
    
    require_once('../database.php');
    
    // GET: URL request
    $event_id = isset($_GET['id']) ? mysqli_real_escape_string($database,$_GET['id']) : 0;
    $firstname = isset($_GET['firstname']) ? mysqli_real_escape_string($database,$_GET['firstname']) : 0;
    $lastname = isset($_GET['lastname']) ? mysqli_real_escape_string($database,$_GET['lastname']) : 0;
    $email = isset($_GET['email']) ? mysqli_real_escape_string($database,$_GET['email']) : 0;
    $phone = isset($_GET['email']) ? mysqli_real_escape_string($database,$_GET['phone']) : 0;
    
    $sql = "SELECT * FROM `event` WHERE `event_id` = '$event_id'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);

    if($num > 0){
      $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $result['address'] = $result['full_address'];
      $result['pictures'] = json_decode($result['pictures'],true);
      $result['category'] = json_decode($result['category'],true);
    }else{
      $result = array();
    }
    

    // Admin
    /*
    $sql = "SELECT `fee` FROM `admin` WHERE `title` = 'moneymatters' AND `page` = 'event' AND `access` = 'system'";
		$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $admin = array();
    if($num > 0){
      $admin = mysqli_fetch_array($query,MYSQLI_ASSOC);
      //$admin['price'] = json_decode($result['price'],true);
    }
    */

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Event / Booking</title>
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
      $options = array('page' => 'events', 'subpage' => 'payment');
      require_once('../header.php');
    ?>










    
    <div class="theme-page-section theme-page-section-lg">
      <div class="container">
        <div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">
          <div class="col-md-8 ">
            <div class="theme-payment-page-sections">
            <div class="theme-payment-page-sections-item">
                <div class="theme-search-results-item theme-payment-page-item-thumb">
                  <div class="row" data-gutter="20">
                    <div class="col-md-9 ">
                      <p class="theme-search-results-item-category">
                        <?php
                          for($i = 0; $i < count($result['category']); $i++){
                            $append = ($i == count($result['category']) - 1) ? '' : ',';
                            echo ' '.$result['category'][$i].$append;
                          }
                        ?>
                      </p>
                      <h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo (isset($result['title'])) ? $result['title'] : ''; ?></h5>
                      <p class="theme-search-results-item-time">
                        <i class="fa fa-calendar"></i>
                        <?php echo (isset($result['time'])) ? date("F jS, Y", strtotime($result['time'])) : ''; ?>
                      </p>
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
                        <input class="form-control" type="text" id="firstname" value="<?php echo (isset($firstname) && !empty($firstname)) ? $firstname : '';?>" placeholder="First Name"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="lastname" value="<?php echo (isset($lastname) && !empty($lastname)) ? $lastname : '';?>" placeholder="Last Name"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="email" value="<?php echo (isset($email) && !empty($email)) ? $email : '';?>" placeholder="Email Address"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="phone" value="<?php echo (isset($phone) && !empty($phone)) ? $phone : '';?>" placeholder="Phone Number"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="collapse theme-payment-page-sections-item-new-extend" id="AddNewTraveler">
                  
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
                    <h3 class="theme-payment-page-booking-title">Total price for this booking</h3>
                    <p class="theme-payment-page-booking-subtitle">By clicking book now button you agree with terms and conditionals and money back gurantee. Thank you for trusting our service.</p>
                    <p class="theme-payment-page-booking-price"><?php echo (isset($result['price'])) ? '<span class="currency-symbol">₦</span><span class="currency-value" data-value="'.$result['price'].'">'.$result['price'].'</span>' : '$0'; ?></p>
                  </div>
                  <a class="btn _tt-uc btn-primary-inverse btn-lg btn-block" id="book-now" href="order.php" style="background:#ee4a35; box-shadow: 0 2px 30px rgba(255,76,0,0.39);">Book Now</a>
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
                      <h5 class="theme-sidebar-section-charges-item-title">Fee per attendee</h5>
                      <p class="theme-sidebar-section-charges-item-subtitle"></p>
                      <p class="theme-sidebar-section-charges-item-price"><?php echo (isset($result['price'])) ? '<span class="currency-symbol">₦</span><span class="currency-value" data-value="'.$result['price'].'">'.$result['price'].'</span>' : '$0'; ?></p>
                    </li>
                  </ul>
                  <p class="theme-sidebar-section-charges-total">Total
                    <span><?php echo (isset($result['price'])) ? '<span class="currency-symbol">₦</span><span class="currency-value" data-value="'.$result['price'].'">'.$result['price'].'</span>' : '$0'; ?></span>
                  </p>
                </div>
              </div>
              <div class="theme-sidebar-section _mb-10">
                <ul class="theme-sidebar-section-features-list">
                  <li>
                    <h5 class="theme-sidebar-section-features-list-title">Manage your bookings!</h5>
                    <p class="theme-sidebar-section-features-list-body">You're in control of your booking - no registration required.</p>
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
    <script src="../js/fix-properties.js"></script>
  </body>
</html>