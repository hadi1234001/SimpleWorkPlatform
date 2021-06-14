<?php
include( 'connect.php' );
session_start();
$id = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];
$id_room=$_GET['id_room'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="request/request.css" rel="stylesheet" type="text/css">
	
	<script src="jquery-3.1.1.js"></script>
	<script src="reqest.js"></script>
</head>

<body>
	<a href="#" class="back">Back</a>
	<h1>We ask you to write your request details</h1>
	<div class="contaner">
		<textarea class="textarea" id="details"></textarea>
		<button type="button" class="btn" id="btn">SEND</button>
		<input type="hidden" value="<?php echo $id_room; ?>" id="id_room">
	</div>
</body>
</html>
