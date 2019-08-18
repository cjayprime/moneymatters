<?php
	
	require_once('database.php');
	
	if( isset($_POST['command']) && $_POST['command'] == 'verify'
		&& isset($_POST['action']) && $_POST['action'] == 'record'
		&& isset($_POST['identification']) && !empty($_POST['identification']) 
		&& isset($_POST['type']) && !empty($_POST['type']) 
		&& isset($_POST['reference']) && !empty($_POST['reference']) ){
		
		$type = mysqli_real_escape_string($database, $_POST['type']);
		$reference = mysqli_real_escape_string($database, $_POST['reference']);
		$identification = mysqli_real_escape_string($database, $_POST['identification']);
		
		//The parameter after verify/ is the transaction reference to be verified
		$url = 'https://api.paystack.co/transaction/verify/'.$reference;
		
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$keys[$type]['private']) );
		curl_setopt( $ch, CURLOPT_CAINFO, __DIR__.'/cacert-2019-05-15.pem');
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, '2');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, '1'); 
		$request = curl_exec($ch);
		if(curl_error($ch)){
			echo 'error:' . curl_error($ch);
		}
		curl_close($ch);
		
		$result = array();
		if ($request) {
		  $result = json_decode($request, true);
		}
		
		if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
			
			// Perform necessary save action
			if($_POST['action'] == 'record'){
				
				mysqli_query($database, "SET AUTOCOMMIT=0");
				mysqli_query($database, "START TRANSACTION");

				//Retreive the vendor id
				$sql = "SELECT `vendor_id` FROM `".$type."` WHERE `".$type."_id` = '$identification'";
				$query = mysqli_query($database, $sql);
				$num = mysqli_num_rows($query);
				$vendor_id = 0;
				if($num > 0){
					$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
					$vendor_id = $row['vendor_id'];
				}

				//Save payment record
				$sql = "INSERT INTO `payment`(`type`, `type_id`, `status`, `date`) VALUES ('$type', '$identification', '1', NOW())";
				$query = mysqli_query($database,$sql);
				$payment_id = mysqli_insert_id($database);
				$payment = false;
				if(mysqli_affected_rows($database) > 0)$payment = true;

				//Save booking
				$currency = $result['data']['currency'];
				$amount = $result['data']['amount'] / 100;
				$fee = $result['data']['fees'] / 100;
				$method = $result['data']['authorization']['card_type'];
				$sql = "INSERT INTO `booking`(`vendor_id`, `user_id`, `type_id`, `type`, `processor`, `method`, `payment_id`, `transaction_id`, `currency`, `amount`, `fee`, `details`, `status`, `date`) VALUES ('$vendor_id', '$user_id', '$identification', '$type', 'Paystack', '$method', '$payment_id', '$reference', '$currency', '$amount', '$fee', '{}', '1', NOW())";
				$query = mysqli_query($database,$sql);
				$booking_id = mysqli_insert_id($database);
				$booking = false;
				if(mysqli_affected_rows($database) > 0)$booking = true;

				echo '{"message": "Transaction was successful", "success": true, "booking_id": "'.$booking_id.'"}';

				if($payment && $booking){
					// Commit transaction
					mysqli_query($database, "COMMIT");
				}else{
					// Rollback transaction
					mysqli_query($database, "ROLLBACK");
				}

			}
		}else{
		  echo '{"message":"Transaction was unsuccessful", "success": false}';
		}
		
	}else{
		echo '{"message":"Request format was incorrect", "success": false}';
	}
?>