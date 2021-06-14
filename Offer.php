<?php
include( 'connect.php' );
session_start();
$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];
if($ID==null){
	echo "<script>window.alert('You must log in to continue')</script>";
	echo "<script>window.location.href='index.html'</script>";
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Cache-control" content="no-cache">
	<title>Offers</title>
	<link href="Offers/header.css" rel="stylesheet" type="text/css">
	<link href="Offers/menu.css" rel="stylesheet" type="text/css">
	<link href="Offers/SWP.css" rel="stylesheet" type="text/css">
	<link href="Offers/Offer.css" rel="stylesheet" type="text/css">
</head>

<body>
	<header>
		<nav>
			<input type="checkbox" id="nav" class="hidden">
			<label for="nav" class="nav-btn"><i></i><i></i><i></i></label>
			<div class="header">
				<ul class="menu">

					<li><a href="project.php">Browse Projects</a>
					</li>
					<?php
					if ( $T == 'w' ) {
							echo '<li><a href="ProfileW.php" class="login">profile</a></li>';
						}
						//if the user is Client
						else {
							echo '<li><a href="ProfileC.php">profile</a></li>';
						}
							?>
				</ul>
			</div>
			<div class="text middle"> <span>S</span> <span class="hidden_logo">i</span> <span class="hidden_logo">m</span> <span class="hidden_logo">p</span> <span class="hidden_logo">l</span> <span class="hidden_logo">e</span> <span>W</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">k</span> <span>P</span> <span class="hidden_logo">l</span> <span class="hidden_logo">a</span> <span class="hidden_logo">t</span> <span class="hidden_logo">f</span> <span class="hidden_logo">o</span> <span class="hidden_logo">r</span> <span class="hidden_logo">m</span> </div>
		</nav>
	</header>
	<?php
	$query_project = "select  * from project where ID_project=" . $_GET[ 'id' ];
	$result_query_project = mysqli_query( $conn, $query_project );
	$row = $result_query_project->fetch_assoc();
	?>
	<h1>
		<?php echo $row['short_discration'];  ?>
	</h1>
	<span class="information">Delevary time:</span>
	<span class="data">
		<?php echo $row['Delevary_time']." "; ?>Day</span>
	<span class="information">lower Cost: </span>
	<span class="data">
		<?php echo $row['Lower_cost'];  ?>$</span>
	<span class="information">largest Cost: </span>
	<span class="data">
		<?php echo $row['Largest_cost']; ?>$</span>

	<div class="description">
		<h2>
			<?php
			$query_name_client = "select  F_name,S_name,T_name,ID from project,client where client.ID=project.ID_Client and ID_project=" . $_GET[ 'id' ];
			$result_name = mysqli_query( $conn, $query_name_client );
			while ( $row_name = mysqli_fetch_assoc( $result_name ) ) {
				$id_client= $row_name['ID'];
				echo "<a href='profilec.php?id=$id_client'>".$row_name[ 'F_name' ] . ' ' . $row_name[ 'S_name' ] . ' ' . $row_name[ 'T_name' ]."</a>";
			}
			?>
		</h2>
		<div class="align">
			<span class="Details">
				<?php echo $row['Detation'];  ?>
			</span>
		</div>
	</div>
	<div class="add">
		<h3>Offers:</h3>
		<?php
		$get_id = $_GET[ 'id' ];
		$sql_not_Offer = "select ID_worker from offer where ID_project=$get_id and ID_worker=$ID";
		$result_sql_not_offer = mysqli_query( $conn, $sql_not_Offer );
		if ( ( $T == 'w' ) && ( mysqli_num_rows( $result_sql_not_offer ) < 1 ) ) {
			$id_pro = $_GET[ 'id' ];
			echo "<a href='addOffer.php?id_pro=$id_pro'>Add offer</a>";
		}
		?>

	</div>
	<?php
	$query_Offer = "select Duration_implementation,offer.Cost,Ditails,ID_Client,offer.ID_worker from offer,project where offer.ID_project=project.ID_project and offer.ID_project=" . $_GET[ 'id' ];
	$result_query_Offer = mysqli_query( $conn, $query_Offer );
	while ( $row_Offer = mysqli_fetch_assoc( $result_query_Offer ) ) {
		$id_clien_Pro = $row_Offer[ 'ID_Client' ];
		$id_worker_offer=$row_Offer['ID_worker'];
		?>
	<div class="Offer">
		<?php
		$query_name_Wrker = "select ID,F_name,S_name,T_name,ID_offer,T from worker,offer where offer.ID_worker=worker.ID and ID_worker=$id_worker_offer and ID_project=" . $_GET[ 'id' ];
		$result_name_Worker = mysqli_query( $conn, $query_name_Wrker );
		while ( $row_name = mysqli_fetch_assoc( $result_name_Worker ) ) {
			$T_Worker = $row_name[ 'T' ];
			$id_worker = $row_name[ 'ID' ];

			?>
		<span class="name_pro">
			<a href="ProfileW.php?id=<?php echo $id_worker?>& T=<?php echo $T_Worker?>" class="">
			<?php 
			echo $row_name['F_name'] . ' ' . $row_name['S_name'] . ' ' . $row_name['T_name'];
			 $id_worker=$row_name['ID'];
                break;
            }
			?>
			</a>
		</span>
	
		<p>
			<?php echo $details=$row_Offer['Ditails']; ?>
		</p>
		<span class="cost">Cost:</span>
		<span class="data_cost">
			<?php echo $cost=$row_Offer['Cost']; ?> </span>
		<span class="Delivery_time">Delivery time:</span>
		<span class="data_Delivery_time">
			<?php echo $Delivery_time=$row_Offer['Duration_implementation']; ?>
		</span>
		<span class="day">Day</span>
		<?php
		if ( ( $T == 'c' ) && ( $ID == $id_clien_Pro ) ) {
			//echo "<a href='#' class='button_offer'>Chat</a>";
			$id_pro = $_GET[ 'id' ];
			$id_offer = $row_name[ 'ID_offer' ];
			echo "<a href='Reservation.php?cost=$cost & delivery=$Delivery_time & id_pro=$id_pro & id_worker=$id_worker &id_offer=$id_offer' class='button_offer'>accept</a>";
		}
		?>
	</div>
	<br>
	<?php
	}
	?>
</body>
</html>