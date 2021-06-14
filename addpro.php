<?php
include('connect.php');
session_start();

 $short_descraption=$_POST['short_descraption'];
 $Details=$_POST['Details'];
 $lower_cost=$_POST['lower_cost'];
 $Largest_cost=$_POST['Largest_cost'];
 $id=$_SESSION['ID'];
 $skill=$_POST['skill'];
 $Delevary_time=$_POST['Delevary_time'];

$query="INSERT INTO project (short_discration, Detation, Lower_cost, Largest_cost, ID_Client, ID_worker, ID_skill, Delevary_time,file) VALUES ('$short_descraption','$Details'
,$lower_cost,$Largest_cost,$id,null,$skill,$Delevary_time,NULL)";
$resuet=mysqli_query($conn,$query);

if(!$resuet){
	echo "<script>window.alert('Add Error. Please try again.')</script>";
	echo "<script>window.location.href='add.php?attempt=failed'</script>";
}
else 
	header('location:project.php');