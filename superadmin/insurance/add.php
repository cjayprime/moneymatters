<?php

    require_once('../../database.php');

    $sql = "SELECT * FROM `admin` WHERE `page` = 'insurance' AND `title` = 'moneymatters'";
    $query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);

    $result = array();
    
    if($num > 0){
        $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $result['category'] = json_decode($result['category'],true);
        $result['type'] = json_decode($result['type'],true);
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

    <!-- azia CSS -->
    <link rel="stylesheet" href="../../css/azia.css">

  </head>
  <body class="az-body az-body-sidebar">

    

    
    <?php
      $options = array('page' => 'insurance','subpage'=>'add');
      require_once('../sidebar.php');
    ?>




    <div class="az-content az-content-dashboard-two">

    

    
    <?php
      require_once('../header.php');
    ?>




    <div class="az-content-header d-block d-md-flex">
        <div>
          <h2 class="az-content-title tx-24 mg-b-5 mg-b-lg-8">Add new property</h2>
          <p class="mg-b-0">Follow the steps in the wizard to add a new property.</p>
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
    
    <h3>Vendor & Provider Category</h3>
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
                    <input id="vendor" class="form-control" placeholder="Enter the id of the vendor that owns the event" type="number" required>
                </div>
            </div><!-- col -->
            <div class="col-md-6">
                <label class="form-control-label">Provider Category: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-home-outline tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <select id="category" class="form-control select">
                    



                    
                    <?php
                        for($i = 0; $i < count($result['category']); $i++){
                            echo '<option value="'.$result['category'][$i].'">'.$result['category'][$i].'</option>';
                        }
                    ?>





                    </select>
                </div>
            </div><!-- col -->
        </div><!-- row -->
    </section>

    <h3>Details</h3>
    <section>
        <div class="row row-sm mg-t-40">
            <div class="col-md-6 col-lg-4 mg-t-20 mg-md-t-0">
                <label class="form-control-label">Product Type: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-user-outline tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    




                    
                    <?php
                        for($i = 0; $i < count($result['category']); $i++){
                            $type = $result['type'][$result['category'][$i]];
                            echo '<div class="type-options" style="display:none;" data-id="'.$result['category'][$i].'" data-value=\''.json_encode($type).'\'>'.json_encode($type).'</div>';
                        }
                    ?>





                    <select id="type" class="form-control select" multiple>
                    </select>
                </div>
            </div><!-- col -->
            <div class="col-md-6 col-lg-4 mg-t-20 mg-md-t-0">
                <label class="form-control-label">Tenure: <span class="tx-danger">*</span></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-time tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input id="tenure" class="form-control" placeholder="How long do you want to be insured?" type="number" required>
                    <div class="input-group-append">
                        <select id="tenure-word" class="form-control select">
                            <option>year(s)</option>
                            <option>month(s)</option>
                            <option>week(s)</option>
                            <option>day(s)</option>
                        <select>
                    </div>
                </div>
            </div><!-- col -->
            <div class="col-md-6 col-lg-4">
                <label class="form-control-label">Value: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-document-text tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input id="value" class="form-control" placeholder="What is the value of the item you want to insure?" type="number" required>
                </div>
            </div><!-- col -->
        </div><!-- row -->
        <div class="row row-sm mg-t-40">
            <div class="col-md-6 col-lg-4">
                <label class="form-control-label">Product Title: <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-document-text tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input id="title" class="form-control" placeholder="What is the product's title?" type="text" required>
                </div>
            </div><!-- col -->
            <div class="col-md-6 col-lg-4">
                <label class="form-control-label">Tags (use comma or space seperated words): <span class="tx-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-document-text tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input id="tags" class="form-control" placeholder="Specify tags for users to your product." type="text" required>
                </div>
            </div><!-- col -->
            <div class="col-md-6 col-lg-4 mg-t-20 mg-md-t-0">
                <label class="form-control-label">Price (per cover): <span class="tx-danger">*</span></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input id="price" type="number" class="form-control" placeholder="What is the price per cover of this product?">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
            </div><!-- col -->
        </div><!-- row -->
        <div class="row row-sm mg-t-40">
            <div class="col-md-12">
                <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                <textarea id="description" class="form-control" rows="3" placeholder="What are the rules for the property or it's vicinity" type="text" required></textarea>
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
                        id: 'insurance',
                        vendor: $('#vendor').val(),
                        category: $('#category').val(),
                        product_type: JSON.stringify($('#type').val()),
                        tenure: $('#tenure').val() +' '+ $('#tenure-word').val(),
                        value: $('#value').val(),
                        title: $('#title').val(),
                        tags: $('#tags').val(),
                        price: $('#price').val(),
                        description: $('#description').val(),
                        islamic: $('#islamic').prop('checked')
                    };
                    var formdata = new FormData();
                    for(var key in data)formdata.append(key,data[key]);
                    
                    $.ajax({url: 'action.php',data: formdata,
                        method:'POST',
                        dataType:"json",
                        success:function(res,status,xhr){
                            console.log(res);
                            if(res.success)
                            MoneyMatters.success(res.message,'You have successfully added a new insurance product.');
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
                },
                select2: function(){
                    //$('#category,#amenities,#facilities,#duration-word,#country')
                    $('#category,#type')
                    .each(function(i){
                        var placeholder = '';
                        //Type
                        if(i == 1)placeholder = 'Choose the specific type of services you offer.';
                        $(this).select2({
                            placeholder: placeholder,
                            searchInputPlaceholder: 'Search'
                        }).on('select2:select', function(){
                            if($(this).val().length > 0)
                            $(this).next('.select2').find('.select2-selection').css({border:'1px solid #cdd4e0'});
                        });
                    });

                    var changeTypes = function(){
                        $('#type').html('');
                        $('.type-options').each(function(){
                            var $this = $(this);
                            if($('#category').val() == $(this).data('id')){
                                var types = $(this).data('value');
                                for(var key in types){
                                    if(typeof types[key] == 'object'){
                                        for(var value in types[key]){
                                            $('#type').append('<option>'+types[key][value]+'</option>');
                                        }
                                    }else $('#type').append('<option>'+types[key]+'</option>');
                                }
                            }
                        });
                    }
                    changeTypes();
                    $('#category').on('select2:select', changeTypes);
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
                            if($('#vendor').val().length > 0 && $('#category').val().length > 0){
                                $('#vendor').css(success);
                                $('#category').next('.select2').find('.select2-selection').css(success);
                                return true;
                            }else{
                                if($('#vendor').val().length == 0)
                                $('#vendor').css(error);
                                if($('#category').val().length == 0)
                                $('#category').next('.select2').find('.select2-selection').css(error);
                            }
                        }
                        // Always allow step back to the previous step even if the current step is not valid.
                    } else { return true; }
                },
                onFinishing: function(event, currentIndex){
                    // Step 2 form validation
                    if(currentIndex === 1) {
                        const success = {border:'1px solid #cdd4e0'};
                        const error = {border:'1px solid #dc3545'};
                        var error_text = [];
                        
                        var type = $('#type');
                        var tenure = $('#tenure');
                        var value = $('#value');
                        var title = $('#title');
                        var tags = $('#tags');
                        var price = $('#price');
                        var description = $('#description');
                        
                        var validate = {type: type, tenure: tenure, value: value, title: title, tags: tags, price: price, description: description};
                        for(var key in validate){
                            var elem = validate[key];
                            
                            if(key == 'type')
                            elem = validate[key].next('.select2').find('.select2-selection');

                            if(validate[key].val().length > 0 || ((key == 'tenure' || key == 'value' || key == 'price') && /^[0-9]+$/.test(validate[key].val())) ){
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
                        MoneyMatters.select2();
                    });
                } 
            });

            MoneyMatters.select2();

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

        });
      });
    </script>
  </body>
</html>
