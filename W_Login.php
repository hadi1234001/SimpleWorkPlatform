<?php
include( 'connect.php' );
session_start();

$email = $_POST[ 'email' ];
$password =  $_POST[ 'password' ] ;
//check from user
$query = "select * from worker where Email='$email' and Password='$password'";
$resutl = mysqli_query( $conn, $query );
//mysqli_num_rows: function returns the number of rows in a result set.
if ( mysqli_num_rows( $resutl ) < 1 ) {
	//alert if login failed
	echo "<script>window.alert('Login Error. Please try again.')</script>";
	//window.location.href: to redirect the browser to a new page.
	echo "<script>window.location.href='loginW.php?'</script>";
} else {
	//mysqli_fetch_array:	function fetch a result row as an associative array, a numeric array, or both
	$row = mysqli_fetch_array( $resutl );
		$_SESSION[ 'ID' ] = $row[ 'ID' ];
		$_SESSION[ 'T' ] = $row[ 'T' ];
		header( 'location:project.php' );
	
}
?>