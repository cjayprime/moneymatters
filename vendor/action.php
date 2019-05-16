<?php

    require_once('../database.php');

    if(isset($_POST['command']) && !empty($_POST['command']) ){

        $command = mysqli_real_escape_string($database,$_POST['command']);
        $type = mysqli_real_escape_string($database,$_POST['type']);
        $id = mysqli_real_escape_string($database,$_POST['id']);
        
        if($type == 'upload'){
            if($command == 'create' && $id == 'account'){
                if(($_POST['vendortype'] == 'Finance' || $_POST['vendortype'] == 'Insurance' || $_POST['vendortype'] == 'Wedding' || $_POST['vendortype'] == 'Event' || $_POST['vendortype'] == 'Offer' || $_POST['vendortype'] == 'Property')
                && isset($_POST['password']) && !empty($_POST['password'])
                && isset($_POST['email']) && !empty($_POST['email'])
                && isset($_POST['phone']) && !empty($_POST['phone'])
                && isset($_POST['businessname']) && !empty($_POST['businessname'])
                && isset($_POST['businessaddress']) && !empty($_POST['businessaddress'])){
                    //Sign up
                    
                    $vendortype = mysqli_real_escape_string($database,strtolower($_POST['vendortype']));
                    $password = mysqli_real_escape_string($database,$_POST['password']);
                    $email = mysqli_real_escape_string($database,$_POST['email']);
                    $phone = mysqli_real_escape_string($database,$_POST['phone']);
                    $businessname = mysqli_real_escape_string($database,$_POST['businessname']);
                    $businessaddress = mysqli_real_escape_string($database,$_POST['businessaddress']);
                    $notifications = mysqli_real_escape_string($database,'[{"category":"admin","read":false,"date":"March 1st, 2018","content":"Welcome to Moneymatters"}]');

                    $sql = "INSERT INTO `vendor`(`type`,`business_name`,`business_logo`,`business_address`,`email`,`phone`,`password`,`notifications`,`status`,`date`) VALUES('$vendortype','$businessname','','$businessaddress','$email','$phone',MD5('$password'),'$notifications','1',NOW())";
                    $data = '{}';
                }else{
                    exit( '{"success":false,"message":"Bad request.","data":null}' );
                }
            }else if($command == 'confirm' && $id == 'account'){
                if(isset($_POST['email']) && !empty($_POST['email'])
                && isset($_POST['password']) && !empty($_POST['password'])){
                    //Sign in
                    
                    $password = mysqli_real_escape_string($database,$_POST['password']);
                    $email = mysqli_real_escape_string($database,$_POST['email']);
                    $sql = "SELECT * FROM `vendor` WHERE `email` = '$email' AND `password` = MD5('$password')";
                    $data = '{}';
                }else{
                    exit( '{"success":false,"message":"Bad request.","data":null}' );
                }
            }else if($command == 'reset' && $id == 'account'){
                if(isset($_POST['verify']) && !empty($_POST['verify']) && isset($_POST['code']) && !empty($_POST['code']) && isset($_POST['password']) && !empty($_POST['password'])){
                    //Reset Password
                    
                    $verify = mysqli_real_escape_string($database,$_POST['verify']);
                    $code = mysqli_real_escape_string($database,$_POST['code']);
                    $password = mysqli_real_escape_string($database,$_POST['password']);
                    $sql = "SELECT * FROM `reset` WHERE `type` = 'vendor' AND `reset_id` = '$verify' AND `identification` = '$code' AND `used` = '0' LIMIT 1";
                    $data = '{}';
                }else{
                    exit( '{"success":false,"message":"Bad request.","data":null}' );
                }
            }else if($command == 'create-reset' && $id == 'account'){
                if(isset($_POST['email']) && !empty($_POST['email'])){
                    //Reset Password
                    
                    $email = mysqli_real_escape_string($database,$_POST['email']);
                    $sql = "SELECT * FROM `vendor` WHERE `email` = '$email' LIMIT 1";
                    $data = '{}';
                }else{
                    exit( '{"success":false,"message":"Bad request.","data":null}' );
                }
            }else{
                exit( '{"success":false,"message":"Bad request.","data":null}' );
            }

            $query = mysqli_query($database,$sql);
            $num = mysqli_affected_rows($database);
            //echo mysqli_error($database);
            if($num > 0){
                if($command == 'create' && $id == 'account'){
                    session_unset();
                    $_SESSION = array();
                    $_SESSION['type'] = 'vendor';
                    $_SESSION['identification'] = mysqli_insert_id($database);
                }else if($command == 'confirm' && $id == 'account'){
                    session_unset();
                    $_SESSION = array();
                    $_SESSION['type'] = 'vendor';
                    $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
                    $_SESSION['identification'] = $rows['vendor_id'];
                }else if($command == 'reset' && $id == 'account'){
                    session_unset();
                    $_SESSION = array();

                    $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
                    $email = $rows['email'];
                    $sql = "UPDATE `reset` SET `used` = '1' WHERE `reset_id` = '$verify' AND `type` = 'admin' AND `identification` = '$code' LIMIT 1";
                    $query = mysqli_query($database,$sql);
                    $num = mysqli_affected_rows($database);

                    $password = mysqli_real_escape_string($database,$_POST['password']);
                    $sql = "UPDATE `vendor` SET `password` = MD5('$password') WHERE `email` = '$email' LIMIT 1";
                    $query = mysqli_query($database,$sql);
                    $num = mysqli_affected_rows($database);
                }else if($command == 'create-reset' && $id == 'account'){
                    session_unset();
                    $_SESSION = array();
                    
                    $sql = "INSERT INTO `reset`(`email`,`type`,`identification`,`used`,`date`) VALUES('$email','vendor','','0',NOW())";//" AND `timeout` - NOW() > 2";
                    $query = mysqli_query($database,$sql);
                    
                    $id = mysqli_insert_id($database);
                    $sql = "UPDATE `reset` SET `identification` = '".md5(md5($id))."' WHERE `reset_id` = '$id' LIMIT 1";
                    $query = mysqli_query($database,$sql);
                    $num = mysqli_affected_rows($database);
                    if($num > 0){
                        //Email the identification here
                    }
                    $data = '{"verification":"'.$id.'"}';
                }
                echo '{"success":true,"message":"The operation was successful.","data":'.$data.'}';
            }else{
                echo '{"success":false,"message":"The operation was unsuccessful.","data":null}';
            }
        }else{
            echo '{"success":false,"message":"Bad request.","data":null}';
        }

    }else{
        echo '{"success":false,"message":"Bad request.","data":null}';
    }

?>