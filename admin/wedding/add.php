<?php

    require_once('../../database.php');

    $sql = "SELECT * FROM `admin` WHERE `page` = 'wedding' AND `title` = 'moneymatters'";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);

    $result = array();
    
    if($num > 0){
        $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $result['category'] = json_decode($result['category'],true);
    }

    $sql = "SELECT * FROM `admin` WHERE `page` = 'settings' AND `title` = 'admin'";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    if($num > 0){
        $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $result['country'] = json_decode($rows['country'],true);
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
      $options = array('page' => 'wedding','subpage'=>'add');
      require_once('../sidebar.php');
    ?>




    <div class="az-content az-content-dashboard-two">

    

    
    <?php
      require_once('../header.php');
    ?>




    <div class="az-content-header d-block d-md-flex">
        <div>
          <h2 class="az-content-title tx-24 mg-b-5 mg-b-lg-8">Add new wedding vendor</h2>
          <p class="mg-b-0">Follow the steps in the wizard to add a new wedding vendor.</p>
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






<div id="wizard">
    
    <h3>Vendor & Title</h3>
    <section>
        <div class="row row-sm mg-t-40">
            <div class="col-md-6">
                <label class="form-control-label">Vendor: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-business-card tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input id="vendor" class="form-control" placeholder="Enter the id of the vendor that owns the wedding" type="number" required>
                </div>
            </div><!-- col -->
            <div class="col-md-6">
                <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-message-typing tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input id="title" class="form-control" placeholder="Enter a title for the wedding" type="text" required>
                </div>
            </div><!-- col -->
        </div><!-- row -->
    </section>
    
    <h3>Features</h3>
    <section>
        <div class="row row-sm mg-t-40">
            <div class="col-md-6 col-lg-4">
                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-document-text tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <select id="category" class="form-control select" multiple>
                    
                    
                    
                    
                    
                    <?php
                        for($i = 0; $i < count($result['category']); $i++){
                            echo '<option value="'.$result['category'][$i].'">'.$result['category'][$i].'</option>';
                        }
                    ?>







                    </select>
                </div>
            </div><!-- col -->
            <div class="col-md-6 col-lg-4 mg-md-t-0">
                <label class="form-control-label">Pictures: <span class="tx-danger">*</span>
                &nbsp;
                <span style="cursor:pointer" class="badge badge-pill badge-primary" id="openpreviewmodal"  data-toggle="modal" data-target="#previewmodal">Preview</span></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="images" multiple>
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div><!-- col -->
            <div class="col-md-6 col-lg-4">
                <label class="form-control-label">Date & Time: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input id="dateandtimepicker" class="form-control" placeholder="When is the wedding?" value="March 29, 2019 12:00" type="text" required>
                </div>
            </div><!-- col -->
        </div><!-- row -->
        <div class="row row-sm mg-t-40">
            <div class="col-md-12">
                <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                <textarea id="description" class="form-control" rows="3" placeholder="Enter the wedding's description" type="text" required></textarea>
            </div><!-- col -->
        </div><!-- row -->
    </section>
    
    <h3>Location</h3>
    <section>
        <div class="row row-sm mg-t-40">
            <div class="col-md-6 col-lg-4">
                <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-flag-outline tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <select id="country" class="form-control select">
                    
                    
                    
                    
                    
                    <?php
                        foreach($result['country'] as $key => $value)
                        echo '<option value="'.$result['country'][$key].'">'.$result['country'][$key].'</option>';
                    ?>
                    



                    </select>
                </div>
            </div><!-- col -->
            <div class="col-md-6 col-lg-4 mg-t-20 mg-md-t-0">
                <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-location-arrow-outline tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input id="state" class="form-control" placeholder="What state is the wedding located in?" type="text" required>
                </div>
            </div><!-- col -->
            <div class="col-md-6 col-lg-4 mg-t-20 mg-md-t-0">
                <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-map tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input id="city" class="form-control" placeholder="What city is the wedding located in?" type="text" required>
                </div>
            </div><!-- col -->
        </div><!-- row -->
        <div class="row row-sm mg-t-40">
            <div class="col-md-6 col-lg-4">
                <label class="form-control-label">District: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-location-outline tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input id="district" class="form-control" placeholder="What district is the wedding located in?" type="text" required>
                </div>
            </div><!-- col -->
            <div class="col-md-8 mg-md-t-0">
                <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                <textarea id="address" class="form-control" placeholder="Enter the address of the wedding." type="text" required></textarea>
            </div><!-- col -->
        </div><!-- row -->
    </section>
    
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
    <script src="admin.js"></script>
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
                save: function(){
                    var data = {
                        type: 'upload',
                        command: 'create',
                        id: 'wedding',
                        vendor: $('#vendor').val(),
                        title: $('#title').val(),
                        category: JSON.stringify($('#category').val()),
                        description: $('#description').val(),
                        time: $('#dateandtimepicker').val(),
                        country: $('#country').val(),
                        state: $('#state').val(),
                        city: $('#city').val(),
                        district: $('#district').val(),
                        address: $('#address').val()
                    };
                    var formdata = new FormData();
                    for(var key in data)formdata.append(key,data[key]);
                    //PICTURES
                    for(var i = 0; i < SelectedFiles.length; i++)
                    formdata.append('pictures['+i+']',SelectedFiles[i]);
                    
                    $.ajax({url: 'action.php',data: formdata,
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
                        contentType: false,
                        processData: false
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

            $('#wizard').steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                autoFocus: true,
                titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                labels:{
                    finish: 'Submit',
                    next: 'Continue',
                    previous: 'Back'
                },
                onStepChanging: function (event, currentIndex, newIndex) {
                    if(currentIndex < newIndex) {
                        const success = {border:'1px solid #cdd4e0'};
                        const error = {border:'1px solid #dc3545'};
                        var error_text = [];

                        // Step 1 form validation
                        if(currentIndex === 0) {
                            if($('#vendor').val().length > 0 && $('#title').val().length > 0){
                                $('#vendor,#title').css(success);
                                return true;
                            }else{
                                if($('#vendor').val().length == 0)
                                $('#vendor').css(error);
                                if($('#title').val().length == 0)
                                $('#title').css(error);
                            }
                        }

                        // Step 2 form validation
                        if(currentIndex === 1) {
                            var category = $('#category');
                            var images = $('#images');
                            var description = $('#description');
                            var dateandtimepicker = $('#dateandtimepicker');
                            
                            var validate = {category: category, images: images, description: description, dateandtimepicker: dateandtimepicker};
                            for(var key in validate){
                                var elem = validate[key];
                                
                                if(key == 'category')
                                elem = validate[key].next('.select2').find('.select2-selection');
                                if(key == 'images')
                                elem = validate[key].next('label');
                                
                                if((key != 'images' && validate[key].val().length > 0) || (key == 'images' && SelectedFiles.length > 0)){
                                    elem.css(success);
                                } else {
                                    elem.css(error);
                                    error_text.push(key);
                                }
                            }

                            if(error_text.length === 0)return true;
                        }

                        // Always allow step back to the previous step even if the current step is not valid.
                    } else { return true; }
                },
                onFinishing: function(event, currentIndex){
                    // Step 4 form validation
                    if(currentIndex === 2) {
                        const success = {border:'1px solid #cdd4e0'};
                        const error = {border:'1px solid #dc3545'};
                        var error_text = [];

                        var country = $('#country');
                        var state = $('#state');
                        var city = $('#city');
                        var district = $('#district');
                        var address = $('#address');
                        
                        var validate = {country: country,state: state,city: city,district: district,address: address};

                        for(var key in validate){
                            var elem = validate[key];
                            
                            if(key == 'country')
                            elem = validate[key].next('.select2').find('.select2-selection');
                        
                            if(validate[key].val().length > 0){
                                elem.css(success);
                            } else {
                                elem.css(error);
                                error_text.push(key);
                            }
                        }

                        if(error_text.length === 0){
                            MoneyMatters.save();
                            return true;
                        }
                    }
                },
                onStepChanged: function(){
                    setTimeout(function(){
                        // Because this wizard section has display:none (is hidden)
                        // It doesn't display any select2 elements well since they do computations
                        // This is a fix for that
                        $('#category,#country').select2({
                            placeholder: 'Choose one or more categories',
                            searchInputPlaceholder: 'Search'
                        }).off('select2:select').on('select2:select', function(){
                            if($(this).val().length > 0)
                            $(this).next('.select2').find('.select2-selection').css({border:'1px solid #cdd4e0'});
                        });
                    });
                } 
            });

            $('#category').select2({
                placeholder: 'Choose one or more categories',
                searchInputPlaceholder: 'Search'
            }).on('select2:select', function(){
                if($(this).val().length > 0)
                $(this).next('.select2').find('.select2-selection').css({border:'1px solid #cdd4e0'});
            });

            $('textarea,input[type=text]').keyup(function(){
                if($(this).val().length > 0)
                $(this).css({border:'1px solid #cdd4e0'});
            });

            $('input[type=number]').keyup(function(){
                if(/^[0-9]+$/.test($(this).val()))
                $(this).css({border:'1px solid #cdd4e0'});
                else
                $(this).css({border:'1px solid #dc3545'});
            }).change(function(){
                if(/^[0-9]+$/.test($(this).val()))
                $(this).css({border:'1px solid #cdd4e0'});
                else
                $(this).css({border:'1px solid #dc3545'});
            });

            $('input[type=file]').change(function(e){
                var files = e.target.files;
                for(var i = 0; i < files.length; i++){
                    var reader = new FileReader();
                    var f = files[i];
                    if(f.size <= 153600 && (f.type == 'image/png' || f.type == 'image/jpg' || f.type == 'image/jpeg')){
                        $('#images').next('label').css({border:'1px solid #cdd4e0'});
                        SelectedFiles.push(f);
                        reader.readAsDataURL(f);
                        reader.onload = readSuccess;
                        reader.onerror = function(event){
                            MoneyMatters.error("File could not be read: " + event.target.error.code,'An unknown error occurred');
                        };
                    }else if(f.size > 153600){
                        //Size Error
                        MoneyMatters.error('Size Error: The size of this image ('+f.name+') is too large','The maximum size for an image file is 150KB.');
                    }else if(f.type != 'image/png' && f.type != 'image/jpg' && f.type != 'image/jpeg'){
                        //Type Error
                        MoneyMatters.error('Size Error: The type of this image ('+f.name+') is not ".png" or "jp(e)g"','The file type for images must be "png" or "jp(e)g"');
                    }
                }
                
                function readSuccess(e){
                    var img = e.target.result;
                    $('#previewmodal').find('.modal-body span').html('')
                    $('#previewmodal').find('.modal-body div')
                    .append('<img src="'+img+'"/>')
                    .find('img')
                    .css({width:'28.333%',margin:'2.5%'});
                }
            });

            new Picker(document.querySelector('#dateandtimepicker'), {
                headers: true,
                format: 'MMMM DD, YYYY HH:mm',
                text: {
                    title: 'Pick a Date and Time',
                    year: 'Year',
                    month: 'Month',
                    day: 'Day',
                    hour: 'Hour',
                    minute: 'Minute'
                }
            });
        });
      });
    </script>
  </body>
</html>
