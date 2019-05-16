<?php

    require_once('../database.php');

    if(isset($_POST['command']) && !empty($_POST['command']) ){

        $command = mysqli_real_escape_string($database,$_POST['command']);
        $type = mysqli_real_escape_string($database,$_POST['type']);
        $id = mysqli_real_escape_string($database,$_POST['id']);
        
        if($type == 'upload'){
            if($command == 'confirm' && $id == 'account'){
                if(isset($_POST['access']) && !empty($_POST['access']) && isset($_POST['email']) && !empty($_POST['email'])){
                    //Sign in
                    
                    $access = mysqli_real_escape_string($database,$_POST['access']);
                    $email = mysqli_real_escape_string($database,$_POST['email']);
                    $sql = "SELECT * FROM `admin` WHERE `email` = '$email' AND `password` = MD5('$access')";
                    $data = '{}';
                }else{
                    exit( '{"success":false,"message":"Bad request.","data":null}' );
                }
            }else if($command == 'reset' && $id == 'account'){
                if(isset($_POST['verify']) && !empty($_POST['verify']) && isset($_POST['code']) && !empty($_POST['code']) && isset($_POST['password']) && !empty($_POST['password'])){
                    //Reset Password
                    
                    $verify = mysqli_real_escape_string($database,$_POST['verify']);
                    $code = mysqli_real_escape_string($database,$_POST['code']);
                    $sql = "SELECT * FROM `reset` WHERE `type` = 'admin' AND `reset_id` = '$verify' AND `identification` = '$code' AND `used` = '0' LIMIT 1";//" AND `timeout` - NOW() > 2";
                    $data = '{}';
                }else{
                    exit( '{"success":false,"message":"Bad request.","data":null}' );
                }
            }else if($command == 'create-reset' && $id == 'account'){
                if(isset($_POST['email']) && !empty($_POST['email'])){
                    //Reset Password
                    
                    $email = mysqli_real_escape_string($database,$_POST['email']);
                    $sql = "SELECT * FROM `admin` WHERE `email` = '$email' LIMIT 1";
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
                if($command == 'confirm' && $id == 'account'){
                    session_unset();
                    $_SESSION = array();
                    $_SESSION['type'] = 'admin';
                    $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
                    $_SESSION['identification'] = $rows['admin_id'];
                }else if($command == 'reset' && $id == 'account'){
                    session_unset();
                    $_SESSION = array();

                    $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
                    $email = $rows['email'];
                    $sql = "UPDATE `reset` SET `used` = '1' WHERE `reset_id` = '$verify' AND `type` = 'admin' AND `identification` = '$code' LIMIT 1";
                    $query = mysqli_query($database,$sql);
                    $num = mysqli_affected_rows($database);

                    $password = mysqli_real_escape_string($database,$_POST['password']);
                    $sql = "UPDATE `admin` SET `password` = MD5('$password') WHERE `email` = '$email' LIMIT 1";
                    $query = mysqli_query($database,$sql);
                    $num = mysqli_affected_rows($database);
                }else if($command == 'create-reset' && $id == 'account'){
                    session_unset();
                    $_SESSION = array();
                    
                    $sql = "INSERT INTO `reset`(`email`,`type`,`identification`,`used`,`date`) VALUES('$email','admin','','0',NOW())";//" AND `timeout` - NOW() > 2";
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