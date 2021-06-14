<?php
include( 'connect.php' );

session_start();
$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];


//Divide projects into pages
//Page: is GET in URL 
//$_GET:Used to transfer information from one page to another visually
if ( isset( $_GET[ 'page' ] ) ) {
	$page = $_GET[ 'page' ];
} else {
	$page = 1;
}
//The number of results per page
$result_per_page = 6;
$start_from = ( $page - 1 ) * $result_per_page;
//Inquiries to recover all unreserved projects
$sql_project = "SELECT * FROM project where ID_worker IS NULL ORDER BY ID_project desc LIMIT $start_from,$result_per_page ";
$result = mysqli_query( $conn, $sql_project );
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Cache-control" content="no-cache">
	<title>Untitled Document</title>
	<link href="Projects/project.css" rel="stylesheet" type="text/css">
	<link href="Projects/header.css" rel="stylesheet" type="text/css">
	<link href="Projects/menu.css" rel="stylesheet" type="text/css">
	<link href="Projects/SWP.css" rel="stylesheet" type="text/css">
	<link href="Projects/bar.css" rel="stylesheet" type="text/css">
	<link href="Projects/skill.css" rel="stylesheet" type="text/css">
	<script src="jquery-3.1.1.js"></script>

</head>

<body>
	<header>
		<nav>
			<input type="checkbox" id="nav" class="hidden">
			<label for="nav" class="nav-btn"><i></i><i></i><i></i></label>
			<div class="header">
				<ul class="menu">
					<li><a href="chat.php">chat <span class="number_message" id="number_message"></span></a>
					</li>
					<?php
					// If the user enters to browse projects
					if ( $ID == null ) {
						echo "";
					} else {
						//if the user is Worker
						if ( $T == 'w' ) {
							echo '<li><a href="ProfileW.php" class="login">profile</a></li>';
						}
						//if the user is Client
						else {
							echo '<li><a href="ProfileC.php">profile</a></li>';
							echo '<li><a href="add.php" class="login">ADD Project</a>';
						}
					}
					?>
					</li>
				</ul>
			</div>
			<div class="text middle"> <span>S</span> <span class="hidden_logo">i</span> <span class="hidden_logo">m</span> <span class="hidden_logo">p</span> <span class="hidden_logo">l</span> <span class="hidden_logo">e</span> <span>W</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">k</span> <span>P</span> <span class="hidden_logo">l</span> <span class="hidden_logo">a</span> <span class="hidden_logo">t</span> <span class="hidden_logo">f</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">m</span> </div>
		</nav>
	</header>
	<div class="skill">
		<div class="select" tabindex="1">
			<?php
			//Classification of projects
			$query_Skill = "select * from skill";
			$result_query_skill = mysqli_query( $conn, $query_Skill );
			//To print all results
			while ( $row_skill = mysqli_fetch_assoc( $result_query_skill ) ) {
				?>
			<input class="selectopt" name="test" type="radio" id="opt<?php echo $row_skill[ 'ID_skill' ]; ?>" checked>
			<label for="opt<?php echo $row_skill[ 'ID_skill' ]; ?>" class="option">
                <a href="project.php?link=<?php echo $row_skill[ 'ID_skill' ]; ?>" name="link1">
					<?php echo $row_skill[ 'Name_skill' ]; ?></a></label>
		
			<?php
			//chang the query By choosing a rating When the results of the database are similar to link
			if ( $_GET[ 'link' ] == $row_skill[ 'ID_skill' ] ) {
				$skill = $row_skill[ 'ID_skill' ];
				$name_skill = $row_skill[ 'Name_skill' ];
				$sql_project = "SELECT * FROM project where ID_worker IS NULL and ID_skill=$skill ORDER BY ID_project desc LIMIT $start_from,$result_per_page";
				$result = mysqli_query( $conn, $sql_project );
			}
			}
			?>
		</div>
	</div>
	<h1>Projects<?php echo " ".$name_skill;?></h1>
	<?php
	//to print all Peojects
	while ( $row_project = mysqli_fetch_assoc( $result ) ) {
		$id_pro = $row_project[ 'ID_project' ];
		?>
	<div class="show">
		<div class="one">
			<?php
			//Knowing the details of the project owner
			$query_name_client = "select F_name,S_name,T_name from project,client where client.ID=project.ID_Client and ID_project=$id_pro";
			$result_name = mysqli_query( $conn, $query_name_client );
			?>
			<span id="one">
				<?php 
		        //Print name
	           	while ( $row_name = mysqli_fetch_assoc( $result_name ) ) {
		     	echo $row_name[ 'F_name' ] . ' ' . $row_name[ 'S_name' ] . ' ' . $row_name[ 'T_name' ];
			    break;
		    }  
				?>
			</span>
		</div>
		<div class="tow">
			<span id="Prief_description">
				<?php echo $row_project['short_discration'];?>
			</span>
		</div>
		<div class="three">
			<span id="three">Delevary time:<?php echo "   ".$row_project['Delevary_time'];?></span>
		</div>

		<div class="four">
			<span id="four">Lower cost:<?php echo "  ".$row_project['Lower_cost'];?>$</span>
		</div>

		<div class="five">
			<span id="five">Largest cost:<?php echo "   ".$row_project['Largest_cost'];?>$</span>
		</div>
		<a href='Offer.php?id=<?php echo $row_project[ 'ID_project' ] ; ?>'>see more</a>
	</div>
	<?php
	}
	?>
	<div>
		<ul class="pagination modal-5">
			<?php
			//To know the number of projects "total"
			if ( is_null( $skill ) ) {
				$sql_page = "select COUNT(ID_project) AS total FROM project where ID_worker IS NULL";
			} else {
				$sql_page = "select COUNT(ID_project) AS total FROM project where ID_skill=$skill and ID_worker IS NULL";
			}
			$result = $conn->query( $sql_page );
			$row = $result->fetch_assoc();
			//To see the number of pages
			//ceil: Round numbers to nearest whole number:
			$total_pages = ceil( $row[ 'total' ] / $result_per_page );
			?>
			<?php
			//Print the existing page numbers
			$i = 1;
			//one page
			if ( is_null( $_GET[ 'page' ] ) ) {
				echo "<a href='project.php?page=1' class='active'>1</a>";
				//Do not repeat the number 1
				$i = 2;
			}
			//all pages number
			for ( $i; $i <= $total_pages; $i++ ) {
				$href1 = "<a href='project.php?page=$i &link=$skill'>$i</a> ";
				?>
			<li>
				<?php 
				// To highlight the page on which it is located
				if (($_GET['page']==$i)){
				    $href = "<a href='project.php?page=$i' class='active'>$i</a> ";				
					echo $href;
					}
				else{
					echo $href1;
				}
				?>
			</li>
			<?php
			};
			?>
	</div>
	<script>
		/*
								message();
								setInterval( function () {
									message();
								}, 5000 );

								function message() {
									$.ajax( {
										url: "number_message.php",
										method: "POST",
											$( "#number_message" ).html( data );
										}
													} )
												}
												*/
		setInterval( () => {
			$( "#number_message" ).load( 'number_message.php' )
		}, 3000 );	
	
	</script>
</body>
</html>