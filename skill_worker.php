<?php
include( 'connect.php' );
session_start();
$id = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];


$sql = "select Name_skill,skill_worker.ID_skill from skill_worker,skill where ID_worker=$id AND skill.ID_skill=skill_worker.ID_skill";
$result = mysqli_query( $conn, $sql );

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Cache-control" content="no-cache">
	<title>Untitled Document</title>
	<link href="skill worder/skill worker.css" rel="stylesheet" type="text/css">
	<script src="jquery-3.1.1.js"></script>
	<script src="skill.js"></script>
</head>

<body>
	<span class="title page">Follow up the registration</span>
	
	<br>
	<?php
	while($row=mysqli_fetch_assoc($result)){
		?>
	<div class="divskill"><span class="title skill"><?php echo $row['Name_skill']; ?></span>
	</div>
	<div class="form">
		<span class="title number left"> Enter the number Projects: </span><input type="number" class="number_project" id="<?php echo $row['ID_skill']; ?>N"  max="5">
		<br>
		<span class="title number"> Enter the details Projects: </span>
		<br>
		<textarea class="textarea" id="<?php echo $row['ID_skill']; ?>T" maxlength="150">
		</textarea>
		<input type="hidden" value="<?php echo $row['ID_skill'];?>" class="id" id="<?php echo $row['ID_skill'];?>id">
	</div>
	<?php
	}
	?>
	<br>
	<button type="button" class="submit Exit" id="Exit">Exit</button>
	<button type="button" class="submit" id="send">Complet</button>
	
	
</body>
</html>