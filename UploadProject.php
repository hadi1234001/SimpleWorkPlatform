<?php
include( 'connect.php' );

session_start();
use PHPMailer\ PHPMailer\ PHPMailer;
$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];

if($T=='w'){
	echo "<script>window.alert('You cannot access this page')</script>";
	echo "<script>history.go(-1)</script>";
}
$id_pro = $_GET[ 'id_project' ];
$id_offer=$_GET['id_offer'];
/*
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
*/
if ( $_FILES[ "file" ] > 0 ) {
	$file = $_FILES[ "file" ][ "name" ];
	$target_file = "Ready_projects/" . $file;
	move_uploaded_file( $_FILES[ "file" ][ "tmp_name" ], $target_file );
	$sql_file = "UPDATE project  SET file = '$file' WHERE ID_project =$id_pro";
	
	//To add a blank message
	$sql_id_room="select chat_room.ID_room,project.ID_Client from project,offer,chat_room where chat_room.ID_offer=offer.ID_offer and project.ID_project=offer.ID_project and project.ID_project=$id_pro";
	$row_id_room=mysqli_fetch_assoc(mysqli_query($conn,$sql_id_room));
	$id_room=$row_id_room['ID_room'];
	$sql_message="INSERT INTO message (Message, Sender_number, File, Send_date, ID_room, T, status) VALUES (null, $ID, null, NOW(), $id_room, '$T', 0)";
	mysqli_query($conn,$sql_message);
	$id_client=$row_id_room['ID_Client'];
	//End
	
	$result_upload_file = mysqli_query( $conn, $sql_file );
	if ( $result_upload_file ) {
		$sql = "select Email,ID from client where ID=$id_client";
		$res = mysqli_query( $conn, $sql );
		$row = mysqli_fetch_assoc( $res );
		$email = $row[ 'Email' ];
		$id_client=$row['ID'];
		
		$sql="select worker.F_name,short_discration from project,worker where ID_worker=$ID and ID_Client=$id_client and ID_worker=$ID";
		$res = mysqli_query( $conn, $sql );
		$row = mysqli_fetch_assoc( $res );
		$name_worker=$row['F_name'];
		$name_pro=$row['short_discration'];
		
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
		$mail->Body = "
		The project was sent: <h3>$name_pro</h3> by <h3>$name_worker</h3>
		<br>
		Go to the following link to download: 
		<a href='http://localhost/pro/download.php?id_project=$id_pro&id_worker=$ID&id_client=$id_client'>Click</a>
		";
		$mail->setFrom( "hadi1234001@gmail.com", "Simple Work Platform" );
		$mail->addAddress( $email );
		if ( $mail->send() ) {
			
		} else
			echo "Error..." . $mail->ErrorInfo;
	}
}
