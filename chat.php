<?php
include( 'connect.php' );
session_start();
$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];
//if the user is guest
if ( $ID == null ) {
	echo "<script>window.alert('You must log in to continue')</script>";
	echo "<script>window.location.href='index.html'</script>";
}
//projects
if ( isset( $_GET[ 'project' ] ) ) {
	$projects = $_GET[ 'project' ];
} else
	$projects = 'Underway';

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Cache-control" content="no-cache">
	<!--<meta http-equiv="refresh" content="8">-->
	<title>Untitled Document</title>
	<link href="chat/chat.css" rel="stylesheet" type="text/css">
	<link href="chat/header.css" rel="stylesheet" type="text/css">
	<link href="chat/menu.css" rel="stylesheet" type="text/css">
	<link href="chat/SWP.css" rel="stylesheet" type="text/css">
	<script src="jquery-3.1.1.js"></script>
	<script src="send.js"></script>
	<script src="uploadfile.js"></script>
	<script>
	</script>
	<nav>
		<input type="checkbox" id="nav" class="hidden">
		<label for="nav" class="nav-btn"><i></i><i></i><i></i></label>
		<div class="header">
			<ul class="menu">

				<li><a href="project.php">Browse Projects</a>
				</li>
				<?php
				if ( $T == 'c' ) {
					echo '<li><a href="Profilec.php" class="login">Profile</a>';
				} else
					echo '<li><a href="ProfileW.php" class="login">Profile</a>';
				?>
				</li>
			</ul>
		</div>
		<div class="text middle"><span>S</span><span class="hidden_logo">i</span><span class="hidden_logo">m</span><span class="hidden_logo">p</span><span class="hidden_logo">l</span><span class="hidden_logo">e</span><span>W</span><span class="hidden_logo">o</span><span class="hidden_logo">r</span><span class="hidden_logo">k</span><span>P</span><span class="hidden_logo">l</span><span class="hidden_logo">a</span><span class="hidden_logo">t</span><span class="hidden_logo">f</span><span class="hidden_logo">o</span><span class="hidden_logo">r</span><span class="hidden_logo">m</span>
		</div>
	</nav>
</head>

