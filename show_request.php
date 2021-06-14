<?php
include( 'connect.php' );
session_start();
$ID = $_SESSION[ 'ID' ];
$id_request = $_GET[ 'id_request' ];

$sql = "select ID_reqest,report.ID_room,short_discration,request.details from request,report,chat_room,offer,project where ID_reqest=$id_request and
report.ID_report=request.ID_report and chat_room.ID_room=report.ID_room and chat_room.ID_offer=offer.ID_offer and offer.ID_project=freelance.project.ID_project";
$res = mysqli_query( $conn, $sql );
$row = mysqli_fetch_assoc( $res );

$sql = "select ID,F_name,S_name,T_name from client where id=(select ID_requester from request where ID_requester=ID and ID_reqest=$id_request)";
$res = mysqli_query( $conn, $sql );
$row_requester = mysqli_fetch_assoc( $res );

$id_room = $row[ 'ID_room' ];
$sql = "select * from message where ID_room=$id_room";
$res_chat = mysqli_query( $conn, $sql );

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link href="show_request/show_request.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h1>REQUESTS</h1>
	<div class="details">
		<span class="title">The number of the requester :</span>
		<span class="title info">
			<?php echo $row_requester['ID'];  ?>
		</span>
		<br>
		<span class="title">The name of the requester :</span>
		<span class="title info">
			<?php echo $row_requester['F_name'].' '.$row_requester['S_name'].' '.$row_requester['T_name'];  ?>
		</span>
		<br>
		<span class="title">request number :</span>
		<span class="title info">
			<?php echo $row['ID_reqest'];  ?>
		</span>
		<br>
		<span class="title">request details :</span>
		<span class="title info">
			<?php echo $row['details'];  ?>
		</span>
		<br>
		<span class="title">Name project :</span>
		<span class="title info">
			<?php echo $row['short_discration'];  ?>
		</span>
		<br><span class="title">Number chat room :</span>
		<span class="title info">
			<?php echo $row['ID_room'];  ?>
		</span>
		<br>
		<button class="btn"><A a href="unblock.php?id_room=<?php echo($id_room);?>&admin=1">Unblock</A></button>
	</div>

	<div class="message" id="result">
		<div class="from">
			<?php
			$sql = "select F_name,S_name,T_name,ID from client where ID=(select ID_Client from chat_room where ID_room=$id_room )";
			$res_name = mysqli_query( $conn, $sql );
			$row_name = mysqli_fetch_assoc( $res_name );
			$id = $row_name[ 'ID' ];
			?>
			<a href="ProfileC.php?id=<?php echo $id;  ?>" class="align_C">
				<?php  echo $row_name['F_name'].' '.$row_name['S_name'].' '.$row_name['T_name'];?> </a>
			<?php
			$sql = "select F_name,S_name,T_name,ID from worker where ID=(select ID_worker from chat_room where ID_room=$id_room )";
			$res_name = mysqli_query( $conn, $sql );
			$row_name = mysqli_fetch_assoc( $res_name );
			$id = $row_name[ 'ID' ];
			?>
			<a href="ProfileW.php?id=<?php echo $id;  ?>" class="align_W">
				<?php  echo $row_name['F_name']	.' '.$row_name['S_name'].' '.$row_name['T_name'];  ?>
			</a>

		</div>
		<br>
		<?php
		while ( $row_chat = mysqli_fetch_assoc( $res_chat ) ) {
			echo( '<br>' );
			if ( $row_chat[ 'T' ] == 'c' ) {
				echo '<div class="my_message">';
				if ( is_null( $row_chat[ 'Message' ] ) ) {
					echo '<a href="file/' . $row_chat[ 'File' ] . '"> ' . $row_chat[ 'File' ] . '</a>';
				} else
					echo $row_chat[ 'Message' ];
				echo '</div>';
			}
			if ( $row_chat[ 'T' ] == 'w' ) {
				$sql_file_project = "select project.ID_project,file from project,offer,chat_room where chat_room.ID_offer=offer.ID_offer and project.ID_project=offer.ID_project and ID_room=$id_room";
				$res_file_project = mysqli_query( $conn, $sql_file_project );
				$row_file_project = mysqli_fetch_assoc( $res_file_project );

				echo '<div class="right"><div class="your_message">';
				if ( is_null( $row_chat[ 'Message' ] ) ) {
					echo '<a href="file/' . $row_chat[ 'File' ] . '">' . $row_chat[ 'File' ] . '</a>';
					if ( is_null( $row_chat[ 'File' ] ) ) {
						echo '<span class="red">Project:</span> <a href="Ready_projects/' . $row_file_project[ 'file' ] . '">' . $row_file_project[ 'file' ] . '</a>';
					}
				} else {
					echo $row_chat[ 'Message' ];
				}

				echo '</div></div>';
				echo '<br>';
			}
		}
		?>
	</div>
</body>
</html>