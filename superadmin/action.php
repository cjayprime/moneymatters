<?php

    require_once('../database.php');

    if(isset($_POST['command']) && !empty($_POST['command']) ){

        $command = mysqli_real_escape_string($database,$_POST['command']);
        $type = mysqli_real_escape_string($database,$_POST['type']);
        $id = mysqli_real_escape_string($database,$_POST['id']);
        
        if($type == 'upload'){
            if($command == 'confirm' && $id == 'account'){
                if(isset($_POST['access']) && !empty($_POST['access'])){
                    //Sign in
                    
                    $access = mysqli_real_escape_string($database,$_POST['access']);
                    $sql = "SELECT * FROM `admin` WHERE `admin_id` = '7' AND `password` = MD5('$access')";
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