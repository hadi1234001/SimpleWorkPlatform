<?php
include( 'connect.php' );
session_start();

$email = $_POST[ 'email' ];
$password = md5( $_POST[ 'password' ] );

$query = "select * from client where Email='$email' and Password='$password'";

$resutl = mysqli_query( $conn, $query );

if ( mysqli_num_rows( $resutl ) < 1 ) {
	echo "<script>window.alert('Login Error. Please try again.')</script>";
	echo "<script>window.location.href='loginC.php?attempt=failed'</script>";

}  else {
	$row = mysqli_fetch_array( $resutl );
		$_SESSION[ 'ID' ] = $row[ 'ID' ];
		$_SESSION[ 'T' ] = $row[ 'T' ];
		header( 'location:project.php' );
	
}
?>