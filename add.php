<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link href="Add/add.css" rel="stylesheet" type="text/css">
	<link href="Add/media.css" rel="stylesheet" type="text/css">
	<link href="Add/header.css" rel="stylesheet" type="text/css">
	<link href="Add/SWP.css" rel="stylesheet" type="text/css">
	<link href="Add/menu.css" rel="stylesheet" type="text/css">
	<script>
		window.history.forward();
	</script>
	<nav>
		<input type="checkbox" id="nav" class="hidden">
		<label for="nav" class="nav-btn"><i></i><i></i><i></i></label>
		<div class="header">
			<ul class="menu">
				<li><a href="#"></a>
				</li>
				<li><a href="project.php">Browse Projects</a>
				</li>
				<li><a href="ProfileC.php" class="login">Profile</a>
				</li>
			</ul>
		</div>
		<div class="text middle"> <span>S</span> <span class="hidden_logo">i</span> <span class="hidden_logo">m</span> <span class="hidden_logo">p</span> <span class="hidden_logo">l</span> <span class="hidden_logo">e</span> <span>W</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">k</span> <span>P</span> <span class="hidden_logo">l</span> <span class="hidden_logo">a</span> <span class="hidden_logo">t</span> <span class="hidden_logo">f</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">m</span> </div>
	</nav>
</head>
<body>
	<?php
	include( 'connect.php' );
	session_start();

	$ID = $_SESSION[ 'ID' ];
	$T = $_SESSION[ 'T' ];

	if ( $ID == null ) {
		echo "<script>window.alert('You must log in to continue')</script>";
		echo "<script>window.location.href='index.html'</script>";
	}
	//check from report where tebort=3
	$date = date( 'Y-m-d' );
	$sql_check_date = "select date_block from client where ID=$ID";
	$res_check_date = mysqli_query( $conn, $sql_check_date );
	$row_check_date = mysqli_fetch_assoc( $res_check_date );
	$date_block = $row_check_date[ 'date_block' ];
	if ( $date < $date_block ) {
		echo "<script>window.alert('You cannot add Project until date: " . $date_block . "')</script>";
		echo "<script>window.location.href='project.php'</script>";
	}
	?>
	<img class="image_offer" src="Add/Logo.png">
	<div class="add">
		<h1>Add Project</h1>
		<form action="addpro.php" method="post">
			<label class="title" id="one">short descraption</label>
			<input type="text" class="input" placeholder="Prief Descraption" maxlength="25" name="short_descraption">

			<label class="title" id="tow">Delevary time</label>
			<input type="number" class="input" placeholder="Delevary time" name="Delevary_time">

			<label class="title" id="three">lower cost</label>
			<input type="number" class="input" placeholder="Lower cost" name="lower_cost">

			<label class="title" id="four">largest cost</label>
			<input type="number" class="input" placeholder="Largest cost" name="Largest_cost">

			<label class="title" id="five">Details</label>
			<textarea class="input" id="textarea" maxlength="255" placeholder="Details" name="Details"></textarea>

			<select name="skill" class="skill">
				<?php
				$query_skill = "select * from skill";
				$result_skill_query = mysqli_query( $conn, $query_skill );
				while ( $row_skill = mysqli_fetch_assoc( $result_skill_query ) ) {
					?>
				<option value="<?php echo $row_skill['ID_skill'];?>">
					<?php echo $row_skill['Name_skill'];  ?>
				</option>

				<?php
				}
				?>
			</select>
			<input type="submit" class="submit" value="Add">
		</form>
	</div>
</body>
</html>