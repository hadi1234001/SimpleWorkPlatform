<?php
include( 'connect.php' );
session_start();
$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];

if ( $T == 'c' )
	$sql_number_message = "select COUNT(*) as count from message,chat_room where ID_client=$ID and status=0 and T='w'  and message.ID_room=chat_room.ID_room";
else
	$sql_number_message = "select COUNT(*) as count from message,chat_room where ID_worker=$ID and status=0 and T='c'  and message.ID_room=chat_room.ID_room";

$result_number = mysqli_query( $conn, $sql_number_message );
$row_number_message = mysqli_fetch_array( $result_number );

if ( $row_number_message[ 'count' ] > 0 )
	echo $row_number_message[ 'count' ];
else
	echo "";
?>