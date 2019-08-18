<?php

  session_start();

  $database = mysqli_connect("localhost","root","","moneymatters");
  $keys = array(
		"event" => array(
			"private" => "sk_test_f297e77cc33efa13944852c47667cfdb8adab885",
			"public" => "pk_test_1c73170aa1a7fd25332b241b40b41484c698ebae"
    ),
		"property" => array(
			"private" => "sk_test_f297e77cc33efa13944852c47667cfdb8adab885",
			"public" => "pk_test_1c73170aa1a7fd25332b241b40b41484c698ebae"
    ),
		"insurance" => array(
			"private" => "sk_test_f297e77cc33efa13944852c47667cfdb8adab885",
			"public" => "pk_test_1c73170aa1a7fd25332b241b40b41484c698ebae"
		),
		"finance" => array(
			"private" => "sk_test_f297e77cc33efa13944852c47667cfdb8adab885",
			"public" => "pk_test_1c73170aa1a7fd25332b241b40b41484c698ebae"
		)
  );
  
  $admin_id = 0;
  $vendor_id = 0;
  $user_id = 0;


  //If currently on any admin, vendor or user page
  if((basename(dirname($_SERVER['PHP_SELF'])) === 'admin' || basename(dirname(dirname($_SERVER['PHP_SELF']))) === 'admin')
  || (basename(dirname($_SERVER['PHP_SELF'])) === 'vendor' || basename(dirname(dirname($_SERVER['PHP_SELF']))) === 'vendor')
  || (basename(dirname($_SERVER['PHP_SELF'])) === 'user' || basename(dirname(dirname($_SERVER['PHP_SELF']))) === 'user')){
    //Running action.php is restricted because of the signup pages
    
    //If currently on any admin page
    if((basename(dirname($_SERVER['PHP_SELF'])) === 'admin' || basename(dirname(dirname($_SERVER['PHP_SELF']))) === 'admin')
    && basename($_SERVER['PHP_SELF']) != 'signup.php'
    && basename($_SERVER['PHP_SELF']) != 'signin.php'
    && basename($_SERVER['PHP_SELF']) != 'signout.php'
    && basename($_SERVER['PHP_SELF']) != 'action.php'){
      
      if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin' && isset($_SESSION['identification']) && $_SESSION['identification'] > 0){
        //This is basically useless
        $admin_id = $_SESSION['identification'];
      }else{
        if(basename(dirname($_SERVER['PHP_SELF'])) === 'admin')
        header('Location: ../admin/signin.php');
        if(basename(dirname(dirname($_SERVER['PHP_SELF']))) === 'admin')
        header('Location: ../signin.php');
      }
    
    }
    
    //If currently on any vendor page
    else if((basename(dirname($_SERVER['PHP_SELF'])) === 'vendor' || basename(dirname(dirname($_SERVER['PHP_SELF']))) === 'vendor')
    && basename($_SERVER['PHP_SELF']) != 'signup.php'
    && basename($_SERVER['PHP_SELF']) != 'signin.php'
    && basename($_SERVER['PHP_SELF']) != 'signout.php'
    && basename($_SERVER['PHP_SELF']) != 'action.php'){
    
      if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == 'vendor' && isset($_SESSION['identification']) && $_SESSION['identification'] > 0){
        $vendor_id = $_SESSION['identification'];
      }else{
        if(basename(dirname($_SERVER['PHP_SELF'])) === 'vendor')
        header('Location: ../vendor/signin.php');
        if(basename(dirname(dirname($_SERVER['PHP_SELF']))) === 'vendor')
        header('Location: ../signin.php');
      }
    
    }

    //If currently on any user page
    else if(basename(dirname($_SERVER['PHP_SELF'])) === 'user'
    && basename($_SERVER['PHP_SELF']) != 'signup.php'
    && basename($_SERVER['PHP_SELF']) != 'signin.php'
    && basename($_SERVER['PHP_SELF']) != 'signout.php'
    && basename($_SERVER['PHP_SELF']) != 'action.php'
    && basename($_SERVER['PHP_SELF']) != 'reset.php'){
      //I can't ban action.php because `/user/action.php` needs it
      
      if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == 'user' && isset($_SESSION['identification']) && $_SESSION['identification'] > 0){
        $user_id = $_SESSION['identification'];
      }else{
        if(basename(dirname($_SERVER['PHP_SELF'])) === 'user')
        header('Location: ../user/signin.php');
        if(basename(dirname(dirname($_SERVER['PHP_SELF']))) === 'user')
        header('Location: ../signin.php');
      }
    
    }

    //If a request is made with the HTTP_REFERRER as user this section runs and must have a $user_id
    else if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == 'user' && isset($_SESSION['identification']) && $_SESSION['identification'] > 0){
      $user_id = $_SESSION['identification'];
    }    
    
    //If all fails
    else if(basename($_SERVER['PHP_SELF']) != 'signup.php'
    && basename($_SERVER['PHP_SELF']) != 'signin.php'
    && basename($_SERVER['PHP_SELF']) != 'signout.php'
    && basename($_SERVER['PHP_SELF']) != 'action.php'
    && basename($_SERVER['PHP_SELF']) != 'reset.php'){
      header('Location: signin.php');
    }
  }
  
  //If on properties and others give session
  else if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type'] == 'user' && isset($_SESSION['identification']) && $_SESSION['identification'] > 0){
    $user_id = $_SESSION['identification'];
  }

?>