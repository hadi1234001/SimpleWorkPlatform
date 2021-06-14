<?php
include( 'connect.php' );
$ID = $_SESSION[ 'ID' ];
$ID_room = $_GET[ 'id_room' ];


$sql_report = "select report.ID_report,ID_reqest from report,request where ID_room=$ID_room and report.ID_report=request.ID_report";
$res_report = mysqli_query( $conn, $sql_report );
$row = mysqli_fetch_assoc( $res_report );

$ID_report = $row[ 'ID_report' ];
$ID_reqest = $row[ 'ID_reqest' ];


$sql_delete = "DELETE FROM request WHERE ID_reqest = $ID_reqest";
mysqli_query( $conn, $sql_delete );



$sql_show_chat = "UPDATE chat_room  SET hide = 0 WHERE ID_room = $ID_room";
mysqli_query( $conn, $sql_show_chat );

if ( isset( $_GET[ 'admin' ] ) ) {
	echo "<script>window.alert('The ban has been lifted')</script>";
	echo "<script>window.location.href='table_request.php'</script>";
} else {
	echo "<script>window.alert('The ban has been lifted')</script>";
	echo "<script>window.location.href='chat.php'</script>";
}