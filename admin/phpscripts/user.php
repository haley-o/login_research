<?php 

	function createUser($fname, $username, $password, $email, $userlvl) {
		include('connect.php');
		$userString = "INSERT INTO tbl_user VALUES(NULL, '{$fname}', '{$username}', MD5('{$password}'), '{$email}', CURRENT_TIMESTAMP, '{$userlvl}', 'no', 0, 0)";

		// INSERT INTO tbl_user VALUES(NULL, 'haley', 'test', 'password2', 'email', CURRENT_TIMESTAMP, '1', 'no', 0, 0)
		echo $userString;

		$userQuery = mysqli_query($link, $userString);
		if($userQuery) {
			redirect_to("admin_index.php");
		}else{
			$message = "There was a problem setting up this user";
			return $message;
		}


		mysqli_close($link);
	}

	//Generating a random password for new users
	function randomPassword()  { //the length of this password will be the length of 5 characters
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; //the random 5 characters will be picked from this variable
    // $count = mb_strlen($chars); //this is getting the string length of our $chars variable
    $pass = array();
    $length = 5;


    for ($i = 0; $i < 5; $i++) {
        $index = rand(0, $length - 1);//The rand() function generates a random integer.

        $pass[] = $chars[$index];

        // mb_substr() returns the portion of str specified by the start and length parameters.
        // $result .= mb_substr($chars, $index, 1); // the result = a returned portion of our chars variable and the index variable
    }

    return implode($pass); //turn the array into a string

}

function inputIntoDB(){
    $string = randomPassword();
    $db->where('user_pass',$string)->getOne('tbl_user');
    if (!$db->count > 0){
        //insert data into the database.
    }
}

	// start by creating a function to send the email after the user has been created
	//similar to the above function, it is then called in the admin_create users.php
	function sendEmail($username, $password, $email) {
		// include('connect.php');
	    $to = $email; // sending the email to the email submitted
	    $subject = "Your username and password";
	    $body = "Username: " . $username . "\r\n";
	    $body .= "Password: " . inputIntoDB() . "\r\n";
	    $body .= "Login URL: http://localhost/admin/admin_login.php";
	    $headers = 'From: noreply@test.com' . "\r\n";
	    echo $body;
	    mail($to, $subject, $body, $headers); //having issues sending mail() with my wamp, installed hMailServer to try to fix

	    // mysqli_close($link);
	}


?>