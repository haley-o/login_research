<?php

	// THIS IS FOR WHEN YOU ARE USING A MAC
	// ini_set('display_errors', 1);
	// erroe_reporting(E_ALL);


	require_once('phpscripts/config.php');
	// confirm_logged_in();
	if(isset($_POST['submit'])) {
		$fname = trim($_POST['fname']);
		$username = trim($_POST['username']);
		$password = randomPassword(); // change this to put generated password into the database
		$email = trim($_POST['email']);
		$userlvl = $_POST['userlvl'];

		// $to = $email; // sending the email to the email submitted
	 //    $subject = "Your username and password";
	 //    $body = "Username: " . $username . "\r\n";
	 //    $body .= "Password: " . $password . "\r\n";
	 //    $body .= "Login URL: http://localhost/admin/admin_createuser.php";
	 //    $headers = 'From: noreply@test.com' . "\r\n";
		// $message = $_POST['message'];
		// $result = createUser($fname, $username, $password, $email, $userlvl);
    
		if(empty($userlvl)){
			$message = "Please select a user level.";
		}else{
			// createUser($fname, $username, $password, $email, $userlvl);
			 // mail($to, $subject, $body, $headers);
			 // echo $body;
			sendEmail($username, $password, $email); 
			// echo $password;
		}
	}


?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CMS Portal Login</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" media="screen">
<link href="../css/reset.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>

<div class="createuser-page">
	<div class="createuser-contentCon">
		<h1 id="createuser-title">Welcome human, create yourself</h1>

		<?php if(!empty($message)){echo $message;} ?>
		<form action="admin_createuser.php" method="post">
			<label><h2>First Name:</h2></label>
			<input class="login-input" type="text" name="fname" value="<?php if(!empty($fname)){echo $fname;} ?>"><br><br>
			<label><h2><h2>Username:</h2></label>
			<input class="login-input" type="text" name="username" value="<?php if(!empty($username)){echo $username;} ?>"><br><br>

			<!-- <label><h2>Password:</h2></label> -->
			<!-- <input id="password-input" type="text" name="password" value=""><br><br> -->

			<label><h2>Email:</h2></label>
			<input class="login-input" type="text" name="email" value="<?php if(!empty($email)){echo $email;} ?>"><br><br>
			<label><h2>User Level:</h2></label>
			<select name="userlvl">
				<option value="">Please Select Your Level</option>
				<option value="1">Web Admin</option>
				<option value="2">Web Master</option>
			</select>
			<input id="createuser-bttn" class="submit-bttn" type="submit" name="submit" value="Create User">
		</form>
	</div>
</div>

</body>
</html>	