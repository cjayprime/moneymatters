<?php
    
    require_once('../database.php');
        
    // Trending Apartments
    $sql = "SELECT * FROM `user` WHERE `user_id` = '$user_id' LIMIT 1";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $results = array();
    if($num > 0){
      $results = mysqli_fetch_array($query,MYSQLI_ASSOC);

    }

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>User / Profile</title>
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
      $options = array('page' => 'user', 'subpage' => 'account');
      require_once('../header.php');
    ?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <div class="theme-page-section theme-page-section-gray theme-page-section-lg">
      <div class="container">
        <div class="row">
          <div class="col-md-2-5 ">
            <div class="theme-account-sidebar">
              <div class="theme-account-avatar">
                <img class="theme-account-avatar-img" style="border-radius:0" src="<?php echo isset($results['profile_picture']) ? $results['profile_picture'] : '' ?>" alt="Profile picture"/>
                <p class="theme-account-avatar-name">Welcome,
                  <br/>
                  <?php echo isset($results['first_name']) && isset($results['last_name']) ? $results['first_name'].' '.$results['last_name'] : '' ?>
                </p>
              </div>
              <nav class="theme-account-nav">
                <ul class="theme-account-nav-list">
                  <li class="active">
                    <a href="account.php">
                      <i class="fa fa-male"></i>Profile
                    </a>
                  </li>
                  <li>
                    <a href="notifications.php">
                      <i class="fa fa-bell"></i>Notifications
                    </a>
                  </li>
                  <li>
                    <a href="history.php">
                      <i class="fa fa-history"></i>History
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="col-md-9-5 ">
            <h1 class="theme-account-page-title">Profile</h1>
            <div class="row">
              <div class="col-md-9 ">
                <div class="theme-account-preferences">
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Profile Picture</h5>
                      </div>
                      <div class="col-md-7 ">
                        <p class="theme-account-preferences-item-value"></p>
                        <div class="collapse" id="ChangeProfilePicture">
                          <div class="theme-account-preferences-item-change">
                            <p class="theme-account-preferences-item-change-description">Change your profile picture</p>
                            <div class="form-group theme-account-preferences-item-change-form">
                              <input id="profilepicture" class="form-control" type="file" value="........"/>
                            </div>
                            <div class="theme-account-preferences-item-change-actions">
                              <div class="btn btn-sm btn-primary save" href="#">Save changes</div>
                              <a class="btn btn-sm btn-default" href="#ChangeProfilePicture" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeProfilePicture">Cancel</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <a class="theme-account-preferences-item-change-link" href="#ChangeProfilePicture" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeProfilePicture">
                          <i class="fa fa-pencil"></i>edit
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">First name</h5>
                      </div>
                      <div class="col-md-7 ">
                        <p class="theme-account-preferences-item-value"><?php echo isset($results['first_name']) ? $results['first_name'] : '' ?></p>
                        <div class="collapse" id="ChangeFirstName">
                          <div class="theme-account-preferences-item-change">
                            <p class="theme-account-preferences-item-change-description">Change your first name</p>
                            <div class="form-group theme-account-preferences-item-change-form">
                              <input id="firstname" class="form-control" type="text" value="<?php echo isset($results['first_name']) ? $results['first_name'] : '' ?>"/>
                            </div>
                            <div class="theme-account-preferences-item-change-actions">
                              <div class="btn btn-sm btn-primary save" href="#">Save changes</div>
                              <a class="btn btn-sm btn-default" href="#ChangeFirstName" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeFirstName">Cancel</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <a class="theme-account-preferences-item-change-link" href="#ChangeFirstName" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeFirstName">
                          <i class="fa fa-pencil"></i>edit
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Last name</h5>
                      </div>
                      <div class="col-md-7 ">
                        <p class="theme-account-preferences-item-value"><?php echo isset($results['last_name']) ? $results['last_name'] : '' ?></p>
                        <div class="collapse" id="ChangeLastName">
                          <div class="theme-account-preferences-item-change">
                            <p class="theme-account-preferences-item-change-description">Change your last name</p>
                            <div class="form-group theme-account-preferences-item-change-form">
                              <input id="lastname" class="form-control" type="text" value="<?php echo isset($results['last_name']) ? $results['last_name'] : '' ?>"/>
                            </div>
                            <div class="theme-account-preferences-item-change-actions">
                              <div class="btn btn-sm btn-primary save" href="#">Save changes</div>
                              <a class="btn btn-sm btn-default" href="#ChangeLastName" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeLastName">Cancel</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <a class="theme-account-preferences-item-change-link" href="#ChangeLastName" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeLastName">
                          <i class="fa fa-pencil"></i>edit
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Other names</h5>
                      </div>
                      <div class="col-md-7 ">
                        <p class="theme-account-preferences-item-value"><?php echo isset($results['other_names']) ? $results['other_names'] : '' ?></p>
                        <div class="collapse" id="ChangeOtherNames">
                          <div class="theme-account-preferences-item-change">
                            <p class="theme-account-preferences-item-change-description">Change your other names</p>
                            <div class="form-group theme-account-preferences-item-change-form">
                              <input id="othernames" class="form-control" type="text" value="<?php echo isset($results['other_names']) ? $results['other_names'] : '' ?>"/>
                            </div>
                            <div class="theme-account-preferences-item-change-actions">
                              <div class="btn btn-sm btn-primary save" href="#">Save changes</div>
                              <a class="btn btn-sm btn-default" href="#ChangeOtherNames" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeOtherNames">Cancel</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <a class="theme-account-preferences-item-change-link" href="#ChangeOtherNames" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeOtherNames">
                          <i class="fa fa-pencil"></i>edit
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Email Address</h5>
                      </div>
                      <div class="col-md-7 ">
                        <p class="theme-account-preferences-item-value"><?php echo isset($results['email']) ? $results['email'] : '' ?></p>
                        <div class="collapse" id="ChangeEmailAddress">
                          <div class="theme-account-preferences-item-change">
                            <p class="theme-account-preferences-item-change-description">Change your email address</p>
                            <div class="form-group theme-account-preferences-item-change-form">
                              <input id="email" class="form-control" type="text" value="<?php echo isset($results['email']) ? $results['email'] : '' ?>"/>
                            </div>
                            <div class="theme-account-preferences-item-change-actions">
                              <div class="btn btn-sm btn-primary save" href="#">Save changes</div>
                              <a class="btn btn-sm btn-default" href="#ChangeEmailAddress" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeEmailAddress">Cancel</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <a class="theme-account-preferences-item-change-link" href="#ChangeEmailAddress" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeEmailAddress">
                          <i class="fa fa-pencil"></i>edit
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Password</h5>
                      </div>
                      <div class="col-md-7 ">
                        <p class="theme-account-preferences-item-value">..............</p>
                        <div class="collapse" id="ChangePassword">
                          <div class="theme-account-preferences-item-change">
                            <p class="theme-account-preferences-item-change-description">Change your password</p>
                            <div class="form-group theme-account-preferences-item-change-form">
                              <input id="repeat-password" class="form-control" type="password" value="........"/>
                            </div>
                            <div class="form-group theme-account-preferences-item-change-form">
                              <input id="password" class="form-control" type="password" value="........"/>
                            </div>
                            <div class="theme-account-preferences-item-change-actions">
                              <div class="btn btn-sm btn-primary save" href="#">Save changes</div>
                              <a class="btn btn-sm btn-default" href="#ChangePassword" data-toggle="collapse" aria-expanded="false" aria-controls="ChangePassword">Cancel</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <a class="theme-account-preferences-item-change-link" href="#ChangePassword" data-toggle="collapse" aria-expanded="false" aria-controls="ChangePassword">
                          <i class="fa fa-pencil"></i>edit
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Phone Number</h5>
                      </div>
                      <div class="col-md-7 ">
                        <p class="theme-account-preferences-item-value"><?php echo isset($results['phone']) ? $results['phone'] : '' ?></p>
                        <div class="collapse" id="ChangePhone">
                          <div class="theme-account-preferences-item-change">
                            <p class="theme-account-preferences-item-change-description">Change your phone number</p>
                            <div class="form-group theme-account-preferences-item-change-form">
                              <input id="phone" class="form-control" type="text" value="<?php echo isset($results['phone']) ? $results['phone'] : '' ?>"/>
                            </div>
                            <div class="theme-account-preferences-item-change-actions">
                              <div class="btn btn-sm btn-primary save" href="#">Save changes</div>
                              <a class="btn btn-sm btn-default" href="#ChangePhone" data-toggle="collapse" aria-expanded="false" aria-controls="ChangePhone">Cancel</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <a class="theme-account-preferences-item-change-link" href="#ChangePhone" data-toggle="collapse" aria-expanded="false" aria-controls="ChangePhone">
                          <i class="fa fa-pencil"></i>edit
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Default Currency</h5>
                      </div>
                      <div class="col-md-7 ">
                        <p class="theme-account-preferences-item-value"><?php echo isset($results['currency']) ? $results['currency'] : '' ?></p>
                        <div class="collapse" id="ChangeCurrency">
                          <div class="theme-account-preferences-item-change">
                            <p class="theme-account-preferences-item-change-description">Change your default</p>
                            <div class="form-group theme-account-preferences-item-change-form">
                              <input id="currency" class="form-control" type="text" value="<?php echo isset($results['currency']) ? $results['currency'] : '' ?>"/>
                            </div>
                            <div class="theme-account-preferences-item-change-actions">
                              <div class="btn btn-sm btn-primary save" href="#">Save changes</div>
                              <a class="btn btn-sm btn-default" href="#ChangeCurrency" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeCurrency">Cancel</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <a class="theme-account-preferences-item-change-link" href="#ChangeCurrency" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeCurrency">
                          <i class="fa fa-pencil"></i>edit
                        </a>
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
    <script src="../js/fix-user.js"></script>
  </body>
</html>