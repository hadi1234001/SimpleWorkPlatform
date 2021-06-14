<?php
include( 'connect.php' );
session_start();
use PHPMailer\ PHPMailer\ PHPMailer;

$name = $_POST[ 'name' ];
$array_name = explode( ' ', $name );

$email = $_POST[ 'email' ];
$password = md5($_POST[ 'password' ]);
$note = $_POST[ 'note' ];
$date_berth = $_POST[ 'date_berth' ];

$query_check = "select Email from client where Email='$email'";
$result_check = mysqli_query( $conn, $query_check );

if ( mysqli_num_rows( $result_check ) > 0 ) {
	echo "<script>window.alert('The account already exists')</script>";
	echo "<script>window.location.href='loginC.php?attempt=failed'</script>";
} else {
	$insert = "INSERT INTO client (F_name, S_name, T_name, Date_Birth, Email, Password, Notes,  T,date_block) VALUES ('$array_name[0]', '$array_name[1]', '$array_name[2]', '$date_berth', '$email', '$password', '$note', 'c',null)";
	$result = mysqli_query( $conn, $insert );

	if ( !$result ) {
		echo "<script>window.alert('SingIn Error. Please try again.')</script>";
		echo "<script>window.location.href='loginC.php?attempt=failed'</script>";

	} else {
		$query = "select * from client where Email='$email' and Password='$password'";
		$result = mysqli_query( $conn, $query );
		$row = mysqli_fetch_assoc( $result );
		
		$code = rand( 100000, 1000000 );
		//send mail
		
		require 'phpmailer/src/Exception.php';
		require 'phpmailer/src/PHPMailer.php';
		require 'phpmailer/src/SMTP.php';

		$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Username = "hadi1234001@gmail.com";
		$mail->Password = "xwhsidoidakdrraq";
		$mail->CharSet = "UTF-8";
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
		$mail->Port = 587; 
		$mail->Subject = "Welcome";
		$mail->isHTML( TRUE );
		$mail->Body = "your code is: $code";
		$mail->setFrom( "hadi1234001@gmail.com", "hadi" );
		$mail->addAddress( $email );

		if ( $mail->send() ) {
		    $_SESSION[ 'ID' ] = $row[ 'ID' ];
			$_SESSION[ 'T' ] = $row[ 'T' ];
			header( 'location:check.php?code='.md5($code) );
		} else
			echo "Error..." . $mail->ErrorInfo;
	}
}