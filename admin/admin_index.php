<?php

	// THIS IS FOR WHEN YOU ARE USING A MAC
	// ini_set('display_errors', 1);
	// erroe_reporting(E_ALL);

	require_once('phpscripts/config.php');
	confirm_logged_in();

	// $date = date_create("Canada/Eastern");
	// 	echo date_format($date, 'Y-m-d h:i:sa');

// is there an easier way to do this connection??

	$user = "root";
	$pass = "";
	$url = "localhost";
	$db = "db_movies";

	$link = mysqli_connect($url, $user, $pass, $db); 
	
	/* check connection */ 	
	if(mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	// creating a query to grab our table, and set the users last loging to be the current time
	$lastLogin = "UPDATE `tbl_user` SET `user_lastLogin` = now()  WHERE user_id=1";
	// echo $lastLogin;

	// $loginAttempts = "UPDATE `tbl_user` SET `user_attempts` = user_attempts + 1 WHERE user_id = 1";
		// echo $loginAttempts;


	// This is updating our most recent login time into the database 
	if(mysqli_multi_query($link, $lastLogin)){
	    // echo "woo it works";
	} else {
	    echo "Boo you broke it" . mysqli_error($link);
	}

	// if(mysqli_multi_query($link, $loginAttempts)){
	//     // echo "woo it works";
	// } else {
	//     echo "Boo you broke it" . mysqli_error($link);
	// }

	// Time greeting
	//this is setting our timezone
	date_default_timezone_set('Canada/Eastern');

	//creating a variable for hour and setting it to the hour format we want, 24 hours seems easiest to deal with
	$Hour = date('G'); //24-hour format of an hour (0 to 23)

	// setting if statments and then echoing out our message, if the hour is greater than our equal to *insert number* AND is less than and equal to *insert new hour* the message will echo
	if ( $Hour >= 5 && $Hour <= 11 ) {
	    echo "<h2 class='time-message'>Rise n' Shine, do aliens eat breakfast?</h2>";
	} else if ( $Hour >= 12 && $Hour <= 18 ) {
	    echo "<h2 class='time-message'>The forcast calls for a chance of gloomy <br> afternoon filled with PHP</h2>";
	} else if ( $Hour >= 19 || $Hour <= 4 ) {
	    echo "<h2 class='time-message'>The stars are twinkling <br> take a peep at those UFO's in the distance</h2>";
	}

	mysqli_close($link);


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

<div id="welcome-page">
	<div class="welcome-con">
		<?php echo"<h2 id='welcome-tagline'>Hi {$_SESSION['user_name']}</h2>"; ?>
		<h1 id="welcome-title">Welcome to the greatest webpage to ever have existed, <br> enjoy your stay.</h1>

		<!-- <a id="createuser" href="admin_createuser.php">Create a New User</a> -->
		<a id="signout" href="phpscripts/caller.php?caller_id=logout">Sign Out</a>
	</div>
</div>
	

</body>
</html>	