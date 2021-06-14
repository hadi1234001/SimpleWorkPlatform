<?php
include( "connect.php" );
session_start();
$id = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];

$id_room = $_GET[ 'id_room' ];

$note = $_POST[ 'note' ];
$reason = $_POST[ 'reason' ];


//know id_from from 
if ( !is_null( $_GET[ 'id_project' ] ) ) {
	$id_project = $_GET[ 'id_project' ];
	$sql_id_room = "select ID_room from chat_room,project,offer where chat_room.ID_offer=offer.ID_offer and project.ID_project=offer.ID_project and offer.ID_project=$id_project";
	$res_id_room = mysqli_query( $conn, $sql_id_room );
	$row_id_room = mysqli_fetch_assoc( $res_id_room );
	$id_room = $row_id_room[ 'ID_room' ];
}

//know count report and add date blocl
if ( $T == 'c' ) {
	$sql_count_report = "select count(ID_report),ID_worker as 'ID'  from report,chat_room where chat_room.ID_room=report.ID_room and ID_Client=Reporting_person and Reporting_person<>ID_worker and Reporting_person=$id";
} else {
	$sql_count_report = "select count(ID_report),ID_Client as 'ID'  from report,chat_room where chat_room.ID_room=report.ID_room and ID_Client=Reporting_person and Reporting_person<>ID_Client and Reporting_person=$id";
}
$res_count_report = mysqli_query( $conn, $sql_count_report );
$row_count_report = mysqli_fetch_assoc( $res_count_report );
$id_person = $row_count_report[ 'ID' ];

if ( $row_count_report[ 'count(ID_report)' ] == 3 ) {
	if ( $T == 'c' ) {
		$sql_date_block = "UPDATE worker SET date_block = date_add(NOW(),INTERVAL 1 MONTH)  WHERE ID = $id_person";
	} else
		$sql_date_block = "UPDATE client SET date_block = date_add(NOW(),INTERVAL 1 MONTH)  WHERE ID = $id_person";
	mysqli_query( $conn, $sql_date_block );
}
//End

//add report
$sql_reporting = " INSERT INTO report (Date_of_repoting, ID_room, Reporting_person,T, ID_reasin, Notes) VALUES (Now(), $id_room, $id, '$T', $reason, '$note')";
$result = mysqli_query( $conn, $sql_reporting );
//End

//know Id_report to add him in message
$sql_report="select ID_report from report where ID_room=$id_room order by ID_report desc";
$result=mysqli_query($conn,$sql_report);
$row_report=mysqli_fetch_assoc($result);
$id_report=$row_report['ID_report'];

$sql_message="INSERT INTO message (Message, Sender_number, File, Send_date, ID_room, T, status, report) VALUES (null, $id, null, NOW(), $id_room, '$T', DEFAULT, $id_report)";
mysqli_query($conn,$sql_message);
//End

//hide chat
$sql_hide = " UPDATE chat_room SET hide = 1 WHERE ID_room = $id_room";
$result_hide = mysqli_query( $conn, $sql_hide );
$row = mysqli_fetch_array( $result_hide );
//End
//chek from successfull
if ( $result && $result_hide ) {
	echo "<script>window.alert('Successfully reported')</script>";
	echo "<script>window.location.href='chat.php'</script>";
} else {
	echo "<script>window.alert('EROOR')</script>";
	echo "<script>histoy.go(-1)</script>";
}
//End