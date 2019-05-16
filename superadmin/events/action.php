<?php

    require_once('../../database.php');

    if(isset($_POST['command']) && !empty($_POST['command']) ){

        $command = mysqli_real_escape_string($database,$_POST['command']);
        $type = mysqli_real_escape_string($database,$_POST['type']);
        $id = mysqli_real_escape_string($database,$_POST['id']);
        $data = array();
        if(isset($_POST['data']))
        foreach($_POST['data'] as $key => $value)
        $data[$key] = mysqli_real_escape_string($database,$_POST['data'][$key]);
        
        if($type == 'event' || $type == 'vendor'){
            if($command == 'switch'){
                $status = ($data['currentStatus'] == 'true') ? 1 : 0;
                $sql = "UPDATE `".$type."` SET `status` = '".$status."' WHERE `".$type."_id` = '".$id."'";
                $data = '{"currentStatus":'.$status.'}';
            }else if($command == 'delete'){
                $sql = "UPDATE `".$type."` SET `status` = '-1' WHERE `".$type."_id` = '".$id."'";
                $data = '{}';
            }

            $query = mysqli_query($database,$sql);
            $num = mysqli_affected_rows($database);
            echo mysqli_error($database);
            if($num > 0){
                echo '{"success":true,"message":"The operation was successful.","data":'.$data.'}';
            }else{
                echo '{"success":false,"message":"The operation was unsuccessful.","data":null}';
            }
        }else if($type == 'upload'){
            if($command == 'create' && $id == 'event'){
                if(isset($_FILES['pictures']) && !empty($_FILES['pictures'])
                && isset($_POST['vendor']) && !empty($_POST['vendor']) && is_numeric($_POST['vendor'])
                && isset($_POST['category']) && !empty($_POST['category']) && json_decode($_POST['category'],true) !== null
                && isset($_POST['title']) && !empty($_POST['title'])
                && isset($_POST['description']) && !empty($_POST['description'])
                && isset($_POST['time']) && !empty($_POST['time']) && strtotime($_POST['time']) !== false
                && isset($_POST['guests']) && !empty($_POST['guests']) && is_numeric($_POST['guests'])
                && isset($_POST['price']) && /*!empty($_POST['price']) &&*/ is_numeric($_POST['price'])
                && isset($_POST['duration']) && !empty($_POST['duration']) && is_numeric($_POST['duration'])
                && isset($_POST['country']) && !empty($_POST['country'])
                && isset($_POST['state']) && !empty($_POST['state'])
                && isset($_POST['city']) && !empty($_POST['city'])
                && isset($_POST['district']) && !empty($_POST['district'])
                && isset($_POST['address']) && !empty($_POST['address'])){
                    
                    $vendor = mysqli_real_escape_string($database,$_POST['vendor']);
                    $category = mysqli_real_escape_string($database,$_POST['category']);
                    $title = mysqli_real_escape_string($database,$_POST['title']);
                    $description = mysqli_real_escape_string($database,$_POST['description']);
                    $time = mysqli_real_escape_string($database,date("Y-m-d G:i:s", strtotime($_POST['time'])));
                    $guests = mysqli_real_escape_string($database,$_POST['guests']);
                    $price = mysqli_real_escape_string($database,$_POST['price']);
                    $duration = mysqli_real_escape_string($database,$_POST['duration']);
                    $country = mysqli_real_escape_string($database,$_POST['country']);
                    $state = mysqli_real_escape_string($database,$_POST['state']);
                    $city = mysqli_real_escape_string($database,$_POST['city']);
                    $district = mysqli_real_escape_string($database,$_POST['district']);
                    $full_address = mysqli_real_escape_string($database,$_POST['address']);
                    
                    $filename = '../../vendor/storage/'.$vendor;
                    if(!is_dir($filename))
                    mkdir($filename);
                    
                    $pictures = array();
                    foreach($_FILES['pictures']['name'] as $i => $value){
                        $extension = 'png';
                        $type = $_FILES['pictures']['type'][$i];
                        if($type != 'image/png' && $type != 'image/jpeg' && $type != 'image/jpg'){
                            exit('{"success":false,"message":"The file type for images must be \"png\" or \"jp(e)g\""}');
                        }else{
                            if($type == 'image/png')$extension = 'png';
                            if($type == 'image/jpeg')$extension = 'jpg';
                            if($type == 'image/jpg')$extension = 'jpg';
                        }
                        
                        $size = $_FILES['pictures']['size'][$i];
                        if($size > 153600)
                        exit('{"success":false,"message":"The maximum size for an image file is 150KB."}');
                        
                        if(move_uploaded_file($_FILES['pictures']['tmp_name'][$i],$filename.'/'.time().'.'.$extension)){
                            array_push($pictures,'../vendor/storage/'.$vendor.'/'.time().'.'.$extension);
                        }else{
                            exit('{"success":false,"message":"An error occurred. Try again."}');
                        }
                    }
                    $pictures = mysqli_real_escape_string($database,json_encode($pictures));
                    
                    $sql = "INSERT INTO `".$id."`(`vendor_id`,`category`,`pictures`,`title`,`description`,`time`,`guests`,`price`,`duration`,`country`,`state`,`city`,`district`,`full_address`,`views`,`status`,`date`) VALUES('$vendor','$category','$pictures','$title','$description','$time','$guests','$price','$duration','$country','$state','$city','$district','$full_address','0','0',NOW())";
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