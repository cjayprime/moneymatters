<?php

    require_once('../../database.php');

    $sql = "SELECT * FROM `admin`";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);

    $result = array();
    if($num > 0){
        while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
          $result[$rows['page']] = array();
          $result[$rows['page']]['currency'] = json_decode($rows['currency'],true);
          $result[$rows['page']]['category'] = json_decode($rows['category'],true);
          $result[$rows['page']]['type'] = json_decode($rows['type'],true);
          $result[$rows['page']]['amenities'] = json_decode($rows['amenities'],true);
          $result[$rows['page']]['facilities'] = json_decode($rows['facilities'],true);
          $result[$rows['page']]['rating'] = json_decode($rows['rating'],true);
        }
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

    <title>Moneymatters Admin</title>

    <!-- vendor css -->
    <link href="../../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../../lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="../../lib/morris.js/morris.css" rel="stylesheet">
    <link href="../../lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="../../lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="../../lib/jqvmap/jqvmap.min.css" rel="stylesheet">
    <link href="../../lib/pickerjs/picker.min.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../../css/azia.css">

  </head>
  <body class="az-body az-body-sidebar">

    

    
    <?php
      $options = array('page' => 'settings','subpage'=>'');
      require_once('../sidebar.php');
    ?>




    <div class="az-content az-content-dashboard-two">

    

    
    <?php
      require_once('../header.php');
    ?>




    <div class="az-content-header d-block d-md-flex">
        <div>
          <h2 class="az-content-title tx-24 mg-b-5 mg-b-lg-8">Settings</h2>
          <p class="mg-b-0">Use this page to change possible user options on the front page.</p>
        </div>
      </div><!-- az-content-header -->
      <div class="az-content-body">
        









































<div id="successmodal" class="modal show" style="padding-right: 17px; display: hidden;">
    <span id="opensuccess" data-toggle="modal" data-target="#successmodal"></span>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <i class="icon ion-ios-checkmark-circle-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
            <h4 class="tx-success mg-b-20" id="success-header"></h4>
            <p class="mg-b-20 mg-x-20" id="success-body"></p>
            <button type="button" class="btn btn-success pd-x-25" data-dismiss="modal" aria-label="Close">Continue</button>
            </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div>




<div id="errormodal" class="modal show" style="padding-right: 17px; display: hidden;">
    <span id="openerror" data-toggle="modal" data-target="#errormodal"></span>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
            <h4 class="tx-danger mg-b-20" id="error-header"></h4>
            <p class="mg-b-20 mg-x-20" id="error-body"></p>
            <button type="button" class="btn btn-danger pd-x-25" data-dismiss="modal" aria-label="Close">Continue</button>
            </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div>




<div id="previewmodal" class="modal" style="display:none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h6 class="modal-title">Preview</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body" style="min-height:25vh;">
            <span>No images selected</span>
            <div style="width:100%;"></div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-indigo" data-id="0" data-dismiss="modal">Ok</button>
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div>
































