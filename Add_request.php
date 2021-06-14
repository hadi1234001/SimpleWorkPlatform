<?php
include( 'connect.php' );
session_start();
$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];

$id_room = $_POST[ 'id_room' ];
$details = $_POST[ 'details' ];
$f=true;
$sql = "select ID_report from report,chat_room where chat_room.ID_room=report.ID_room and report.ID_room=$id_room";
$res = mysqli_query( $conn, $sql );
$row = mysqli_fetch_assoc( $res );
$ID_report = $row[ 'ID_report' ];

$sql_check="select * from request where ID_requester=$ID and ID_report=$ID_report";
$res_check=mysqli_query($conn,$sql_check);
if(mysqli_num_rows($res_check)>0){
	$f=false;
}
else
{
$sql = "INSERT INTO request (details, ID_requester, T, ID_report) VALUES ('$details', $ID, '$T', $ID_report)";
if ( mysqli_query( $conn, $sql )) {
	$f=true;
} else {
	$f=false;
}
echo $f;
}