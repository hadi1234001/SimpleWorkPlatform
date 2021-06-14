<?php

include( 'connect.php' );
use PHPMailer\ PHPMailer\ PHPMailer;
$sql = "select Date_acceptance,worker.Email,client.F_name,client.S_name,short_discration from offer,worker,project,client where Date_acceptance is not null and file is null and offer.ID_worker=worker.ID and  project.ID_project=offer.ID_project and project.ID_Client=client.ID";

//update data
mysqli_query($conn,"UPDATE send_check  SET data_send =NOW() WHERE data_send IS Not NULL");


$res = mysqli_query( $conn, $sql );
while ( $row = mysqli_fetch_assoc( $res ) ) {
	
	$Date_acceptance = $row[ 'Date_acceptance' ];
	$email_date = $row[ 'Email' ];
	$name_date = $row[ 'F_name' ] . " " . $row[ 'S_name' ];
	$project_data = $row[ 'short_discration' ];

    $date_s = date( 'Y-m-d' );
	if ( $date_s == $Date_acceptance ) {
		require 'phpmailer/src/Exception.php';
		require 'phpmailer/src/PHPMailer.php';
		require 'phpmailer/src/SMTP.php';
		//To create a new PHPMailer object
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
		$mail->Body = "Today is the day of the project delivery  <h3><b><u>$project</u></b></h3> 
         To the customer <i>$name_date</i>
         We hope you have finished
        <h5>Thank you</h5>";
		$mail->setFrom( "hadi1234001@gmail.com", "Simple Work Platform" );
		$mail->addAddress( $email_date );
		$mail->send();
			
	}
}