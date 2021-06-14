<?php
include( 'connect.php' );
session_start();
$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];

$assessment=$_POST['assessment'];
$id_project=$_POST['id_projact'];

$f=false;

$sql=mysqli_query($conn," UPDATE project SET assessment = $assessment WHERE ID_project = $id_project");
if($sql){
	$f=true;
}
echo $f;