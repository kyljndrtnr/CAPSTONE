<?php

	if(isset($_POST['btn_send'])){
 	$ddl_to = $_POST['ddl_to'];
 	$txt_subj = $_POST['txt_subj'];
 	$txt_msg = $_POST['txt_msg'];

 	$q = mysqli_query($con,"SELECT * from tblfaculty where id = '".$ddl_to."' ");
 	$row = mysqli_fetch_array($q);
 	$name = $row['lname'].', '.$row['fname'];
 	
 		$s = mysqli_query($con,"INSERT into tblsent (message_date,subject,message,sendto,senderid,sender_name) values (NOW(),'".$txt_msg."','".$txt_subj."','".$ddl_to."','".$_SESSION['userid']."','Administrator')");
 		$i = mysqli_query($con,"INSERT into tblinbox (message_date,subject,message,sendto,senderid,sender_name) values (NOW(),'".$txt_msg."','".$txt_subj."','".$ddl_to."','".$_SESSION['userid']."','Administrator')");
 		
 		if($i == true){
 			$_SESSION['sent'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
            exit;
 		}
 	
 	}

	 if (isset($_POST['btn_sendsms'])) {
		$number = $_POST['txt_num'];
		$message = $_POST['txt_msg'];
	
		$sms_message = [
			"secret" => "2ae936ae8d9643f40a7d5993d66c4b33740dce8a", // your API secret from (Tools -> API Keys) page
			"mode" => "devices",
			"device" => "00000000-0000-0000-1f1a-10fd0e1545bd", // your device ID
			"sim" => 1,
			"priority" => 1,
			"phone" => $number,
			"message" => $message
		];
	
		$cURL = curl_init("https://www.cloud.smschef.com/api/send/sms");
		curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cURL, CURLOPT_POSTFIELDS, $sms_message);
		$response = curl_exec($cURL);
		curl_close($cURL);
	
		$result = json_decode($response, true);
	
		// do something with response
		print_r($result);
	}


	if (isset($_POST['btn_sendsmsfac'])) {
		$number = $_POST['txt_num'];
		$message = $_POST['txt_msg'];
	
		$sms_message = [
			"secret" => "2ae936ae8d9643f40a7d5993d66c4b33740dce8a", // your API secret from (Tools -> API Keys) page
			"mode" => "devices",
			"device" => "00000000-0000-0000-1f1a-10fd0e1545bd", // your device ID
			"sim" => 1,
			"priority" => 1,
			"phone" => $number,
			"message" => $message
		];
	
		$cURL = curl_init("https://www.cloud.smschef.com/api/send/sms");
		curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cURL, CURLOPT_POSTFIELDS, $sms_message);
		$response = curl_exec($cURL);
		curl_close($cURL);
	
		$result = json_decode($response, true);
	
		// do something with response
		print_r($result);
	}
		
?>