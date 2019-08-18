<?php
    
    if(!isset($database))require_once('database.php');

    // Admin
    $sql = "SELECT `currency`,`symbol` FROM `admin` WHERE `title` = 'admin' AND `page` = 'settings'";
	$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $_result = array('currency'=>'','symbol'=>'');
    //echo json_encode(array("GBP"=>"£", "EUR"=>"€", "NGN"=>"₦", "USD"=>"$"),JSON_UNESCAPED_UNICODE);
    if($num > 0){
      $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
      $_result['currency'] = json_decode($rows['currency'],true);
      $_result['symbol'] = json_decode($rows['symbol'],true);
    }

    // User
    $sql = "SELECT `currency` FROM `user` WHERE `user_id` = '$user_id'";
	$query = mysqli_query($database,$sql);
    $num = mysqli_num_rows($query);
    
    $_user = array('currency'=>'NGN');
    if($num > 0){
      $_user = mysqli_fetch_array($query,MYSQLI_ASSOC);
    }

    $menu = array();
    if($options['page'] === 'property'){
        $menu = array('Home' => 'index.php','Search' => 'results.php','Blog' => '','Guide' => '','FAQs' => '');
        $class = 'navbar navbar-default navbar-theme';
        if($options['subpage'] === 'listing')$class = 'navbar navbar-default navbar-inverse navbar-theme navbar-theme-abs navbar-theme-transparent navbar-theme-border';
        if($options['subpage'] === 'payment' || $options['subpage'] === 'order')$class = 'navbar navbar-default navbar-inverse navbar-theme';
    }else if($options['page'] === 'events'){
        $menu = array('Home' => 'index.php','Search' => 'results.php','Blog' => '','Guide' => '','FAQs' => '');
        $class = 'navbar navbar-default navbar-inverse navbar-theme navbar-theme-abs navbar-theme-transparent navbar-theme-border';
        if($options['subpage'] === 'results')$class = 'navbar navbar-default navbar-theme';
        if($options['subpage'] === 'payment' || $options['subpage'] === 'order')$class = 'navbar navbar-default navbar-inverse navbar-theme';
    }else if($options['page'] === 'insurance'){
        $menu = array('Home' => 'index.php','Discover' => '#discover-insurance','Blog' => '','Guide' => '','FAQs' => '');
        $class = 'navbar navbar-default navbar-inverse navbar-theme navbar-theme-abs navbar-theme-transparent navbar-theme-border';
        if($options['subpage'] === 'results')$class = 'navbar navbar-default navbar-inverse navbar-theme navbar-full';
        if($options['subpage'] === 'order')$class = 'navbar navbar-default navbar-inverse navbar-theme';
    }else if($options['page'] === 'finance'){
        $menu = array('Home' => 'index.php','Discover' => '#discover-finance','Blog' => '','Guide' => '','FAQs' => '');
        $class = 'navbar navbar-default navbar-inverse navbar-theme navbar-theme-abs navbar-theme-transparent navbar-theme-border';
        if($options['subpage'] === 'results')$class = 'navbar navbar-default navbar-inverse navbar-theme navbar-full';
        if($options['subpage'] === 'order')$class = 'navbar navbar-default navbar-inverse navbar-theme';
    }else if($options['page'] === 'wedding'){
        $menu = array('Home' => 'index.php','Search' => 'results.php','Blog' => '','Guide' => '','FAQs' => '');
        $class = 'navbar navbar-default navbar-inverse navbar-theme navbar-theme-abs navbar-theme-transparent navbar-theme-border';
        if($options['subpage'] === 'listing')$class = 'navbar navbar-default navbar-inverse navbar-primary navbar-theme';
    }else if($options['page'] === 'travel'){
        $menu = array('Home' => 'index.php','Search' => 'results.php','Blog' => '','Guide' => '','FAQs' => '');
        $class = 'navbar navbar-default navbar-inverse navbar-theme navbar-theme-abs navbar-theme-transparent navbar-theme-border';
        if($options['subpage'] === 'listing')$class = 'navbar navbar-default navbar-inverse navbar-primary navbar-theme';
    }else if($options['page'] === 'hotel'){
        $menu = array('Home' => 'index.php','Search' => 'results.php','Blog' => '','Guide' => '','FAQs' => '');
        $class = 'navbar navbar-default navbar-theme';
        if($options['subpage'] === 'listing')$class = 'navbar navbar-default navbar-inverse navbar-primary navbar-theme';
    }else if($options['page'] === 'user'){
        if($options['subpage'] === 'home' || $options['subpage'] === 'signup' || $options['subpage'] === 'signin' || $options['subpage'] === 'reset'){
            $menu = array('Home' => '../', 'Register' => 'signup.php','Log in' => 'signin.php');
        }else{
            $menu = array('Profile' => 'account.php','Notifications' => 'notifications.php','History' => 'history.php');
        }
        $class = 'navbar navbar-default navbar-inverse navbar-theme';
        if($options['subpage'] === 'signup' || $options['subpage'] === 'signin' || $options['subpage'] === 'reset')$class = "navbar navbar-default navbar-inverse navbar-theme navbar-theme-abs navbar-theme-transparent navbar-theme-border";
    }else if($options['page'] === 'order'){
        $menu = array('Home' => 'index.php','Search' => 'results.php','Blog' => '','Guide' => '','FAQs' => '');
        $class = 'navbar navbar-default navbar-inverse navbar-theme navbar-theme-abs navbar-theme-transparent navbar-theme-border';
        if($options['subpage'] === 'results')$class = 'navbar navbar-default navbar-theme';
        if($options['subpage'] === 'payment' || $options['subpage'] === 'order')$class = 'navbar navbar-default navbar-inverse navbar-theme';
    }

    $navigation = '';
    foreach($menu as $key => $value){
        $active = false;
        $txt = '';
        //Sections
        if($value === 'index.php' && $options['subpage'] === 'index')$active = true;
        else if($value == 'results.php' && $options['subpage'] === 'results')$active = true;

        //User
        if($value === 'signup.php' && $options['subpage'] === 'signup')$active = true;
        else if($value == 'signin.php' && $options['subpage'] === 'signin')$active = true;

        $txt = $active === true ? 'active' : '';
        $navigation .= <<<EOT
            <li class="dropdown {$txt}">
                <a class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" href="{$value}">{$key}</a>
            </li>
EOT;
    }




    //Account
    if(isset($user_id) && $user_id > 0){
        $account = array('Profile' => 'account.php','Notifications' => 'notifications.php','History' => 'history.php','Sign Out' => 'signout.php');
    }else{
        $account = array('Home' => '../', 'Register' => 'signup.php', 'Log in' => 'signin.php',);
    }
    $account_list = '';
    foreach($account as $key => $value){
        $active = '';
        if($key == 'Profile' && $options['subpage'] === 'account')$active = ' class="active"';
        if($key == 'Notifications' && $options['subpage'] === 'notifications')$active = ' class="active"';
        if($key == 'History' && $options['subpage'] === 'history')$active = ' class="active"';
        if($key == 'Home' && $options['subpage'] === 'home')$active = ' class="active"';
        if($key == 'Register' && $options['subpage'] === 'signup')$active = ' class="active"';
        if($key == 'Log in' && $options['subpage'] === 'signin')$active = ' class="active"';
        $account_list .= <<<EOT
            <li{$active}>
                <a href="../user/{$value}">{$key}</a>
            </li>
EOT;
    }




    //Currency
    $text = array('NGN' => 'Naira','GBP' => 'Pound Sterling','EUR' => 'Euro', 'USD' => 'U.S. dollar', 'GHC' => 'Ghanian Cedis');
    $symbols = array('NGN' => '₦','GBP' => '£','EUR' => '€', 'USD' => '$', 'GHC' => '¢');
    $currency_list = '';

    //NGN (Naira) must come first in the list
    uksort($_result['currency'],function($a, $b){
        if($a == 'NGN')return 1;
    });
    $_result['currency'] = array_reverse($_result['currency'], false);

    foreach($_result['currency'] as $key => $value){
        $active = '';
        if($_user['currency'] === $key)$active = ' active';
        $currency_list .= <<<EOT
            
            <div class="col-md-3">
                <ul class="dropdown-meganav-select-list-currency">
                    <li class="currency-select {$active}" data-code="{$key}">
                        <a href="#">
                            <span>{$symbols[$key]}</span>{$text[$key]}
                        </a>
                    </li>
                </ul>
            </div>
EOT;
    }

    $link = $options['page'] === 'order' ? '' : '../';

    echo
    <<<EOT
    <nav class="{$class}" id="main-nav">
        <div class="container">
            <div class="navbar-inner nav">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" data-target="#navbar-main" data-toggle="collapse" type="button" area-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="" style="display:flex;flex-direction:row;">
                    <img src="{$link}img/logo_big.png" alt="Image Alternative text" title="Image Title"/>
                    <span style="margin-left:10px;font-size:17px;font-weight:600;">Moneymatters</span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-main">
                <ul class="nav navbar-nav" style="margin-left:20%;">
                    {$navigation}
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="_desk-h">Currency</span>
                    <b id="default-currency">{$_user['currency']}</b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xxl">
                    <h5 class="dropdown-meganav-select-list-title">All Currencies</h5>
                    <div class="row" data-gutter="10">
                        {$currency_list}
                    </div>
                    </div>
                </li>
                
                <li class="navbar-nav-item-user dropdown">
                    <a class="dropdown-toggle" href="../user/account.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle-o navbar-nav-item-user-icon"></i> Account
                    </a>
                    <ul class="dropdown-menu">
                        {$account_list}
                    </ul>
                </li>
                </ul>
            </div>
            </div>
        </div>
        </nav>

