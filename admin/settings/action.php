<?php
    /**
     * The data type of every column in the admin table MUST be `JSON` 
     */
    require_once('../../database.php');

    if(isset($_POST['command']) && !empty($_POST['command']) ){

        $command = mysqli_real_escape_string($database,$_POST['command']);
        $id = mysqli_real_escape_string($database,$_POST['id']);
        
        if($command == 'edit'){
            
            $error = array();
            foreach($_POST['data'] as $key => $value){

                if($key == 'currency')
                    foreach($value as $_key => $_value)
                        if(!is_numeric($_value))
                        exit('{"success":false,"message":"Bad request. Currency must have a numeric value.","data":null}');
                
                if(!empty($_POST['data'][$key]) && json_encode($_POST['data'][$key],true) !== FALSE){
                    $datalist = mysqli_real_escape_string($database,json_encode($_POST['data'][$key],true));
                    
                    $sql = "UPDATE `admin` SET `".$key."` = '".$datalist."' WHERE `page` = '".$id."'";
                    $query = mysqli_query($database,$sql);
                    $num = mysqli_affected_rows($database);
                    
                    //echo mysqli_error($database);
                    if($num <= 0){
                        $append = '';
                        if($num == 0)$append = 'Add new options first.';
                        array_push($error,array('id' => $id, 'key' => $key, 'append' => $append));
                    }
                    
                }else{
                    exit('{"success":false,"message":"Bad request.","data":null}');
                }
            }
            
            if(count($error) < count($_POST['data'])){
                // If no error and data has only 1 element
                echo '{"success":true,"message":"The operation was successful.","data":null}';
            }else if(count($error) == count($_POST['data']) || count($_POST['data']) > 1){
                // If error is the same as data (means there were no changes) and data is more than 1
                echo '{"success":false,"message":"The operation was unsuccessful while adding to the '.$error[0]['key'].' of '.$error[0]['id'].'. '.$error[0]['append'].'","data":null}';
            }
        }else if($command == 'create-admin'){

            if(isset($_POST['data'])
            && isset($_POST['data']['email'])  && !empty($_POST['data']['email'])
            && isset($_POST['data']['password']) && isset($_POST['data']['password'])){
            
                $email = mysqli_real_escape_string($database,$_POST['data']['email']);
                $password = mysqli_real_escape_string($database,$_POST['data']['password']);
                $sql = "SELECT * FROM `admin` WHERE `email` = '$email'";
                $query = mysqli_query($database,$sql);
                $num = mysqli_affected_rows($database);
                    
                if($num == 0){
                    $sql = "INSERT INTO `admin`(`email`, `password`, `access`, `title`, `page`, `currency`, `country`, `symbol`, `images`, `category`, `type`, `amenities`, `facilities`, `rating`) VALUES('$email', md5('$password'), 'system', 'new-moneymatters', 'new-admin', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null')";
                    $query = mysqli_query($database,$sql);
                    $num = mysqli_affected_rows($database);
                    
                    if($num > 0){
                        echo '{"success":true,"message":"You have successfully added a new admin. The admin can now sign in.","data":null}';
                    }else{
                        exit('{"success":false,"message":"Bad request.","data":null}');
                    }
                }else{
                    exit('{"success":false,"message":"Admin email already exists.","data":null}');
                }
            }else{
                exit('{"success":false,"message":"Bad request.","data":null}');
            }
            
        }else{
            echo '{"success":false,"message":"Bad request.","data":null}';
        }

    }else{
        echo '{"success":false,"message":"Bad request.","data":null}';
    }

?>