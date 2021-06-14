<?php
include( 'connect.php' );
session_start();

 $ID = $_SESSION[ 'ID' ];
 $id_pro = $_GET[ 'id_pro' ];
 $end_time = $_POST[ 'End_time' ];
 $cost = $_POST[ 'Cost' ];
 $details = $_POST[ 'Details' ];

$sql_add_offer = "INSERT INTO offer (ID_worker, ID_project, Date_acceptance, Duration_implementation, Cost, Ditails) VALUES ($ID,$id_pro,null,$end_time,$cost,'$details')
";

$result = mysqli_query( $conn, $sql_add_offer );

if ( !$result ) {
	
	echo "<script>window.alert('Entered Error. Please try again.')</script>";
	echo "<script>window.location.href='addOffer.php?id_pro=$id_pro'</script>";
} else
	header( 'location:Offer.php?id=' . $id_pro );