<?php
include( 'connect.php' );
session_start();
$id = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];

$datanumber = $_POST[ 'number' ];
$datatext = $_POST[ 'textarea' ];
$id_skill = $_POST[ 'id' ];

$f = false;
for ( $i = 0; $i < count( $id_skill ); $i++ ) {
	if ( ( isset( $_POST[ 'number' ] ) ) && ( isset( $_POST[ 'textarea' ] ) ) ) {
		$sql = " UPDATE skill_worker  SET number_project =$datanumber[$i],projects_overview='$datatext[$i]' WHERE  ID_worker = $id and ID_skill=$id_skill[$i]";
		$res = mysqli_query( $conn, $sql );
	}
}
if ( !$res ) {
	$f = false;
} else
	$f = true;
echo( $f );