<?php

$parent = '';
if($options['page'] != 'index')
$parent = '../';

$sub = $options['subpage'] == 'add' ? ucwords($options['subpage']) : ucwords($options['subpage']).'s';
$title = ucwords($options['page']) .' / '. $sub;
if($options['page'] == 'index')
$title = 'Dashboard';
if(($options['page'] == 'finance' || $options['page'] == 'insurance') && ($options['subpage'] == 'list'))
$title = ucwords($options['page']) .' / '.'Products';


$access = ucwords($rows['access']);

echo <<<EOT
<div class="az-header">
    <div class="container-fluid">
        <div class="az-header-left">
        <a href="" id="azSidebarToggle" class="az-header-menu-icon"><span></span></a>
        </div><!-- az-header-left -->
        
        <div class="az-header-center" style="margin-right:35px;">
        <input type="search" class="form-control" placeholder="Search for anything...">
        <button class="btn"><i class="fas fa-search"></i></button>
        </div><!-- az-header-center -->
        
        <div class="az-header-right">
            <div class="dropdown az-profile-menu">
                <a href="" class="az-img-user"><img src="{$parent}../img/logo_big.png" alt=""></a>
                <div class="dropdown-menu">
                <div class="az-dropdown-header d-sm-none">
                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="az-header-profile">
                    <div class="az-img-user">
                        <img src="{$parent}../img/logo_big.png" alt="">
                    </div><!-- az-img-user -->
                    <h6>Moneymatters Admin</h6>
                    <span>{$access} Admin</span>
                </div><!-- az-header-profile -->

                <a href="{$parent}settings" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Settings</a>
                <a href="{$parent}signout.php" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
                </div><!-- dropdown-menu -->
            </div>
        </div><!-- az-header-right -->
    </div><!-- container -->
</div><!-- az-header -->
EOT;

?>

<script>
    setTimeout(function(){
        $('#view-all').click(function(){
            var notifications = $(this).data('notifications');
            var totalNotifications = $(this).data('totalnotifications');
            
            //Add 5 more notifications to the view
            for(var i = totalNotifications; i <= totalNotifications + 5 && i < notifications.length; i++){
                $(this).data('totalnotifications',i+1);
                
                var notice = notifications[i];
                
                var icon = '';
                if(notice['category'] == 'hotels')icon = 'home-outline';
                if(notice['category'] == 'travel')icon = 'plane-outline';
                if(notice['category'] == 'finance')icon = 'chart-pie-outline';
                if(notice['category'] == 'insurance')icon = 'chart-bar-outline';
                if(notice['category'] == 'wedding')icon = 'starburst-outline';
                if(notice['category'] == 'events')icon = 'group-outline';
                if(notice['category'] == 'offers')icon = 'th-small-outline';
                if(notice['category'] == 'property')icon = 'calculator';
                if(notice['category'] == 'admin')icon = 'calculator';

                $('.az-notification-list').append(
                    '<div class="media new">\
                        <i class="typcn typcn-'+icon+'" style="font-size:25px;"></i>\
                        <div class="media-body">\
                            <p>'+notice['content']+'</p>\
                            <span>'+notice['date']+'</span>\
                        </div><!-- media-body -->\
                    </div><!-- media -->'
                );
            }
        });

    },1000)
</script>