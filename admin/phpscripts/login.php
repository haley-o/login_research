<?php

	function logIn($username, $password, $ip) {
		require_once('connect.php');
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);
		$loginstring = "SELECT * FROM tbl_user WHERE user_name = '{$username}' AND user_pass = '{$password}'";
		// echo $loginstring;
		$user_set = mysqli_query($link, $loginstring);

		if(mysqli_num_rows($user_set)){
			$found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
			$id = $found_user['user_id'];

			// $date = date_create("Canada/Eastern");
	// 	echo date_format($date, 'Y-m-d h:i:sa');
			// echo $id;


			//session is safer, do not use cookies to transfer through pages
			$_SESSION['user_id'] = $id;
			$_SESSION['user_name'] = $found_user['user_fname']; 
			//checking if it came back positive, if yes then it runs an update on our database
			if(mysqli_query($link, $loginstring)) {
				$updatestring = "UPDATE tbl_user SET user_ip = '$ip' WHERE user_id = {$id}";
				$updatequery = mysqli_query($link, $updatestring, $lastLogin);
			}
			redirect_to("admin_index.php");
		}else{
			$message = "Username and or password is incorrect.<br>Please make sure your cap locks is turned off.";
			return $message;
		}



		mysqli_close($link);
	}

?>