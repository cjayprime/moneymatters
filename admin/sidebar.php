



<?php

$parent = '';
if($options['page'] != 'index')
$parent = '../';

$list = '';
$menu = array(
    'Hotels' => array('Manage bookings' => 'booking.php'),
    'Travel' => array('Manage bookings' => 'booking.php'),
    'Finance' => array('Manage products' => 'list.php','Manage inquiries' => 'inquiry.php','Manage vendors' => 'vendor.php','Add new products' => 'add.php'),
    'Insurance' => array('Manage products' => 'list.php','Manage purchases' => 'purchase.php','Manage vendors' => 'vendor.php','Add new products' => 'add.php'),
    'Wedding' => array('Manage weddings' => 'list.php','Manage bookings' => 'booking.php','Manage vendors' => 'vendor.php','Add new wedding' => 'add.php'),
    'Events' => array('Manage events' => 'list.php','Manage bookings' => 'booking.php','Manage vendors' => 'vendor.php','Add new events' => 'add.php'),
    'Offers' => array('Manage offers' => 'list.php','Manage bookings' => 'booking.php','Manage vendors' => 'vendor.php','Add new offer' => 'add.php'),
    'Property' => array('Manage properties' => 'list.php','Manage bookings' => 'booking.php','Manage vendors' => 'vendor.php','Add new properties' => 'add.php'));

foreach($menu as $key => $value){
    $inner_list = '';
    
    $icon = '';
    if($key == 'Hotels')$icon = 'home-outline';
    if($key == 'Travel')$icon = 'plane-outline';
    if($key == 'Finance')$icon = 'chart-pie-outline';
    if($key == 'Insurance')$icon = 'chart-bar-outline';
    if($key == 'Wedding')$icon = 'starburst-outline';
    if($key == 'Events')$icon = 'group-outline';
    if($key == 'Offers')$icon = 'th-small-outline';
    if($key == 'Property')$icon = 'calculator';
    
    $show = '';
    if($options['page'] == strtolower($key))
    $show = 'show';

    foreach($value as $title => $link){
        $active = '';
        if($options['page'] == strtolower($key) && $options['subpage'].'.php' == strtolower($link))
        $active = 'active';

        $inner_list .= '<li class="nav-sub-item '.$active.'"><a href="'.$parent.strtolower($key).'/'.$link.'" class="nav-sub-link">'.$title.'</a></li>';
    }

    $list .= <<<EOT
        <li class="nav-item {$show}">
            <a style="cursor:pointer;" class="nav-link with-sub"><i class="typcn typcn-{$icon}"></i>{$key}</a>
            <ul class="nav-sub">
                {$inner_list}
            </ul>
        </li><!-- nav-item -->
EOT;
}


$sql = "SELECT * FROM `admin` WHERE `admin_id` = '$admin_id'";
$query = mysqli_query($database,$sql);
$num = mysqli_affected_rows($database);
$rows = mysqli_fetch_array($query,MYSQLI_ASSOC);

$access = ucwords($rows['access']);

echo <<<EOT
    <div class="az-sidebar">
        <div class="az-sidebar-loggedin">
            <div class="az-img-user online"><img src="{$parent}../img/logo_big.png" alt=""></div>
            <div class="media-body">
                <h6>Moneymatters Admin</h6>
                <span>{$access} Admin</span>
            </div><!-- media-body -->
        </div><!-- az-sidebar-loggedin -->
        <div class="az-sidebar-body">
            <ul class="nav">
                <li class="nav-label">Main Menu</li>
                <li class="nav-item">
                    <a href="{$parent}" class="nav-link"><i class="typcn typcn-clipboard"></i>Dashboard</a>
                </li><!-- nav-item -->
                
                {$list}

                <li class="nav-item">
                    <a href="{$parent}settings" class="nav-link"><i class="typcn typcn-cog-outline"></i>Settings</a>
                </li>
            </ul><!-- nav -->
        </div><!-- az-sidebar-body -->
    </div><!-- az-sidebar -->
EOT;

?>