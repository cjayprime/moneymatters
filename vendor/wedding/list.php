<?php
  require_once('../../database.php');
    
  $sql = "SELECT * FROM `wedding` WHERE (`vendor_id` = '$vendor_id') AND `status` != '-1'";
  $query = mysqli_query($database,$sql);
  $num = mysqli_num_rows($query);
  
  $result = array();
  if($num > 0){
    while($rows = mysqli_fetch_array($query,MYSQLI_ASSOC)){
      array_push($result,$rows);
      $result[count($result) - 1]['category'] = json_decode($rows['category'],true);
      $result[count($result) - 1]['pictures'] = json_decode($rows['pictures'],true);
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
      $options = array('page' => 'wedding','subpage'=>'list');
      require_once('../sidebar.php');
    ?>




    <div class="az-content az-content-dashboard-two">

    

    
    <?php
      require_once('../header.php');
    ?>




    <div class="az-content-header d-block d-md-flex">
        <div>
          <h2 class="az-content-title tx-24 mg-b-5 mg-b-lg-8">Manage products</h2>
          <p class="mg-b-0">View, delete and modify the status of any product.</p>
        </div>
      </div><!-- az-content-header -->
      <div class="az-content-body">
        































<div id="deletemodal" class="modal" style="display:none;">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Notice</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this event.</p>
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
                  <th rowspan="1" colspan="1" style="width: 15%;">Wedding ID</th>
                  <th rowspan="1" colspan="1" style="width: 25%;">Title</th>
                  <th rowspan="1" colspan="1" style="width: 20%;">Category</th>
                  <th rowspan="1" colspan="1" style="width: 20%;">Time</th>
                  <th rowspan="1" colspan="1" style="width: 20%; text-align:center;">Actions</th>
                </tr>
              </thead>
              <tbody>
EOT;
            for($i = 0; $i < count($result); $i++){
              $data = json_encode($result[$i]);
              $status = $result[$i]['status'] == 1 ? 'on' : '';
              $category = '';
              for($j = 0; $j < count($result[$i]['category']); $j++){
                $append = $j != count($result[$i]['category']) - 1 ? ', ' : '';
                $category .= $result[$i]['category'][$j].$append;
              }
              echo <<<EOT
              <tr>
                <td class="details-control" data-data='{$data}' style="cursor:pointer;background:url('../../img/details_open.png') no-repeat center center;"></td>
                <td>{$result[$i]['wedding_id']}</td>
                <td>{$result[$i]['title']}</td>
                <td>{$category}</td>
                <td>{$result[$i]['time']}</td>
                <td style="display:flex;justify-content:space-around;align-items:flex-start">
                  <div class="az-toggle az-toggle-success switchstatus {$status}" data-id="{$result[$i]['wedding_id']}"><span></span></div>
                  <img src="../../img/cancel.svg" class="deleterow" data-toggle="modal" data-target="#deletemodal" style="cursor:pointer;" data-id="{$result[$i]['wedding_id']}" width="30px"/>
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
              '<div id="details-pane-images"></div>'+
              '<div id="details-pane-body"></div>'+
            '</div>'+
          '</div>';
        }
 
        $(document).ready(function() {
            // Add event listener for opening and closing details
            $('#eventList tbody').on('click', 'td.details-control', function () {
            
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                var data = $(this).data('data');
            
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
                    $('#details-pane-images').css({width:'35%'});
                    $('#details-pane-body')
                    .css({display:'flex',flexDirection:'column',width:'65%'})

                    for(var key in data){
                      if(key == 'pictures')continue;
                      var label = key.split('_');
                      var label_0 = label[0].charAt(0).toUpperCase() + label[0].slice(1);
                      var label_1 = typeof label[1] != 'undefined' ? label[1] : '';
                      label = label_0 + ' ' + label_1;
                      $('#details-pane-body')
                      .append('<div><h5>'+label+':</h5>'+data[key]+'</div>')
                    }
                    
                    $('#details-pane-body')
                    .children('div').eq(0).css({paddingBottom:10});
                    $('#details-pane-body')
                    .css({padding:10,paddingTop:5})
                    .children('div:not(:eq(0))').css({paddingTop:10,paddingBottom:10,borderTop:'1px solid #CDD4E0'})

                    console.log(data.pictures)
                    for(var $i = 0; $i < data.pictures.length; $i++)
                    $('#details-pane-images').append('<img src="../'+data.pictures[$i]+'" />');
                    $('#details-pane-images').children('img').css({width:'28.333%',margin:'2.5%'});
                }
            });

            $('.deleterow').click(function(){
              $('#deletenow').data({id:$(this).data('id')});
            });
            
            $('.switchstatus').click(function(e){
              if(e.originalEvent === undefined)return;

              var self = $(this);
              $.ajax({
                url:'action.php',
                method:'post',
                data:{command: "switch",type: "wedding",id: $(this).data('id'), data:{currentStatus: $(this).hasClass('on')}},
                dataType: 'json',
                success:function(xhr){
                  if(typeof xhr.success == 'undefined' || xhr.success == false)
                  self.click();
                },
                error:function(xhr){
                  //If error switch back
                  self.click();
                }
              });
            });

            $('#deletenow').click(function(e){
              var id = $(this).data('id');
                    console.log(id)
              $.ajax({
                url:'action.php',
                method:'post',
                data:{command: "delete",type: "wedding",id: id},
                dataType: 'json',
                success:function(xhr){
                    console.log(xhr)
                  if(xhr.success == true)
                  $('.deleterow').each(function(){
                    console.log($(this).data('id') , id)
                    if($(this).data('id') == id){
                      $(this).closest('tr').fadeOut(1000,function(){
                        $(this).remove();
                      });
                    }
                  });

                  $('#closenow').click();
                },
                error:function(xhr){
                  $('#closenow').click();
                }
              });
            });
        });
      });
    </script>
  </body>
</html>
