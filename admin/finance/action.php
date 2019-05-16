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
        
        if($type == 'finance' || $type == 'vendor'){
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
            if($command == 'create' && $id == 'finance'){
                
                if(isset($_POST['vendor']) && !empty($_POST['vendor']) && is_numeric($_POST['vendor'])
                && isset($_POST['product_type']) && !empty($_POST['product_type'])
                && isset($_POST['tenure']) && !empty($_POST['tenure']) && preg_match('/^[0-9]+/',$_POST['tenure'])
                && isset($_POST['value']) && !empty($_POST['value']) && is_numeric($_POST['value'])
                && isset($_POST['title']) && !empty($_POST['title'])
                && isset($_POST['tags']) && !empty($_POST['tags'])
                && isset($_POST['price']) && !empty($_POST['price']) && is_numeric($_POST['price'])
                && isset($_POST['description']) && !empty($_POST['description'])
                ){
                    
                    $vendor = mysqli_real_escape_string($database,$_POST['vendor']);
                    $product_type = mysqli_real_escape_string($database,$_POST['product_type']);
                    $tenure = mysqli_real_escape_string($database,$_POST['tenure']);
                    $value = mysqli_real_escape_string($database,$_POST['value']);
                    $title = mysqli_real_escape_string($database,$_POST['title']);
                    $tags = mysqli_real_escape_string($database,$_POST['tags']);
                    $price = mysqli_real_escape_string($database,$_POST['price']);
                    $description = mysqli_real_escape_string($database,$_POST['description']);
                    

                    $sql = "INSERT INTO `".$id."`(`vendor_id`,`type`,`tenure`,`value`,`title`,`tags`,`price`,`description`,`views`,`status`,`date`) VALUES('$vendor','$product_type','$tenure','$value','$title','$tags','$price','$description','0','0',NOW())";
                    $data = '{}';
                }else{
                    exit( '{"success":false,"message":"Bad request. Error Level 1.","data":null}' );
                }
            }else{
                exit( '{"success":false,"message":"Bad request. Error Level 2.","data":null}' );
            }

            $query = mysqli_query($database,$sql);
            $num = mysqli_affected_rows($database);
            echo mysqli_error($database);
            if($num > 0){
                echo '{"success":true,"message":"The operation was successful.","data":'.$data.'}';
            }else{
                echo '{"success":false,"message":"The operation was unsuccessful.","data":null}';
            }
        }else{
            echo '{"success":false,"message":"Bad request. Error Level 3.","data":null}';
        }

    }else{
        echo '{"success":false,"message":"Bad request. Error Level 4.","data":null}';
    }

?>