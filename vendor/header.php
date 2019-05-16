<?php

$sql = "SELECT * FROM `vendor` WHERE `vendor_id` = '$vendor_id'";
$query = mysqli_query($database,$sql);
$num = mysqli_affected_rows($database);
$rows = mysqli_fetch_array($query,MYSQLI_ASSOC);

$all_notifications = $rows['notifications'];
$total_notifications = 0;

$rows['notifications'] = json_decode($rows['notifications'],true);

$notifications = '';
for($i = 0; $i < count($rows['notifications']); $i++){
    $notice = $rows['notifications'][$i];
    
    $icon = '';
    if($notice['category'] == 'hotels')$icon = 'home-outline';
    if($notice['category'] == 'travel')$icon = 'plane-outline';
    if($notice['category'] == 'finance')$icon = 'chart-pie-outline';
    if($notice['category'] == 'insurance')$icon = 'chart-bar-outline';
    if($notice['category'] == 'wedding')$icon = 'starburst-outline';
    if($notice['category'] == 'events')$icon = 'group-outline';
    if($notice['category'] == 'offers')$icon = 'th-small-outline';
    if($notice['category'] == 'property')$icon = 'calculator';
    if($notice['category'] == 'admin')$icon = 'calculator';

    if($notice['read'] == false){
        $rows['notifications'][$i]['read'] = true;
        $total_notifications++;
        $notifications .= <<<EOT
            <div class="media new">
                <i class="typcn typcn-{$icon}" style="font-size:25px;"></i>
                <div class="media-body">
                    <p>{$notice['content']}</p>
                    <span>{$notice['date']}</span>
                </div><!-- media-body -->
            </div><!-- media -->
EOT;
    }
}


$sql = "UPDATE `vendor` SET `notifications` = '".json_encode($rows['notifications'])."' WHERE `vendor_id` = '$vendor_id'";
$query = mysqli_query($database,$sql);
$num = mysqli_affected_rows($database);


$type = ucwords($rows['type']) . ' Vendor';
$new = '';
if($total_notifications > 0)$new = 'new';


$parent = '';
if($options['page'] != 'index')
$parent = '../';

$sub = $options['subpage'] == 'add' || $options['subpage'] == 'inquiry' ? ucwords($options['subpage']) : ucwords($options['subpage']).'s';
$title = ucwords($options['page']) .' / '. $sub;
if($options['page'] == 'index')
$title = 'Dashboard';
if(($options['page'] == 'finance' || $options['page'] == 'insurance') && ($options['subpage'] == 'list'))
$title = ucwords($options['page']) .' / '.'Products';


echo <<<EOT
<script>document.title = 'Vendor / {$title}';</script>
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
            <div class="dropdown az-header-notification">
                <a href="" class="{$new}"><i class="typcn typcn-bell"></i></a>
                <div class="dropdown-menu">
                <div class="az-dropdown-header mg-b-20 d-sm-none">
                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <h6 class="az-notification-title">Notifications</h6>
                <p class="az-notification-text">You have {$total_notifications} unread notification</p>
                <div class="az-notification-list">
                    {$notifications}
                </div><!-- az-notification-list -->
                <div class="dropdown-footer" id="view-all" data-totalnotifications="{$total_notifications}" data-notifications='{$all_notifications}'><div style="cursor:pointer;color:blue;">View more read notifications</div></div>
                </div><!-- dropdown-menu -->
            </div><!-- az-header-notification -->

            <div class="dropdown az-profile-menu">
                <a href="" class="az-img-user"><img src="{$parent}{$rows['business_logo']}" alt=""></a>
                <div class="dropdown-menu">
                <div class="az-dropdown-header d-sm-none">
                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="az-header-profile">
                    <div class="az-img-user">
                        <img src="{$parent}{$rows['business_logo']}" alt="">
                    </div><!-- az-img-user -->
                    <h6>{$rows['business_name']}</h6>
                    <span>{$type}</span>
                </div><!-- az-header-profile -->

                <a href="{$parent}settings" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
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