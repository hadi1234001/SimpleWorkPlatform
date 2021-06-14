<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link href="Add offer/addO.css" rel="stylesheet" type="text/css">
	<link href="Add/add.css" rel="stylesheet" type="text/css">
	<link href="Add/media.css" rel="stylesheet" type="text/css">
	<link href="Add offer/SWP.css" rel="stylesheet" type="text/css">
	<link href="Add offer/header.css" rel="stylesheet" type="text/css">
	<link href="Add offer/menu.css" rel="stylesheet" type="text/css">
	<script language="javascript" type="text/javascript">
		window.history.forward();
	</script>
</head>
<nav>
	<input type="checkbox" id="nav" class="hidden">
	<label for="nav" class="nav-btn"><i></i><i></i><i></i></label>
	<div class="header">
		<ul class="menu">
			<li><a href="#" onclick="history.go(-1)">back</a>
			</li>
			<li><a href="project.php">Browse Projects</a>
			</li>
			<li><a href="ProfileW.php" class="login">profile</a>
			</li>
		</ul>
	</div>
	<div class="text middle"> <span>S</span> <span class="hidden_logo">i</span> <span class="hidden_logo">m</span> <span class="hidden_logo">p</span> <span class="hidden_logo">l</span> <span class="hidden_logo">e</span> <span>W</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">k</span> <span>P</span> <span class="hidden_logo">l</span> <span class="hidden_logo">a</span> <span class="hidden_logo">t</span> <span class="hidden_logo">f</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">m</span> </div>
</nav>
<body>
	<img class="image_offer" src="Add offer/Logo.png">
	<div class="add">
		<h1>Add Offer</h1>
		<?php
		include( 'connect.php' );
		session_start();
	 $ID = $_SESSION[ 'ID' ];
		$id_pro = $_GET[ 'id_pro' ];
		//check from report where tebort=3
		$date = date( 'Y-m-d' );
		$sql_check_date = "select date_block from worker where ID=$ID";
		$res_check_date = mysqli_query( $conn, $sql_check_date );
		$row_check_date = mysqli_fetch_assoc( $res_check_date );
		$date_block = $row_check_date[ 'date_block' ];
		if ( $date < $date_block ) {
			echo "<script>window.alert('You cannot add offers until date: " . $date_block . "')</script>";
			echo "<script>window.location.href='Offer.php?id=$id_pro'</script>";
		}
		?>
		<form action='Add_Offer.php?id_pro=<?php echo $id_pro;?>' method="post">
			<label class="title" id="one">Cost</label>
			<input type="number" class="input" placeholder="Cost" maxlength="25" name="Cost">

			<label class="title" id="tow">End time</label>
			<input type="number" class="input" placeholder="5 dayes" name="End_time">

			<label class="title" id="three">Details</label>
			<textarea class="input" id="textarea" maxlength="100" placeholder="Details" name="Details"></textarea>

			<input type="submit" class="submit" value="Add">
		</form>
	</div>
	</div>
</body>
</html>