<div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
  




  
  <div class="card">
    <div class="card-header" role="tab" id="headingZero">
      <a data-toggle="collapse" href="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
        General
      </a>
    </div><!-- card-header -->

    <div id="collapseZero" data-parent="#accordion" class="collapse" role="tabpanel" aria-labelledby="headingZero">
      <div class="card-body">
        

        <div class="wizard settings">
            <h3>Currency</h3>
            <section>
                <div class="row row-sm mg-t-40">
                  <div class="col-md-6">
                      <label class="form-control-label">Enter a new currency: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-flag-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input style="width:55%;" class="settings-new-option form-control" placeholder="Enter a new currency" type="text" required>
                          <input style="width:5%;background-color:#5b47fb;color:#FFF;" class="settings-add-option form-control" value="Add" type="button" required>
                      </div>
                  </div><!-- col -->
                  <div class="col-md-6">
                    <label class="form-control-label">Add or remove the option types for currency</label>
                    <ul class="list-group" data-optionclass="currency">
                      
                      
                      <?php
                          foreach($result['settings']['currency'] as $key => $value){
                              echo <<<EOT
                              <li class="list-group-item d-flex align-items-center">
                                <img src="../../img/cancel.svg" style="cursor:pointer;" class="settings-remove-option wd-20 rounded-circle mg-r-15" alt="">
                                <div>
                                  <h6 class="settings-select-option tx-13 tx-inverse tx-semibold mg-b-0">{$key}</h6>
                                  <div class="input-group">
                                    <input style="width:50%;height:30px;" placeholder="What is the rate to USD?" class="settings-entry-option tx-11 form-control" value="{$value}" type="text" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-chart-area-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
EOT;
                          }
                      ?>



                    </ul>
                  </div><!-- col -->
            </section>
        </div>


      </div>
    </div><div class="card-header" role="tab" id="headingZero">
      <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Admin
      </a>
    </div><!-- card-header -->

    <div id="collapseOne" data-parent="#accordion" class="collapse show" role="tabpanel" aria-labelledby="headingZero">
      <div class="card-body">
        

        <div class="wizard settings">
            <h3>Add a new admin</h3>
            <section>
                <div class="row row-sm mg-t-40">
                  <div class="col-md-6">
                      <label class="form-control-label">Enter the admin's email: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-flag-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input style="width:55%;" class="settings-new-option form-control" placeholder="Enter the admin's email" id="admin-email" type="text" required>
                      </div>
                  </div><!-- col -->
                  <div class="col-md-6">
                      <label class="form-control-label">Enter the admin's password: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-flag-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input style="width:55%;" class="settings-new-option form-control" placeholder="Enter the admin's password" id="admin-password" type="text" required>
                      </div>
                  </div><!-- col -->
            </section>
        </div>


      </div>
    </div>
  </div>




