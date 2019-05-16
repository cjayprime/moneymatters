<?php

    require_once('../../database.php');

    if(isset($_POST['command']) && !empty($_POST['command']) ){

        $command = mysqli_real_escape_string($database,$_POST['command']);
        $type = mysqli_real_escape_string($database,$_POST['type']);
        $id = mysqli_real_escape_string($database,$_POST['id']);
        
        if($type == 'upload'){
            if($command == 'edit' && $id == 'account'){
                if(isset($_FILES['pictures']) && !empty($_FILES['pictures'])
                && isset($_POST['password']) && !empty($_POST['password'])
                && isset($_POST['email']) && !empty($_POST['email'])
                && isset($_POST['phone']) && !empty($_POST['phone'])
                && isset($_POST['businessname']) && !empty($_POST['businessname'])
                && isset($_POST['businessaddress']) && !empty($_POST['businessaddress'])){
                    
                    $password = mysqli_real_escape_string($database,$_POST['password']);
                    $email = mysqli_real_escape_string($database,$_POST['email']);
                    $phone = mysqli_real_escape_string($database,$_POST['phone']);
                    $businessname = mysqli_real_escape_string($database,$_POST['businessname']);
                    $businessaddress = mysqli_real_escape_string($database,$_POST['businessaddress']);
                    
                    $filename = '../../vendor/storage/'.$vendor_id;
                    if(!is_dir($filename))
                    mkdir($filename);
                    
                    $pictures = '';//array();
                    //foreach($_FILES['pictures']['name'] as $i => $value){
                        $extension = 'png';
                        $type = $_FILES['pictures']['type'][0];
                        if($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/jpg'){
                            exit('{"success":false,"message":"The file type for images must be \"png\" or \"jp(e)g\""}');
                        }else{
                            if($type == 'image/png')$extension = 'png';
                            if($type == 'image/jpeg')$extension = 'jpg';
                            if($type == 'image/jpg')$extension = 'jpg';
                        }
                        
                        $size = $_FILES['pictures']['size'][0];
                        if($size > 153600)
                        exit('{"success":false,"message":"The maximum size for an image file is 150KB."}');
                        
                        if(move_uploaded_file($_FILES['pictures']['tmp_name'][0],$filename.'/'.time().'.'.$extension)){
                            $pictures = '../vendor/storage/'.$vendor_id.'/'.time().'.'.$extension;
                        }else{
                            exit('{"success":false,"message":"An error occurred. Try again."}');
                        }
                    //}
                    //$pictures = mysqli_real_escape_string($database,json_encode($pictures));
                    
                    $sql = "UPDATE `vendor` SET `email` = '$email',`password` = '$password',`phone` = '$phone',`business_name` = '$businessname',`business_address` = '$businessaddress',`business_logo` = '$pictures' WHERE (`vendor_id` = '$vendor_id')";
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