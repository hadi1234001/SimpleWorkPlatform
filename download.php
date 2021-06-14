<?php
include( 'connect.php' );
session_start();
$id_worker = $_GET[ 'id_worker' ];
$id_project = $_GET[ 'id_project' ];

$T=$_SESSION['T'];
if($T=='w'){
	echo('<script> alert ("Error");</script>');
	echo('<script>history.go(-1); </script>');
}
else{
$ID = $_SESSION[ 'ID' ] = $_GET[ 'id_client' ];
$T = $_SESSION[ 'T' ] = 'c';

$sql = "select file  from project where ID_project=$id_project and ID_worker=$id_worker";
$res = mysqli_query( $conn, $sql );
$row = mysqli_fetch_assoc( $res );
}

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link href="download/download.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="download/jquery-3.1.1.js"></script>
	<script src="download.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> </script>
</head>
<span class="title">We Hope That You Like It The Project</span>
<div class="container">
	<a href="Ready_projects/<?php echo $row['file']?>" class="link_download">click to Download File</a>
	<br>
	<button type="button" class="btn_problem Problem" data-toggle="modal" data-target="#myModal">Problem</button>
	<button class="btn_problem Recrived " id="Recrived" data-toggle="modal" data-target="#myModal2">Recrived</button>

	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="title title_modal">What exactly do you want to do?</h4>
			</div>
			<div class="modal-body">
				<a href="report.php?id_project=<?php echo $id_project?>"><button type="button" class="btn btn-info">Report</button></a>
				<a href="chat.php"><button class="btn btn-info ">Go to chat</button></a>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal2" role="dialog">
		<div class="modal-dialog">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="title title_modal">Please rate your satisfaction with the project..!</h4>
			</div>
			<div class="modal-body">
				<input type="radio" id="check" name="star" value="1">
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked_W"></span>
				<span class="fa fa-star checked_W"></span>
				<span class="fa fa-star checked_W"></span>
				<span class="fa fa-star checked_W"></span><br>
				<input type="radio" id="check" name="star" value="2">
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked_W"></span>
				<span class="fa fa-star checked_W"></span>
				<span class="fa fa-star checked_W"></span><br>
				<input type="radio" id="check" name="star" value="3">
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked_W"></span>
				<span class="fa fa-star checked_W"></span><br>
				<input type="radio" id="check" name="star" value="4">
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked_W"></span><br>
				<input type="radio" id="check" name="star" value="5">
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span><br>
				<input type="hidden" value="<?php echo $id_project;?>" id="id_project">
				<button class="btn btn-info long" id="Send">OK</button>
			</div>
		</div>
	</div>
</div>
<body>
</body>
</html>