<?php
include( 'connect.php' );
session_start();
$id = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];


$sql="delete from skill_worker where ID_worker=$id";
$res1=mysqli_query($conn,$sql);
$sql="DELETE FROM worker WHERE ID = $id";
$res2=mysqli_query($conn,$sql);
if($res1 or $res2){
	echo("<script>window.alert('Account deleted')</script>");
	echo "<script>window.location.href='index.html'</script>";
}
$_SESSION[ 'ID' ]=null;
$_SESSION[ 'T' ]=null;