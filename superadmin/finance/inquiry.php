<?php
  require_once('../../database.php');
    
  $sql = "SELECT * FROM `finance` ORDER BY `status`";
  $query = mysqli_query($database,$sql);
  $num = mysqli_num_rows($query);
  
  $result = array();
  if($num > 0){
    while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
      array_push($result,$rows);
      $result[count($result) - 1]['inquiry'] = json_decode($rows['inquiry'],true);
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
    <link href="../../lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="../../lib/jqvmap/jqvmap.min.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../../css/azia.css">

  </head>
  <body class="az-body az-body-sidebar">

    

    
    <?php
      $options = array('page' => 'finance','subpage'=>'booking');
      require_once('../sidebar.php');
    ?>




    <div class="az-content az-content-dashboard-two">

    

    
    <?php
      require_once('../header.php');
    ?>




    <div class="az-content-header d-block d-md-flex">
        <div>
          <h2 class="az-content-title tx-24 mg-b-5 mg-b-lg-8">Manage product's inquiries</h2>
          <p class="mg-b-0">View your products inquiries.</p>
        </div>
      </div><!-- az-content-header -->
      <div class="az-content-body">
        




































<div id="readmodal" class="modal" style="display:none;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Notice</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-indigo" id="deletenow" data-id="0">Delete</button>
        <button type="button" class="btn btn-outline-light" id="closenow" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div><!-- modal-dialog -->
</div>



        
        <?php
          if(isset($result) && is_array($result)){
            echo <<<EOT
            <table id="eventList" class="table" style="width: 100%;">
              <thead>
                <tr role="row">
                  <th rowspan="1" colspan="1" style="width: 1%;"></th>
                  <th rowspan="1" colspan="1" style="width: 15%;">Product ID</th>
                  <th rowspan="1" colspan="1" style="width: 25%;">Product Title</th>
                  <th rowspan="1" colspan="1" style="width: 20%;">Product Type</th>
                  <th rowspan="1" colspan="1" style="width: 20%;">Price</th>
                  <th rowspan="1" colspan="1" style="width: 20%; text-align:center;">Actions</th>
                </tr>
              </thead>
              <tbody>
EOT;
            for($i = 0; $i < count($result); $i++){
              $booking = json_encode($result[$i]);
              $inquiry = json_encode($result[$i]['inquiry']);
              
              echo <<<EOT
              <tr>
                <td class="details-control" data-booking='{$booking}' style="cursor:pointer;background:url('../../img/details_open.png') no-repeat center center;"></td>
                <td>{$result[$i]['finance_id']}</td>
                <td>{$result[$i]['title']}</td>
                <td>{$result[$i]['type']}</td>
                <td>{$result[$i]['price']}</td>
                <td style="display:flex;justify-content:center;align-items:flex-start">
                  <div data-toggle="modal" data-target="#readmodal" data-inquiry='{$inquiry}' class="openreadmodal">
                    <button type="button" class="btn btn-indigo">Read</button>
                  </div>
                </td>
            </tr>
EOT;
            }

            echo <<<EOT
            </tbody>
            </table>
EOT;
          }
          
          ?>































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

    <script src="../../js/admin/azia.js"></script>
    <script src="../../lib/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="admin.js"></script>
    <script>
      $(function(){
        'use strict'
        
        $('.az-toggle').on('click', function(){
          $(this).toggleClass('on');
        })

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
        // Added by GreyLoft
        var table = $('#eventList').DataTable({
                    "order": [[ 1, 'asc' ]],
                    "columns": [
                        {"orderable":false},
                        null,
                        null,
                        null,
                        null,
                        {"orderable":false},
                      ]
                    });

        // From: https://datatables.net/examples/api/row_details.html
        // From: https://datatables.net/blog/2014-10-02
        /* Formatting function for row details - modify as you need */
        function format ( d ) {
          // `d` is the original data object for the row
          return '<div class="slider" style="display:none;">'+
            '<div id="details-pane">'+
              '<div id="details-pane-body"></div>'+
            '</div>'+
          '</div>';
        }
 
        $(document).ready(function() {
            // Add event listener for opening and closing details
            $('#eventList tbody').on('click', 'td.details-control', function () {
            
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                var data = $(this).data('booking');
            
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    $('div.slider').slideUp(function(){
                      row.child.hide();
                      tr.removeClass('shown');
                    });
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                    $('div.slider').slideDown();

                    $('#details-pane').css({display:'flex'});
                    $('#details-pane-body')
                    .css({display:'flex',flexDirection:'column',width:'100%'})
                    .append('<div><h5>Processor:</h5>'+data.processor+'</div>')
                    .append('<div><h5>Type:</h5>'+data.type+'</div>')
                    .append('<div><h5>Type ID:</h5>'+data.type_id+'</div>')
                    .append('<div><h5>User ID:</h5>'+data.user_id+'</div>')
                    .append('<div><h5>Vendor ID:</h5>'+data.vendor_id+'</div>')
                    .append('<div><h5>Transaction ID:</h5>'+data.transaction_id+'</div>')

                    if(data.details.length > 0)
                    $('#details-pane-body').append('<div id="details-pane-body-details"><h5>Details:</h5></div>')
                    for(var $i = 0; $i < data.details.length; $i++)
                    $('#details-pane-body-details').append('<div>'+data.details[$i]+'</div>');
                    
                    $('#details-pane-body')
                    .children('div').eq(0).css({paddingBottom:10});
                    $('#details-pane-body')
                    .css({padding:10,paddingTop:5})
                    .children('div:not(:eq(0))').css({paddingTop:10,paddingBottom:10,borderTop:'1px solid #CDD4E0'})
                }
            });

            $('.openreadmodal').click(function(){
              var inquiry = $(this).data('inquiry');
              var modal = $('#readmodal').find('.modal-body').html('');
              for(var i = 0; i < inquiry.length; i++){
                modal.append(
                  '<div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">\
                    <div class="card">\
                      <div class="card-header" role="tab" id="headingZero">\
                        <a data-toggle="collapse" href="#collapse'+i+'" aria-expanded="true" aria-controls="collapse'+i+'">\
                         ['+inquiry[i]['date']+'] '+inquiry[i]['firstname']+', '+inquiry[i]['lastname']+'\
                        </a>\
                      </div><!-- card-header -->\
                      \
                      <div id="collapse'+i+'" data-parent="#accordion" class="collapse" role="tabpanel" aria-labelledby="headingZero">\
                        <div class="card-body">\
                          '+inquiry[i]['message']+'\
                        </div>\
                      </div>\
                    </div>\
                    \
                  </div>'
                );
              }
            })
        });
      });
    </script>
  </body>
</html>
