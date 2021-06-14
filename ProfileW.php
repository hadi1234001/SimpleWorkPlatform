<?php
include( 'connect.php' );
session_start();

$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];
// If the user does not enter his personal page
if ( !is_null( $_GET[ 'id' ] ) ) {
	$ID = $_GET[ 'id' ];
}
$sql = "select * from worker where ID=$ID";
$result = mysqli_query( $conn, $sql );
$row = mysqli_fetch_array( $result );

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link href="profile/profile.css" rel="stylesheet" type="text/css">
	<script src="jquery-3.1.1.js"></script>
	<script src="profile/profile.js"></script>
</head>

<body>
	<a href="#" class="back" onclick="history.go(-1)">Back</a>
	<a href="project.php" class="back">Projects</a>
	
	<div class="all">
		<div class="div_btn">
			<button class="btn left" id="information">information</button>
			<button class="btn right" id="overview">overview</button>
		</div>

		<div class="container">
			<h1>
				<?php echo $row['F_name']." ".$row['S_name'].' '.$row['T_name']; ?>
			</h1>
			<h3>Birth date:</h3>
			<span>
				<?php  echo $row['Date_Birth'];?>
			</span>
			<h3>Type:</h3>
			<span class="type">
				<?php
				$type = $row[ 'Type' ];
				if ( $type == 1 ) {
					echo "Company";
				} else {
					echo "Personal";
				}
				?>
			</span>
			<h3>Skill:</h3>
			<span class="textskill">
				<?php
				//to show skills of programmer
				$sql_skill = "select Name_skill from skill_worker,skill where skill.ID_skill=skill_worker.ID_skill and ID_worker=$ID";
				$result_skill = mysqli_query( $conn, $sql_skill );
				while ( $row_skill = mysqli_fetch_assoc( $result_skill ) ) {
					echo $row_skill[ 'Name_skill' ];
					echo " / ";
				}
				?>
			</span>
			<hr>
			<h3>Number of project completed:</h3>
			<span class="long">
				<?php
				$sql_count = "select count(ID_worker) as count from project where ID_worker=$ID and assessment is not null;";
				$result_count = mysqli_query( $conn, $sql_count );
				$row_count = mysqli_fetch_assoc( $result_count );
				echo $row_count[ 'count' ];
				?>
			</span>
			<h3>Number of offers submitted:</h3>
			<span class="long1">
				<?php
				$sql_count = "select count(ID_offer) as count from offer where ID_worker=$ID";
				$result_count = mysqli_query( $conn, $sql_count );
				$row_count = mysqli_fetch_assoc( $result_count );
				echo $row_count[ 'count' ];
				?>
			</span>
			<h3>Number of accepted offers:</h3>
			<span class="long2">
				<?php
				$sql_count = "select count(ID_project) as count from project where ID_worker=$ID";
				$result_count = mysqli_query( $conn, $sql_count );
				$row_count = mysqli_fetch_assoc( $result_count );
				echo $row_count[ 'count' ];
				?>
			</span>
			<br>
			<a href="Coder_Ratings.php?id_person=<?php echo($ID); ?>" class="rat">Programmer Ratings</a>
		</div>

		<div class="skill">
			<h2><u>Overview: </u></h2>
			<p>
				<?php  echo $row['Overview'];?>
			</p>
			<br>
			<h2><u>Skills:</u></h2>
			<?php
			$sql_skill = "select number_project,projects_overview,Name_skill from skill_worker,skill where ID_worker=$ID and skill.ID_skill=skill_worker.ID_skill";
			$result_skill = mysqli_query( $conn, $sql_skill );
			while ( $row_skill = mysqli_fetch_assoc( $result_skill ) ) {
				?>
			<h3>
				<?php echo $row_skill['Name_skill'];?>:</h3>
			<p>
				<?php  echo $row_skill['projects_overview']; ?>
			</p>
			<?php
			}
			?>
		</div>

	</div>
</body>
</html>