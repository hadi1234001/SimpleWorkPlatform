<?php

include( 'connect.php' );
session_start();
$id = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];

$code = $_GET[ 'code' ];
$code_check = $_POST[ 'code' ];

if ( $code == md5( $code_check ) ) {
	//to check from skill
	$sql_check = "select * from skill_worker where ID_worker=$id";
	$res = mysqli_query( $conn, $sql_check );
	if ( mysqli_num_rows( $res )==0 ) {
		header( 'location:project.php' );
	} else {
		header( 'location:skill_worker.php' );
	}

} else {

	$Error = $_GET[ 'Error' ] + 1;
	header( 'location:check.php?code=' . $code . '& Error=' . $Error );

}