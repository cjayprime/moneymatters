<?php

    require_once('../database.php');

    if(isset($_POST['command']) && !empty($_POST['command']) ){

        $command = mysqli_real_escape_string($database,$_POST['command']);
        $type = mysqli_real_escape_string($database,$_POST['type']);
        $id = mysqli_real_escape_string($database,$_POST['id']);
        
        if($type == 'notifications'){
            if($command == 'switch' && (isset($_POST['currentStatus']) && !empty($_POST['currentStatus'])) && (isset($_POST['id']) && !empty($_POST['id']))){
                $status = ($_POST['currentStatus'] == 'true') ? 1 : 0;
                
                $sql = "SELECT `notifications` FROM `user` WHERE (`user_id` = '$user_id')";
                $query = mysqli_query($database,$sql);
                $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
                $notifications = json_decode($result['notifications'],true);
                $notifications[$id] = $status ? true : false;
                $notifications = json_encode($notifications);

                $sql = "UPDATE `user` SET `notifications` = '".$notifications."' WHERE (`user_id` = '$user_id')";
                $data = '{"currentStatus":'.$status.'}';
                $query = mysqli_query($database,$sql);
                $num = mysqli_affected_rows($database);
                echo mysqli_error($database);
                if($num > 0){
                    echo '{"success":true,"message":"The operation was successful.","data":'.$data.'}';
                }else{
                    echo '{"success":false,"message":"The operation was unsuccessful.","data":null}';
                }
            }
        }else if($type == 'upload'){
            if($command == 'edit' && $id == 'account'){
                if((isset($_FILES['profilepicture']) && !empty($_FILES['profilepicture']))
                || (isset($_POST['firstname']) && !empty($_POST['firstname']))
                || (isset($_POST['lastname']) && !empty($_POST['lastname']))
                || (isset($_POST['othernames']) && !empty($_POST['othernames']))
                || (isset($_POST['password']) && !empty($_POST['password']))
                || (isset($_POST['email']) && !empty($_POST['email']))
                || (isset($_POST['phone']) && !empty($_POST['phone']))
                || (isset($_POST['currency']) && !empty($_POST['currency']))){
                    
                    if(isset($_FILES['profilepicture']) && !empty($_FILES['profilepicture'])){
                        
                        $column = 'profile_picture';
                        $filename = 'storage/'.$vendor_id;
                        if(!is_dir($filename))
                        mkdir($filename);
                        
                        $pictures = '';
                        $extension = 'png';
                        $type = $_FILES['profilepicture']['type'];
                        if($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/jpg'){
                            exit('{"success":false,"message":"The file type for images must be \"png\" or \"jp(e)g\""}');
                        }else{
                            if($type == 'image/png')$extension = 'png';
                            if($type == 'image/jpeg')$extension = 'jpg';
                            if($type == 'image/jpg')$extension = 'jpg';
                        }
                        
                        $size = $_FILES['profilepicture']['size'];
                        if($size > 153600)
                        exit('{"success":false,"message":"The maximum size for an image file is 150KB."}');
                        
                        if(move_uploaded_file($_FILES['profilepicture']['tmp_name'],$filename.'/'.time().'.'.$extension)){
                            $pictures = 'storage/'.$vendor_id.'/'.time().'.'.$extension;
                        }else{
                            exit('{"success":false,"message":"An error occurred. Try again."}');
                        }

                        $value = $pictures;
                    }else if(isset($_POST['firstname']) && !empty($_POST['firstname'])){
                        $column = 'first_name';
                        $value = mysqli_real_escape_string($database,$_POST['firstname']);
                    }else if(isset($_POST['lastname']) && !empty($_POST['lastname'])){
                        $column = 'last_name';
                        $value = mysqli_real_escape_string($database,$_POST['lastname']);
                    }else if(isset($_POST['othernames']) && !empty($_POST['othernames'])){
                        $column = 'other_names';
                        $value = mysqli_real_escape_string($database,$_POST['othernames']);
                    }else if(isset($_POST['password']) && !empty($_POST['password'])){
                        $column = 'password';
                        $value = mysqli_real_escape_string($database,$_POST['password']);
                    }else if(isset($_POST['email']) && !empty($_POST['email'])){
                        $column = 'email';
                        $value = mysqli_real_escape_string($database,$_POST['email']);
                    }else if(isset($_POST['phone']) && !empty($_POST['phone'])){
                        $column = 'phone';
                        $value = mysqli_real_escape_string($database,$_POST['phone']);
                    }else if(isset($_POST['currency']) && !empty($_POST['currency'])){
                        $column = 'currency';
                        $value = mysqli_real_escape_string($database,$_POST['currency']);
                    }
                    
                    $sql = "UPDATE `user` SET `$column` = '$value' WHERE (`user_id` = '$user_id')";
                    $data = '{}';
                }else{
                    exit( '{"success":false,"message":"Bad request.","data":null}' );
                }
            }else if($command == 'create' && $id == 'account'){
                if((isset($_POST['firstname']) && !empty($_POST['firstname']))
                && (isset($_POST['lastname']) && !empty($_POST['lastname']))
                && (isset($_POST['othernames']) && !empty($_POST['othernames']))
                && (isset($_POST['password']) && !empty($_POST['password']))
                && (isset($_POST['email']) && !empty($_POST['email']))
                && (isset($_POST['phone']) && !empty($_POST['phone']))){
                    //Sign up
                    
                    $firstname = mysqli_real_escape_string($database,$_POST['firstname']);
                    $lastname = mysqli_real_escape_string($database,$_POST['lastname']);
                    $othernames = mysqli_real_escape_string($database,$_POST['othernames']);
                    $password = mysqli_real_escape_string($database,$_POST['password']);
                    $email = mysqli_real_escape_string($database,$_POST['email']);
                    $phone = mysqli_real_escape_string($database,$_POST['phone']);
                    $notifications = '{"deals": false, "offers": false, "survey": false, "reminders": false, "announcements": false, "recommendations": false}';

                    $sql = "INSERT INTO `user`(`profile_picture`,`first_name`,`last_name`,`other_names`,`password`,`email`,`phone`,`currency`,`notifications`,`status`,`date`) VALUES('../img/48x48.png','$firstname','$lastname','$othernames',MD5('$password'),'$email','$phone','NGN','$notifications','1',NOW())";
                    $data = '{}';
                }else{
                    exit( '{"success":false,"message":"Bad request.","data":null}' );
                }
            }else if($command == 'confirm' && $id == 'account'){
                if((isset($_POST['email']) && !empty($_POST['email']))
                && (isset($_POST['password']) && !empty($_POST['password']))){
                    //Sign in
                    
                    $email = mysqli_real_escape_string($database,$_POST['email']);
                    $password = mysqli_real_escape_string($database,$_POST['password']);
                    
                    $sql = "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = MD5('$password') LIMIT 1";
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
                    $sql = "SELECT * FROM `reset` WHERE `type` = 'user' AND `reset_id` = '$verify' AND `identification` = '$code' AND `used` = '0' LIMIT 1";
                    $data = '{}';
                }else{
                    exit( '{"success":false,"message":"Bad request.","data":null}' );
                }
            }else if($command == 'create-reset' && $id == 'account'){
                if(isset($_POST['email']) && !empty($_POST['email'])){
                    //Reset Password
                    
                    $email = mysqli_real_escape_string($database,$_POST['email']);
                    $sql = "SELECT * FROM `user` WHERE `email` = '$email' LIMIT 1";
                    $data = '{}';
                }else{
                    exit( '{"success":false,"message":"Bad request.","data":null}' );
                }
            }else{
                exit( '{"success":false,"message":"Bad request.","data":null}' );
            }

            $query = mysqli_query($database,$sql);
            $num = mysqli_affected_rows($database);
            echo mysqli_error($database);
            if($num > 0){
                if($command == 'create' && $id == 'account'){
                    session_unset();
                    $_SESSION = array();
                    $_SESSION['type'] = 'user';
                    $_SESSION['identification'] = $id = mysqli_insert_id($database);
                }else if($command == 'confirm' && $id == 'account'){
                    session_unset();
                    $_SESSION = array();
                    $_SESSION['type'] = 'user';
                    $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
                    $_SESSION['identification'] = $rows['user_id'];
                }else if($command == 'reset' && $id == 'account'){
                    session_unset();
                    $_SESSION = array();

                    $rows = mysqli_fetch_array($query,MYSQLI_ASSOC);
                    $email = $rows['email'];
                    $sql = "UPDATE `reset` SET `used` = '1' WHERE `reset_id` = '$verify' AND `type` = 'admin' AND `identification` = '$code' LIMIT 1";
                    $query = mysqli_query($database,$sql);
                    $num = mysqli_affected_rows($database);

                    $password = mysqli_real_escape_string($database,$_POST['password']);
                    $sql = "UPDATE `user` SET `password` = MD5('$password') WHERE `email` = '$email' LIMIT 1";
                    $query = mysqli_query($database,$sql);
                    $num = mysqli_affected_rows($database);
                }else if($command == 'create-reset' && $id == 'account'){
                    session_unset();
                    $_SESSION = array();
                    
                    $sql = "INSERT INTO `reset`(`email`,`type`,`identification`,`used`,`date`) VALUES('$email','user','','0',NOW())";//" AND `timeout` - NOW() > 2";
                    $query = mysqli_query($database,$sql);
                    
                    $id = mysqli_insert_id($database);
                    $sql = "UPDATE `reset` SET `identification` = '".md5(md5($id))."' WHERE `reset_id` = '$id' LIMIT 1";
                    $query = mysqli_query($database,$sql);
                    $num = mysqli_affected_rows($database);
                    if($num > 0){
                        //Email the identification here
                    }
                }

                if(!isset($id))$id = mysqli_insert_id($database);
                
                echo '{"success":true,"message":"The operation was successful.","data":{"id":"'.$id.'"}}';
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