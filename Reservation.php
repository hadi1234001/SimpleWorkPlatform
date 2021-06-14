<?php
include('connect.php');
session_start();
 $id_client=$_SESSION['ID'];

  $id_worker=$_GET['id_worker'];
 $cost=$_GET['cost'];
 $Delivery_time=$_GET['delivery'];
 $id_pro=$_GET['id_pro'];
$id_offer=$_GET['id_offer'];

$sql="UPDATE project  SET ID_worker =$id_worker ,cost=$cost  ,Delevary_time=$Delivery_time ,Lower_cost=0 ,largest_cost=0 WHERE ID_project =$id_pro";
$chat_room="INSERT INTO chat_room (ID_worker, ID_Client, ID_offer,hide) VALUES ($id_worker,$id_client,$id_offer,0)";
$Date_acceptance="UPDATE offer SET Date_acceptance = NOW() WHERE ID_offer = $id_offer";
$result=mysqli_query($conn,$sql);
$result2=mysqli_query($conn,$chat_room);
if((!$result )||(!$result2)){
	echo 'Error';
}
else 
	header('location:project.php');