EOT;
?>

<script>
    //CURRENCY
    setTimeout(function(){
        //₦
        var currency = <?php echo json_encode($_result['currency'])?>;
        var symbols = {"GBP": "£", "EUR": "€", "NGN": "₦", "USD": "$"};
        $('.currency-select').click(function(){
            var code = $(this).data('code');

            //If it's conversion doesn't exist or is active exit;
            if(typeof currency[code] == 'undefined' || $(this).hasClass('active'))return;
            
            $('.currency-select').removeClass('active');
            $(this).addClass('active');

            $('#default-currency').text(code);
            
            $('.currency-symbol').text(symbols[code]);
            $('.currency-value').each(function(){

                var value = $(this).data('value');
                var rate = currency[code];

                //Note that all currencies are entered in Naira so rate is always in Naira
                //Convert to USD
                var newValue = value / currency['NGN'];
                if(code != 'USD'){
                    //Convert to code
                    newValue = newValue * currency[code];
                }
                
                $(this).text(newValue.toFixed(2));
            });

            //Change the default currency on the account
            var data = {type: 'upload', command: 'edit', id: 'account'};
            data['currency'] = code;
            
            var formdata = new FormData();
            for(var key in data)
            formdata.append(key,data[key]);

            $.ajax({url: '../user/action.php',data: formdata,
                method:'POST',
                dataType:"json",
                success:function(res,status,xhr){
                    console.log(res);
                },
                error:function(res,status,xhr){
                    console.log(res.responseText);
                },
                contentType: false,
                processData: false
            });
        });
    },100);
</script>