<?php
/*
  
  <div class="card">
    <div class="card-header" role="tab" id="headingOne">
      <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Finance
      </a>
    </div><!-- card-header -->

    <div id="collapseOne" data-parent="#accordion" class="collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="card-body">
        

        <div class="wizard finance">
            <h3>Type</h3>
            <section>
                <div class="row row-sm mg-t-40">
                  <div class="col-md-6">
                      <label class="form-control-label">Enter a new option: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-flag-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input style="width:55%;" class="settings-new-option form-control" placeholder="Enter a new option for finance products" type="text" required>
                          <input style="width:5%;background-color:#5b47fb;color:#FFF;" class="settings-add-option form-control" value="Add" type="button" required>
                      </div>
                  </div><!-- col -->
                  <div class="col-md-6">
                    <label class="form-control-label">Add or remove the option types for finance</label>
                    <ul class="list-group" data-optionclass="type">
                      
                      
                      <?php
                          for($i = 0; $i < count($result['finance']['type']); $i++){
                              echo <<<EOT
                              <li class="list-group-item d-flex align-items-center">
                                <img src="../../img/cancel.svg" style="cursor:pointer;" class="settings-remove-option wd-20 rounded-circle mg-r-15" alt="">
                                <div>
                                  <h6 class="settings-select-option tx-13 tx-inverse tx-semibold mg-b-0">{$result['finance']['type'][$i]}</h6>
                                </div>
                              </li>
EOT;
                          }
                      ?>



                    </ul>
                  </div><!-- col -->
            </section>
        </div>


      </div>
    </div>
  </div>








<div class="card">
  <div class="card-header" role="tab" id="headingTwo">
    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      Insurance
    </a>
  </div>
  <div id="collapseTwo" class="collapse" data-parent="#accordion" role="tabpanel" aria-labelledby="headingTwo">
    <div class="card-body">
      

      <div class="wizard insurance">
          <h3>Category</h3>
          <section>
              <div class="row row-sm mg-t-40">
                <div class="col-md-6">
                    <label class="form-control-label">Enter a new option: <span class="tx-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="typcn typcn-flag-outline tx-24 lh--9 op-6"></i>
                            </div>
                        </div>
                        <input style="width:55%;" class="settings-new-option form-control" placeholder="Enter a new option for insurance products" type="text" required>
                        <input style="width:5%;background-color:#5b47fb;color:#FFF;" class="settings-add-option form-control" value="Add" type="button" required>
                    </div>
                </div><!-- col -->
                <div class="col-md-6">
                  <label class="form-control-label">Add or remove the options of categories in insurance</label>
                  <ul class="list-group" data-optionclass="category">
                    
                    
                    <?php
                        for($i = 0; $i < count($result['insurance']['category']); $i++){
                            echo <<<EOT
                            <li class="list-group-item d-flex align-items-center">
                              <img src="../../img/cancel.svg" style="cursor:pointer;" class="settings-remove-option wd-20 rounded-circle mg-r-15" alt="">
                              <div>
                                <h6 class="settings-select-option tx-13 tx-inverse tx-semibold mg-b-0">{$result['insurance']['category'][$i]}</h6>
                              </div>
                            </li>
EOT;
                        }
                    ?>



                  </ul>
                </div><!-- col -->
          </section>
      </div>


    </div>
  </div>
</div>








<div class="card">
  <div class="card-header" role="tab" id="headingThree">
    <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      Wedding
    </a>
  </div>
  <div id="collapseThree" class="collapse" data-parent="#accordion" role="tabpanel" aria-labelledby="headingThree">
    <div class="card-body">
      

      <div class="wizard wedding">
          <h3>Category</h3>
          <section>
              <div class="row row-sm mg-t-40">
                <div class="col-md-6">
                    <label class="form-control-label">Enter a new option: <span class="tx-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="typcn typcn-flag-outline tx-24 lh--9 op-6"></i>
                            </div>
                        </div>
                        <input style="width:55%;" class="settings-new-option form-control" placeholder="Enter a new option for insurance products" type="text" required>
                        <input style="width:5%;background-color:#5b47fb;color:#FFF;" class="settings-add-option form-control" value="Add" type="button" required>
                    </div>
                </div><!-- col -->
                <div class="col-md-6">
                  <label class="form-control-label">Add or remove the options of categories in insurance</label>
                  <ul class="list-group" data-optionclass="category">
                    
                    
                    <?php
                        for($i = 0; $i < count($result['wedding']['category']); $i++){
                            echo <<<EOT
                            <li class="list-group-item d-flex align-items-center">
                              <img src="../../img/cancel.svg" style="cursor:pointer;" class="settings-remove-option wd-20 rounded-circle mg-r-15" alt="">
                              <div>
                                <h6 class="settings-select-option tx-13 tx-inverse tx-semibold mg-b-0">{$result['wedding']['category'][$i]}</h6>
                              </div>
                            </li>
EOT;
                        }
                    ?>



                  </ul>
                </div><!-- col -->
          </section>
      </div>


    </div>
  </div>
</div>


  <div class="card">
    <div class="card-header" role="tab" id="headingFour">
      <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        Events
      </a>
    </div>
    <div id="collapseFour" class="collapse" data-parent="#accordion" role="tabpanel" aria-labelledby="headingFour">
      <div class="card-body">
      

        <div class="wizard event">
            <h3>Category</h3>
            <section>
                <div class="row row-sm mg-t-40">
                  <div class="col-md-6">
                      <label class="form-control-label">Enter a new option: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-flag-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input style="width:55%;" class="settings-new-option form-control" placeholder="Enter a new option for events" type="text" required>
                          <input style="width:5%;background-color:#5b47fb;color:#FFF;" class="settings-add-option form-control" value="Add" type="button" required>
                      </div>
                  </div><!-- col -->
                  <div class="col-md-6">
                    <label class="form-control-label">Add or remove the options of categories in insurance</label>
                    <ul class="list-group" data-optionclass="category">
                      
                      
                      <?php
                          for($i = 0; $i < count($result['event']['category']); $i++){
                              echo <<<EOT
                              <li class="list-group-item d-flex align-items-center">
                                <img src="../../img/cancel.svg" style="cursor:pointer;" class="settings-remove-option wd-20 rounded-circle mg-r-15" alt="">
                                <div>
                                  <h6 class="settings-select-option tx-13 tx-inverse tx-semibold mg-b-0">{$result['event']['category'][$i]}</h6>
                                </div>
                              </li>
EOT;
                          }
                      ?>



                    </ul>
                  </div><!-- col -->
            </section>
        </div>


      </div>
    </div><!-- collapse -->
  </div><!-- card -->






  <div class="card">
    <div class="card-header" role="tab" id="headingFive">
      <a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
        Offers
      </a>
    </div>
    <div id="collapseFive" class="collapse" data-parent="#accordion" role="tabpanel" aria-labelledby="headingFive">
      <div class="card-body">
        Offers
      </div>
    </div><!-- collapse -->
  </div><!-- card -->




  <div class="card">
    <div class="card-header" role="tab" id="headingSix">
      <a class="collapsed" data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
        Property
      </a>
    </div>
    <div id="collapseSix" class="collapse" data-parent="#accordion" role="tabpanel" aria-labelledby="headingSix">
      <div class="card-body">
        

        <div class="wizard property">
            <h3>Type</h3>
            <section>
                <div class="row row-sm mg-t-40">
                  <div class="col-md-6">
                      <label class="form-control-label">Enter a new option: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-flag-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input style="width:55%;" class="settings-new-option form-control" placeholder="Enter a new option for types of properties" type="text" required>
                          <input style="width:5%;background-color:#5b47fb;color:#FFF;" class=" settings-add-option form-control" value="Add" type="button" required>
                      </div>
                  </div><!-- col -->
                  <div class="col-md-6">
                    <label class="form-control-label">Add or remove options for types of properties</label>
                    <ul class="list-group" data-optionclass="type">
                      
                      
                      <?php
                          for($i = 0; $i < count($result['property']['type']); $i++){
                              echo <<<EOT
                              <li class="list-group-item d-flex align-items-center">
                                <img src="../../img/cancel.svg" style="cursor:pointer;" class="settings-remove-option wd-20 rounded-circle mg-r-15" alt="">
                                <div>
                                  <h6 class="settings-select-option tx-13 tx-inverse tx-semibold mg-b-0">{$result['property']['type'][$i]}</h6>
                                </div>
                              </li>
EOT;
                          }
                      ?>



                    </ul>
                  </div><!-- col -->
            </section>
            <h3>Amenities</h3>
            <section>
                <div class="row row-sm mg-t-40">
                  <div class="col-md-6">
                      <label class="form-control-label">Enter a new option: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-flag-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input style="width:55%;" class="settings-new-option form-control" placeholder="Enter a new option for the amenities of properties" type="text" required>
                          <input style="width:5%;background-color:#5b47fb;color:#FFF;" class="settings-add-option form-control" value="Add" type="button" required>
                      </div>
                  </div><!-- col -->
                  <div class="col-md-6">
                    <label class="form-control-label">Add or remove the amenities options for properties</label>
                    <ul class="list-group" data-optionclass="amenities">
                      
                      
                      <?php
                          for($i = 0; $i < count($result['property']['amenities']); $i++){
                              echo <<<EOT
                              <li class="list-group-item d-flex align-items-center">
                                <img src="../../img/cancel.svg" style="cursor:pointer;" class="settings-remove-option wd-20 rounded-circle mg-r-15" alt="">
                                <div>
                                  <h6 class="settings-select-option tx-13 tx-inverse tx-semibold mg-b-0">{$result['property']['amenities'][$i]}</h6>
                                </div>
                              </li>
EOT;
                          }
                      ?>



                    </ul>
                  </div><!-- col -->
            </section>
            <h3>Facilities</h3>
            <section>
                <div class="row row-sm mg-t-40">
                  <div class="col-md-6">
                      <label class="form-control-label">Enter a new option: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-flag-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input style="width:55%;" class="settings-new-option form-control" placeholder="Enter a new option for the facilities of properties" type="text" required>
                          <input style="width:5%;background-color:#5b47fb;color:#FFF;" class="settings-add-option form-control" value="Add" type="button" required>
                      </div>
                  </div><!-- col -->
                  <div class="col-md-6">
                    <label class="form-control-label">Add or remove the facilities options for properties</label>
                    <ul class="list-group" data-optionclass="facilities">
                      
                      
                      <?php
                          for($i = 0; $i < count($result['property']['facilities']); $i++){
                              echo <<<EOT
                              <li class="list-group-item d-flex align-items-center">
                                <img src="../../img/cancel.svg" style="cursor:pointer;" class="settings-remove-option wd-20 rounded-circle mg-r-15" alt="">
                                <div>
                                  <h6 class="settings-select-option tx-13 tx-inverse tx-semibold mg-b-0">{$result['property']['facilities'][$i]}</h6>
                                </div>
                              </li>
EOT;
                          }
                      ?>



                    </ul>
                  </div><!-- col -->
            </section>
        </div>


      </div>
    </div><!-- collapse -->
  </div><!-- card -->
*/
  ?>

