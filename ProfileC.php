<?php
include( 'connect.php' );
session_start();

$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];

if ( !is_null( $_GET[ 'id' ] ) ) {
	 $ID = $_GET[ 'id' ];
	 $T = $_GET[ 'T' ];	
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-control" content="no-cache">
<title>UI Profile Card</title>
<link rel="stylesheet" href="profileC/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="profileC/header.css" rel="stylesheet" type="text/css">
<link href="profileC/SWP.css" rel="stylesheet" type="text/css">
<link href="profileC/menu.css" rel="stylesheet" type="text/css">
</head>
<body>
<nav>
  <input type="checkbox" id="nav" class="hidden">
  <label for="nav" class="nav-btn"><i></i><i></i><i></i></label>
  <div class="header" >
    <ul class="menu">
      <li><a href="project.php">Browse Projects</a></li>
      <li><a href="chat.php" class="login">Chat</a></li>
    </ul>
  </div>
  <div class="text middle"> <span>S</span> <span class="hidden_logo">i</span> <span class="hidden_logo">m</span> <span class="hidden_logo">p</span> <span class="hidden_logo">l</span> <span class="hidden_logo">e</span> <span>W</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">k</span> <span>P</span> <span class="hidden_logo">l</span> <span class="hidden_logo">a</span> <span class="hidden_logo">t</span> <span class="hidden_logo">f</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">m</span> </div>
</nav>
<div class="container">
<div class="cover-photo"> <img src="profileC/s3.png" class="profile"> </div>
	<?php
	$sql="select * from client where ID=$ID";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	?>
<div class="profile-name"><?php echo $row['F_name']." ".$row['S_name'];   ?></div>

<div class="nav">
  <h4><?php  echo $row['Date_Birth'];?></h4>
	<?php
	$sql_count="select count(ID_client) as count from project where ID_client=$ID";
			$result_count=mysqli_query($conn,$sql_count);
			$row_count=mysqli_fetch_assoc($result_count);
			?>
  <h4>Number of projects submitted: <?php echo $row_count['count']; ?> </h4>
</div>
<div class="login">
<form>
</div>
<input type="checkbox" name="">
<div class="toggle">+</div>
<div class="imgBx"></div>
<div class="details">
  <p>
	  <?php  
	  if(is_null($row['note']))
		 echo "<h3>NO NOTES<?h3>";
	   else
		 echo $row['note'];
	  
	  ?></p>
</div>
</div>
</body>
</html>
