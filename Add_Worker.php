<?php
include( 'connect.php' );
session_start();
//use: Used to indicate external name and import features (adding files for use in the program)
use PHPMailer\ PHPMailer\ PHPMailer;

$name = $_POST[ 'name' ];
//explode: Divides the string into an array by a specified separator
$array_name = explode( ' ', $name );

$email = $_POST[ 'email' ];
//md5() : Password encryption
$password = md5( $_POST[ 'password' ] );
$Overview = $_POST[ 'Overview' ];
$date_berth = $_POST[ 'date_berth' ];
$skill = $_POST[ 'skill' ];
$type = $_POST[ 'type' ];
//Check for e-mail
$query_check = "select Email from worker where Email='$email'";
$result_check = mysqli_query( $conn, $query_check );

if ( mysqli_num_rows( $result_check ) > 0 ) {
	//alert the email is exists
	echo "<script>window.alert('The account already exists')</script>";
	echo "<script>window.location.href='loginW.php?attempt=failed'</script>";
} else {
	//insert user
	$insert = "INSERT INTO worker (F_name, S_name, T_name, Date_Birth, Email, Password, Overview, Type,T,date_block) VALUES ('$array_name[0]', '$array_name[1]', '$array_name[2]', '$date_berth', '$email', '$password', '$Overview', $type, 'w',null)";
	$result = mysqli_query( $conn, $insert );
	//Failed to add the user
	if ( !$result  ) {
		echo "<script>window.alert('SingIn Error. Please try again.')</script>";
		echo "<script>window.location.href='loginW.php'</script>";
	} else {
		//Return user information
		$query = "select * from worker where Email='$email' and Password='$password'";
		$result = mysqli_query( $conn, $query );
		$row = mysqli_fetch_assoc( $result );
		$id = $row[ 'ID' ];
		//sizeof: It returns the number of elements in an array.
		for ( $i = 0; $i < sizeof( $skill ); $i++ ) {
			//add worker skill
			$insert_skill = "INSERT INTO skill_worker (number_project, projects_overview, ID_worker, ID_skill)VALUES (Null,Null,$id ,$skill[$i])";
			$result_skill = mysqli_query( $conn, $insert_skill );
			
		}
		//Generate a random number
	$code = rand( 100000, 1000000 );
	//send mail

	//require: It is used to include a file in a file, and if there are any errors that lead to a warning and the program stops execution
	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';
	//To create a new PHPMailer object
	$mail = new PHPMailer;

	$mail->isSMTP(); //send via SMTP: Simple Email Transfer Protocol
	$mail->Host = "smtp.gmail.com"; //Select the main SMTP servers
	$mail->SMTPAuth = true; //Whether to use SMTP authentication
	$mail->Username = "hadi1234001@gmail.com"; //Email
	$mail->Password = "xwhsidoidakdrraq"; //Password
	$mail->CharSet = "UTF-8"; //To send encrypted mail messages
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Used to define encryption technology (lts or ssl)
	$mail->Port = 587; //The port for the protocol (587 or 465)
	$mail->Subject = "Welcome";
	$mail->isHTML( TRUE ); // if you want use HTML
	$mail->Body = "your code is: $code"; //Message
	$mail->setFrom( "hadi1234001@gmail.com", "Simple Work Platform" ); //sender's address
	$mail->addAddress( $email ); //Address of the addressee
	//if the email send
	if ( $mail->send() ) {
		$_SESSION[ 'ID' ] = $row[ 'ID' ];
		$_SESSION[ 'T' ] = $row[ 'T' ];
		//Redirects the browser to a new page.
		header( 'location:check.php?code=' . md5( $code ) );
	}
	//Error
	else
		echo "Error..." . $mail->ErrorInfo;
	}
	
}