</div>



















































      </div><!-- az-content-body -->
      <div class="az-footer ht-40">
        <div class="container-fluid pd-t-0-f ht-100p">
          <span>&copy; 2019 Moneymatters Admin Page</span>
          <span>Designed by: GreyLoft</span>
        </div><!-- container -->
      </div><!-- az-footer -->
    </div><!-- az-content -->


    <script src="../../lib/jquery/jquery.min.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../lib/ionicons/ionicons.js"></script>
    <script src="../../lib/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../../lib/raphael/raphael.min.js"></script>
    <script src="../../lib/morris.js/morris.min.js"></script>
    <script src="../../lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="../../lib/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="../../lib/jquery-steps/jquery.steps.min.js"></script>
    <script src="../../lib/parsleyjs/parsley.min.js"></script>
    <script src="../../lib/select2/js/select2.min.js"></script>
    <script src="../../lib/pickerjs/picker.min.js"></script>
    <script>
      $(function(){
        'use strict'
        
        $('.az-toggle').on('click', function(){
          $(this).toggleClass('on');
        });

        $('.az-sidebar .with-sub').on('click', function(e){
          e.preventDefault();
          $(this).parent().toggleClass('show');
          $(this).parent().siblings().removeClass('show');
        });

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
        });

        /* ----------------------------------- */
        // Added by GreyLoft
        var SelectedFiles = [];
        $(document).ready(function() {
            window.MoneyMatters = {
                saveAdmin: function(data){
                  var post = {
                    command: 'create-admin',
                    id: 'add',
                    data:{email: data.email, password: data.password}
                  };
                    
                  $.ajax({url: 'action.php',data: post,
                      method:'POST',
                      dataType:"json",
                      success:function(res,status,xhr){
                        console.log(res);
                        if(res.success)
                        MoneyMatters.success(res.message,'You have successfully added a new admin.');
                        else
                        MoneyMatters.error(res.message,'An error occurred, check the form and try again.');
                      },
                      error:function(res,status,xhr){
                        console.log(res.responseText);
                        MoneyMatters.error(res.responseText,'A fatal error occurred, try again, if the error persists, contact support.');
                      },
                      //contentType: false,
                      //processData: false
                  });

                },
                saveGeneral: function(id){
                    var post = {
                      command: 'edit',
                      id: id,
                      data:{}
                    };
                    //id can only be ['settings','finance','insurance','wedding','event','offer','property']
                    $('.'+id).find('.list-group').each(function(){
                      var optionclass = $(this).data('optionclass');
                      if(optionclass == 'currency')post['data'][optionclass] = {};
                      else post['data'][optionclass] = [];
                      $(this).find('.settings-select-option').each(function(){
                        var txt = $(this).text();
                        if(optionclass == 'currency'){
                          var value = $(this).next('.input-group').find('input').val();
                          post['data'][optionclass][txt] = value;
                        }else post['data'][optionclass].push(txt);
                      });
                    });
                    
                    $.ajax({url: 'action.php',data: post,
                        method:'POST',
                        dataType:"json",
                        success:function(res,status,xhr){
                          console.log(res);
                          if(res.success)
                          MoneyMatters.success(res.message,'You have successfully added a new event.');
                          else
                          MoneyMatters.error(res.message,'An error occurred, check the form and try again.');
                        },
                        error:function(res,status,xhr){
                          console.log(res.responseText);
                          MoneyMatters.error(res.responseText,'A fatal error occurred, try again, if the error persists, contact support.');
                        },
                        //contentType: false,
                        //processData: false
                    });
                },
                error: function(header,body){
                    $('#error-header').html(header);
                    $('#error-body').html(body);
                    $('#openerror').click();
                },
                success: function(header,body){
                    $('#success-header').html(header);
                    $('#success-body').html(body);
                    $('#opensuccess').click();
                }
            };

            $('.wizard').each(function(){
              var self = $(this);
              self.steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                autoFocus: true,
                titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                onStepChanging: function (event, currentIndex, newIndex) {
                    return true;
                },
                onFinishing: function(event, currentIndex){
                  if($(this).find('#admin-email').length){
                    var email = $(this).find('#admin-email').val();
                    var password = $(this).find('#admin-password').val();
                    if(email && password){
                      $(this).find('#admin-email,#admin-password').css({border: '1px solid #cdd4e0'});
                      MoneyMatters.saveAdmin({email: email, password: password});
                    }else{
                      if(!email)$(this).find('#admin-email').css({border: '1px solid #dc3545'});
                      if(!password)$(this).find('#admin-password').css({border: '1px solid #dc3545'});
                    }
                  }else{
                    var classes = ['settings','finance','insurance','wedding','event','offer','property']
                    var empty = false;
                    for(var i = 0; i < classes.length; i++){
                      self.find('.settings-entry-option').each(function(){
                        //No input must ever be empty
                        if(!isNaN(parseFloat($(this).val())) && isFinite($(this).val())){
                          $(this).css({border: '1px solid #cdd4e0'});
                        }else{
                          $(this).css({border: '1px solid #dc3545'});
                          empty = true;
                        }
                      });
                      if(empty == false && self.hasClass(classes[i]))
                      MoneyMatters.saveGeneral(classes[i]);
                    }
                  }
                },
                onStepChanged: function(){} 
              });
            });

            //$(document).on('keyup','textarea,input[type=text]',function(){
            $('textarea,input[type=text]').keyup(function(){
                if($(this).val().length > 0)
                $(this).css({border:'1px solid #cdd4e0'});
            });

            $(document).on('keyup','input[type=number]',function(){
                if(/^[0-9]+$/.test($(this).val()))
                $(this).css({border:'1px solid #cdd4e0'});
                else
                $(this).css({border:'1px solid #dc3545'});
            })
            
            $(document).on('change','input[type=number]',function(){
                if(/^[0-9]+$/.test($(this).val()))
                $(this).css({border:'1px solid #cdd4e0'});
                else
                $(this).css({border:'1px solid #dc3545'});
            });


            //Add options
            $(document).on('click','.settings-add-option',function(){
              var parent = $(this).parents('.wizard');
              var index = parent.find('.settings-add-option').index($(this));
              
              if(parent.find('.settings-new-option').eq(index).val()){
                parent.find('.settings-new-option').eq(index).css({border: '1px solid #cdd4e0'})
                if($(this).parents('.row').find('.list-group').data('optionclass') == 'currency'){
                  var txt = '<li class="list-group-item d-flex align-items-center">\
                    <img src="../../img/cancel.svg" style="cursor:pointer;" class="settings-remove-option wd-20 rounded-circle mg-r-15" alt="">\
                    <div>\
                      <h6 class="settings-select-option tx-13 tx-inverse tx-semibold mg-b-0">'+parent.find('.settings-new-option').eq(index).val()+'</h6>\
                      <div class="input-group">\
                        <input style="width:50%;height:30px;" placeholder="What is the rate to USD?" class="settings-entry-option tx-11 form-control" value="" type="text" required="">\
                        <div class="input-group-append">\
                            <div class="input-group-text">\
                              <i class="typcn typcn-chart-area-outline tx-24 lh--9 op-6"></i>\
                            </div>\
                        </div>\
                      </div>\
                    </div>\
                  </li>';
                }else{
                  var txt = '<li class="list-group-item d-flex align-items-center">\
                    <img src="../../img/cancel.svg" style="cursor:pointer;" class="settings-remove-option wd-20 rounded-circle mg-r-15" alt="">\
                    <div>\
                      <h6 class="settings-select-option tx-13 tx-inverse tx-semibold mg-b-0">'+parent.find('.settings-new-option').eq(index).val()+'</h6>\
                    </div>\
                  </li>';
                }
                parent.find('.list-group').eq(index).append(txt);
              }else parent.find('.settings-new-option').eq(index).css({border: '1px solid #dc3545'})
            });

            $(document).on('click','.settings-remove-option',function(){
              $(this).parent('.list-group-item').fadeOut(function(){
                $(this).remove();
              });
            });
        });
      });
    </script>
  </body>
</html>