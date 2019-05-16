<?php

    require_once('../../database.php');

    $sql = "SELECT * FROM `vendor` WHERE `vendor_id` = '$vendor_id' LIMIT 1";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);

    $result = array();
    if($num > 0){
        $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
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
        $options = array('page' => 'settings','subpage'=>'index');
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
        Account
      </a>
    </div><!-- card-header -->

    <div id="collapseZero" data-parent="#accordion" class="collapse show" role="tabpanel" aria-labelledby="headingZero">
      <div class="card-body">
        

        <div class="wizard account">
            <h3>Access & Contact Information</h3>
            <section>
                <div class="row row-sm mg-t-40">
                  <div class="col-md-6">
                      <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-key-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input id="password" class="settings-new-option form-control" placeholder="Enter your password" type="password" required>
                      </div>
                  </div><!-- col -->
                  <div class="col-md-6">
                      <label class="form-control-label">Repeat Password: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-key-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input id="repeat-password" class="settings-new-option form-control" placeholder="Enter your password again" type="password" required>
                      </div>
                  </div><!-- col -->
                </div>
                <div class="row row-sm mg-t-40">
                  <div class="col-md-6">
                    <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="typcn typcn-mail tx-24 lh--9 op-6"></i>
                            </div>
                        </div>
                        <input value="<?php echo isset($result['email']) ? $result['email'] : '' ?>" id="email" class="settings-new-option form-control" placeholder="Enter your email" type="text" required>
                    </div>
                  </div><!-- col -->
                  <div class="col-md-6">
                      <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-phone-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input value="<?php echo isset($result['phone']) ? $result['phone'] : '' ?>" id="phone" class="settings-new-option form-control" placeholder="Enter your phone number" type="text" required>
                      </div>
                  </div><!-- col -->
                </div>
            </section>

            
            <h3>Business Information</h3>
            <section>
                <div class="row row-sm mg-t-40">
                  <div class="col-md-6">
                      <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="typcn typcn-key-outline tx-24 lh--9 op-6"></i>
                              </div>
                          </div>
                          <input value="<?php echo isset($result['business_name']) ? $result['business_name'] : '' ?>" id="business-name" class="settings-new-option form-control" placeholder="Enter your business name" type="text" required>
                      </div>
                  </div><!-- col -->
                  <div class="col-md-6">
                      <label class="form-control-label">Logo: <span class="tx-danger">*</span>
                      &nbsp;
                      <span style="cursor:pointer" class="badge badge-pill badge-primary" id="openpreviewmodal"  data-toggle="modal" data-target="#previewmodal">Preview</span></label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" id="business-logo">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                  </div><!-- col -->
                </div>
                <div class="row row-sm mg-t-40">
                  <div class="col-md-12">
                      <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                      <textarea id="business-address" class="form-control" rows="3" required><?php echo isset($result['business_address']) ? $result['business_address'] : '' ?></textarea>
                  </div><!-- col -->
                </div>
            </section>
        </div>


      </div>
    </div>
  </div>
  

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

    <script src="../../js/admin/azia.js"></script>
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
                    var post = {
                      command: 'edit',
                      id: 'account',
                      type: 'upload',
                      password: $('#password').val(),
                      email: $('#email').val(),
                      phone: $('#phone').val(),
                      businessname: $('#business-name').val(),
                      businessaddress: $('#business-address').val(),
                    };
                    
                    var formdata = new FormData();
                    for(var key in post)formdata.append(key,post[key]);
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

            $('.wizard').each(function(){
              var self = $(this);
              self.steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                autoFocus: true,
                titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                onStepChanging: function (event, currentIndex, newIndex) {
                    if(currentIndex == 0){
                      if($('#password').val().length > 0 && $('#password').val() == $('#repeat-password').val()){
                        $('#password,#repeat-password').css({border:'1px solid #cdd4e0'});
                        return true;
                      }else{
                        if($('#password').val().length == 0)
                        $('#password').css({border:'1px solid #dc3545'});
                        
                        if($('#repeat-password').val().length == 0)
                        $('#repeat-password').css({border:'1px solid #dc3545'});

                        if(!($('#password').val().length > 0 && $('#password').val() == $('#repeat-password').val()))
                        $('#repeat-password').css({border:'1px solid #dc3545'});
                      }
                    }else return true;
                },
                onFinishing: function(event, currentIndex){
                  if(currentIndex == 1){
                    if($('#business-name').val().length > 0 && SelectedFiles.length > 0 && $('#business-name').val().length > 0){
                      $('#business-name,#business-address').css({border:'1px solid #cdd4e0'});
                      $('#business-logo').next('label').css({border:'1px solid #cdd4e0'});
                      MoneyMatters.save();
                    }else{
                      if($('#business-name').val().length == 0)
                      $('#business-name').css({border:'1px solid #dc3545'});

                      if(SelectedFiles.length == 0)
                      $('#business-logo').next('label').css({border:'1px solid #dc3545'});

                      if($('#business-address').val().length == 0)
                      $('#business-address').css({border:'1px solid #dc3545'});
                    }
                    $('#business-address').val()
                  }
                },
                onStepChanged: function(){} 
              });
            });

            $('input[type=password]').keyup(function(){
              if($(this).val().length > 0)
              $(this).css({border:'1px solid #cdd4e0'});
            })
            
            $(document).on('keyup','textarea,input[type=text]',function(){
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
        });
      });
    </script>
  </body>
</html>