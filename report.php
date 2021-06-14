<?php
include( "connect.php" );
session_start();
$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];

$id_room = $_GET[ 'id_room' ];
$id_project = $_GET[ 'id_project' ];

//Preventing the user from direct access
if ( $ID == null ) {
	echo "<script>window.alert('You must log in to continue')</script>";
	echo "<script>window.location.href='index.html'</script>";
}
//Prevent user from reporting twice
$sql_ckeck = "select ID_report from report where ID_room=$id_room and Reporting_person=$ID";
$res_check = mysqli_query( $conn, $sql_ckeck );
if ( mysqli_num_rows( $res_check ) > 0 ) {
	echo "<script>window.alert('You cannot report this person')</script>";
	echo "<script>history.go(-1);</script>";
}
//Prevent the user from reporting from a submitted project
$sql_ckeck = "select file from project,offer,chat_room  where file is not null and chat_room.ID_offer=offer.ID_offer and offer.ID_project=project.ID_project and Id_room=$id_room";
$res_check = mysqli_query( $conn, $sql_ckeck );
if ( mysqli_num_rows( $res_check ) > 0 ) {
	echo "<script>window.alert('You cannot report a project that has been submitted')</script>";
	echo "<script>history.go(-1);</script>";
}

//raiting
$sql_ckeck = "select assessment from project where ID_project=$id_project";
$res_check = mysqli_query( $conn, $sql_ckeck );
if ( mysqli_num_rows( $res_check ) > 0 ) {
	echo "<script>window.alert('You cannot report the project executor after evaluating the work')</script>";
	echo "<script>history.go(-1);</script>";
}


?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>report</title>
	<link href="report/SWP.css" rel="stylesheet" type="text/css">
	<link href="report/report.css" rel="stylesheet" type="text/css">
	<link href="report/menu.css" rel="stylesheet" type="text/css">
	<link href="report/header.css" rel="stylesheet" type="text/css">
	<script language="javascript" type="text/javascript">
		window.history.forward();
	</script>
	<nav>
		<input type="checkbox" id="nav" class="hidden">
		<label for="nav" class="nav-btn"><i></i><i></i><i></i></label>
		<div class="header">
			<ul class="menu">
				<li><a href="#">register</a>
				</li>
				<li><a href="#">Browse Projects</a>
				</li>
				<li><a href="#" class="login">Login</a>
				</li>
			</ul>
		</div>
		<div class="text middle"><span>S</span><span class="hidden_logo">i</span><span class="hidden_logo">m</span><span class="hidden_logo">p</span><span class="hidden_logo">l</span><span class="hidden_logo">e</span><span>W</span><span class="hidden_logo">o</span><span class="hidden_logo">r</span><span class="hidden_logo">k</span><span>P</span><span class="hidden_logo">l</span><span class="hidden_logo">a</span><span class="hidden_logo">t</span><span class="hidden_logo">f</span><span class="hidden_logo">o</span><span class="hidden_logo">r</span><span class="hidden_logo">m</span>
		</div>
	</nav>
</head>

<body>

	<img src="report/Logo.png" class="img">
	<br>
	<form action="Reporting.php?id_room=<?php  echo $id_room;?><?php
				  if(!is_null($id_project)){
					  echo '&id_project='.$id_project;
				  }
				  ?>" method="post">
		<label class="title" id="one">Reason reporting</label>
		<select name="reason" class="skill">
			<?php
			//show the reason reporting
			$sql_reason = "select *from reason_for_reporting";
			$result = mysqli_query( $conn, $sql_reason );
			while ( $row = mysqli_fetch_assoc( $result ) ) {
				?>
			<option value="<?php echo $row['ID_reasin'] ;?>">
				<?php echo $row['Reason'];?>
			</option>
			<?php
			}
			?>
		</select>

		<label class="title" id="tow">Notes</label>
		<textarea class="input" id="textarea" maxlength="100" placeholder="Notes" name="note"></textarea>
		<br>
		<input type="submit" class="submit" value="Report">
	</form>

</body>
</html>