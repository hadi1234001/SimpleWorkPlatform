<?php
include( 'connect.php' );
session_start();
$ID = $_SESSION[ 'ID' ];

$sql = "select * from request order by ID_reqest desc";
$res = mysqli_query( $conn, $sql );

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link href="table_request/table_request.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h1>REQUESTS</h1>
	<table class="table">
		<tr>
			<th class="title id">ID</th>
			<th class="title name">NAME</th>
			<th class="title details">DETAILS</th>
			<th class="title seemore">See More</th>
		</tr>
		<tbody>
			<?php
			while ( $row = mysqli_fetch_assoc( $res ) ) {
				$id_reqest = $row[ 'ID_reqest' ];
				$T = $row[ 'T' ];	
				if ( $T == 'w' )
					$sql_info = "select F_name,S_name,T_name from worker,request where
       ID= any(select ID_requester from request where worker.ID=request.ID_requester) and ID_reqest= $id_reqest";
				else
					$sql_info = "select F_name,S_name from client,request where
ID=any(select ID_requester from request where client.ID=request.ID_requester) and ID_reqest= $id_reqest";
				//to show id requester
				$res_information = mysqli_query( $conn, $sql_info );
				$row_information = mysqli_fetch_assoc( $res_information );
				//echo $T;
				//echo("<hr>");
				//echo($sql_info);
				?>
			<tr>
				
				<td class="info">
					<?php echo $id_reqest;  ?>
				</td>
				<td class="info">
					<?php echo $row_information['F_name'].' '.$row_information['S_name'];  ?>
				</td>
				<td class="info">
					<?php echo $row['details'];  ?>
				</td>
				<td class="info"><a href="show_request.php?id_request=<?php echo $id_reqest; ?>">click</a>
				</td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</body>
</html>