<body>
	<div class="personal ">
		<?php
		if ( $projects == 'Underway' ) {
			echo '<a href="chat.php?project=Underway" class="projects clicked">Underway</a>';
			echo '<a href="chat.php?project=Done" class="projects">Done</a>';

		} elseif ( $projects == 'Done' ) {
			echo '<a href="chat.php?project=Underway" class="projects">Underway</a>';
			echo '<a href="chat.php?project=Done" class="projects clicked">Done</a>';

		}
		else {
			echo '<a href="chat.php?project=Underway" class="projects">Underway</a>';
			echo '<a href="chat.php?project=Done" class="projects">Done</a>';
		}
		?>
		<h2 class="title">Chats:</h2>
		<?php
		//name personx
		if ( $projects == 'Underway' ) {
			if ( $T == 'c' ) {
				$sql_chat_room = "select  hide,worker.ID,worker.F_name,worker.S_name,worker.T_name,ID_room,worker.T,project.short_discration from client,chat_room,offer,project,worker where
        chat_room.ID_Client=client.ID and chat_room.ID_offer=offer.ID_offer and project.ID_project=offer.ID_project and offer.ID_worker=worker.ID and chat_room.ID_client=$ID  and project.assessment is  null";
			} else {
				$sql_chat_room = "select  hide,client.ID,client.F_name,client.S_name,client.T_name,ID_room,client.T,project.short_discration from client,chat_room,offer,project,worker where
        chat_room.ID_Client=client.ID and chat_room.ID_offer=offer.ID_offer and project.ID_project=offer.ID_project and offer.ID_worker=worker.ID and chat_room.ID_worker=$ID  and project.assessment is  null";
			}
		} elseif ( $projects == 'Done' ) {
			if ( $T == 'c' ) {
				$sql_chat_room = "select  hide,worker.ID,worker.F_name,worker.S_name,worker.T_name,ID_room,worker.T,project.short_discration from client,chat_room,offer,project,worker where
        chat_room.ID_Client=client.ID and chat_room.ID_offer=offer.ID_offer and project.ID_project=offer.ID_project and offer.ID_worker=worker.ID and chat_room.ID_client=$ID  and project.assessment is not null";
			} else {
				$sql_chat_room = "select  hide,client.ID,client.F_name,client.S_name,client.T_name,ID_room,client.T,project.short_discration from client,chat_room,offer,project,worker where
        chat_room.ID_Client=client.ID and chat_room.ID_offer=offer.ID_offer and project.ID_project=offer.ID_project and offer.ID_worker=worker.ID and chat_room.ID_worker=$ID  and project.assessment is not null";
			}
		}
		$result = mysqli_query( $conn, $sql_chat_room );
		
		$new_id = $_GET[ 'new_id' ];
		while ( $row = mysqli_fetch_assoc( $result ) ) {
			$id_room = $row[ 'ID_room' ];
			$id_person = $row[ 'ID' ];
			$T_person = $row[ 'T' ];
			?>
		<?php
		//move chat
		if ( $new_id == $id_room ) {
			echo '<a href=chat.php?new_id=' . $id_room . '&id_person=' . $id_person . '&T=' . $T_person . '&project=' . $projects . '><div class="one php">';
		} else {
			echo '<a href=chat.php?new_id=' . $id_room . '&id_person=' . $id_person . '&T=' . $T_person . '&project=' . $projects . '><div class="one">';
		}
		?>
		<img src="chat/s3.png" class="image_person">
		<h3 class="title name">
			<?php  echo $row['F_name']." ".$row['S_name']." ".$row['T_name']; ?>
		</h3>
		<h4 class="title name_pro"><?php echo $row[ 'short_discration' ];?></h4>
	</div>
	<div class="space"></div>
	</a>
	<?php
		}
	?>
	</div>
	<div class="chat">
		<div class="information"><img src="chat/s3.png" class="image_person chat_person">
			<?php
			if ( !is_null( $new_id ) ) {
				?>
			<span class="report"><a href="report.php?id_room=<?php echo $new_id;?>">Report</a></span>
			<?php
			if ( $T == 'w' ) {
				$sql_details_upload="select offer.ID_offer,offer.ID_project from offer,project,chat_room where offer.ID_offer=chat_room.ID_offer and offer.ID_project=project.ID_project and id_room=$new_id";
				$res_details_pload=mysqli_query($conn,$sql_details_upload);
				$row_details_upload=mysqli_fetch_assoc($res_details_pload);
				?>
			<span class="report"><a href="Delivery.php?id_project=<?php echo $row_details_upload['ID_project'];?>&id_offer=<?php echo $row_details_upload['ID_offer']; ?>"><!--move to page to upload file -->
				<?php
					echo 'Submit the project';
					?>
				</a>
			</span>
			<?php
			}
			}
			?>
			<h3 class="title name_person">
				<?php 
                 if ($T=='w')
	                echo "<a href=profileC.php?id=".$id_person.">";
	              elseif($T=='c')
		            echo "<a href=profileW.php?id=".$id_person.">";
			    ?>
				<?php
				//name person
				$id_name = $_GET[ 'id_person' ];
				if ( $_GET[ 'T' ] == 'c' ) {
					$sql_person = "select * from client where ID=$id_name";
				} else {
					$sql_person = "select * from worker where ID=$id_name";
				}
				$result_sql_person = mysqli_query( $conn, $sql_person );
				//echo $sql_person;				
				$row_sql_person = mysqli_fetch_assoc( $result_sql_person );
				echo $row_sql_person[ 'F_name' ] . " " . $row_sql_person[ 'S_name' ] . " " . $row_sql_person[ 'T_name' ];
				?>
			</h3>
			</a>
		</div>
		<div class="message" id="result"></div>
		<?php
		//check for report
		$sql_check = "select hide  from chat_room where ID_room=$new_id";
		$res_check = mysqli_query( $conn, $sql_check );
		$row = mysqli_fetch_assoc( $res_check );
		?>
	</div>
	<div class="form">
		<?php
		//if the chat room isn't hide dont show chat area 
		if ( $row[ 'hide' ] == 0 ) {
			?>
		<div class="text_message">
			<textarea class="text_message" id="msg"></textarea>
		</div>
		<button type="button" id="send_msg">Send</button>
		<form action="javascript:upload_file()" method="post" enctype="multipart/form-data">
			<label><img src="chat/upload.png" class="img_upload">
				<input  type="file" id="file" hidden="none" name="file" onchange="copyname(this)"></label>
			<button type="submit" class="upload_file" name="upload_file" id="upload_file">upload file</button>
		</form>
	</div>
	<?php
	}
		//End
	?>
	<input type="hidden" value='<?php echo $new_id;?>' id="id">
</body>
</html>
<script>
	<?php
	if($row['hide']==0){
	?>
	setInterval( () => {
		$( "#result" ).load( 'load.php?id_room=<?php echo $new_id ?>' );
	}, 3000 );
	<?php
		}
	?>
	function copyname( element ) {
		var file = element.files;
		document.getElementById( 'msg' ).value = file[0].name;
	}
</script>


