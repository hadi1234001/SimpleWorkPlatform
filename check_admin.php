<?php
include( 'connect.php' );
session_start();

$username = $_POST[ 'username' ];
$password = $_POST[ 'password' ];
$f=false;

if ( ( isset($_POST[ 'username' ]) ) && ( isset( $_POST[ 'password' ] ) ) ){
	$sql="select * from admin where username='$username' and password='$password'";
	$res=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($res);
	
	if(mysqli_num_rows($res)>0){
		$_SESSION['ID']=$row['ID'];
		$f=true;
	}
}
echo($f);
