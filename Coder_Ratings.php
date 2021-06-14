<?php
include( 'connect.php' );
session_start();

$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];
$id_person = $_GET[ 'id_person' ];

$sql_name="select F_name,S_name,T_name from worker where ID=$id_person";
$res_name=mysqli_query($conn,$sql_name);
$row_name=mysqli_fetch_assoc($res_name);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link href="Coder_Ratings/Coder_Ratings.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<a href="#" class="back" onClick="history.go(-1);">Back</a>
	<h1>Projects for <i><?php echo $row_name['F_name'].' '.$row_name['S_name'].' '.$row_name['T_name'] ?></i></h1>
	<table class="table">
		<tr>
			<th class="title id">Number</th>
			<th class="title name">NAME Client</th>
			<th class="title details">DETAILS Project</th>
			<th class="title stars">STARS</th>
		</tr>
		<tbody>
			<?php
			$sql = "select client.F_name,client.S_name,short_discration,assessment,ID_client from project,client where ID_worker=$id_person and file is not null and project.ID_client=client.ID";
			$res = mysqli_query( $conn, $sql );
			while ( $row = mysqli_fetch_assoc( $res ) ) {
				?>
			<tr>
				<td class="info">
					<?php echo mysqli_num_rows($res); ?>
				</td>
				<td class="info">
					<a href="ProfileC.php?id=<?php echo($row['ID_client']);?>"><?php echo $row['F_name'].' '.$row['S_name'];  ?></a>
				</td>
				<td class="info">
					<?php  echo $row['short_discration']; ?>
				</td>
				<td class="info">
					<?php
					for ( $i = 0; $i < $row[ 'assessment' ]; $i++ ) {
						echo '<span class="fa fa-star checked"></span>';
					}
					if ( $row[ 'assessment' ] < 5 ) {
						for ( $j = $row[ 'assessment' ]; $j < 5; $j++ ) {
							echo '<span class="fa fa-star checked_W"></span>';
						}
					}
					?>
				</td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</body>
</html>