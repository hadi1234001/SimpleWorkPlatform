<?php
include( 'connect.php' );
session_start();
$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];
$id;
if ( is_null( $_POST[ 'id' ] ) ) {
	$id = $_GET[ 'id' ];
} else {
	$id = $_POST[ 'id' ];
}

//check for report and show read zoon
$sql_check = "select hide,Reason,Reporting_person from chat_room,report,reason_for_reporting where chat_room.ID_room=$id and report.ID_room=chat_room.ID_room and report.ID_reasin=reason_for_reporting.ID_reasin order by Reporting_person desc";
$res_check = mysqli_query( $conn, $sql_check );
$row = mysqli_fetch_assoc( $res_check );
$reason = $row[ 'Reason' ];
if ( $row[ 'hide' ] == 1 ) {
	echo '<div class="redzon">	
			<span class="error">';
	if ( $ID == $row[ 'Reporting_person' ] ) {
		echo( 'You have reported this person. Do you want to unblock it?
		<a href="unblock.php?id_room=' . $id . '">Click to unblock</a>
		' );
	} else {
		echo 'You cannot contact this person
			You have been notified by him Because:<B>' . $reason . '
			</B>.
			<br>
			You can submit a request to the site, go to the following link:
			<a href="request.php?id_room=' . $id . '" >click</a>
			</span>';
	}
	echo '</div>';
}
//End
else {
	//upload file
	if ( $_FILES[ "file" ] > 0 ) {
		$file = rand() . '_' . $_FILES[ "file" ][ "name" ];
		$target_file = "file/" . $file;
		move_uploaded_file( $_FILES[ "file" ][ "tmp_name" ], $target_file );
		$sql_file = "INSERT INTO message (Message, Sender_number, File, Send_date, ID_room,T,status) VALUES (NULL, $ID, '$file', NOW(),$id,'$T',0) ";
		$result_upload_file = mysqli_query( $conn, $sql_file );
	}
	//send message
	if ( isset( $_POST[ 'msg' ] ) ) {
		$msg = addslashes( $_POST[ 'msg' ] );
		$result_insert = mysqli_query( $conn, "INSERT INTO message (Message, Sender_number, File, Send_date, ID_room,T,status) VALUES ('$msg', $ID, null, NOW(),$id,'$T',0)" );
	}

	//show mwssage
	$query = mysqli_query( $conn, "select Message,Send_date,T,file,Sender_number,report from message,chat_room where message.ID_room=chat_room.ID_room and message.ID_room=$id order by Send_date" );

	//Read a messages
	if ( $T == 'c' )
		$query_status = "update message set status=1 where ID_room=$id and T='w'";
	else
		$query_status = "update message set status=1 where ID_room=$id and T='c'";

	$result_status = mysqli_query( $conn, $query_status );


	//show  Message
	while ( $row = mysqli_fetch_array( $query ) ) {
		//show repor in chat
		$rep = $row[ 'report' ];
		$sql_report_D = "select * from report where ID_report= $rep";
		$res_report_D = mysqli_query( $conn, $sql_report_D );
		$row_report_D = mysqli_fetch_assoc( $res_report_D );
		$text_rep='<span class="reporting">reporting:' . $row_report_D[ 'Date_of_repoting' ] . '</span>';
		//End
		if ( $row[ 'T' ] == 'c' ) {
			echo '<div class="my_message">';
			if ( is_null( $row[ 'Message' ] ) ) {
				echo '<a href="file/' . $row[ 'file' ] . '"> ' . $row[ 'file' ] . '</a>';
				if ( $row_report_D['T']=='c') {
				echo $text_rep;
				}
			} else
				echo $row[ 'Message' ];
			echo '</div>';
		}
		//to send project in chat or Message or File or Report
		else if ( $row[ 'T' ] == 'w' ) {
			$sql_file_project = "select project.ID_project,project.ID_Client,project.ID_worker from project,offer,chat_room where chat_room.ID_offer=offer.ID_offer and project.ID_project=offer.ID_project and ID_room=$id";
			$res_file_project = mysqli_query( $conn, $sql_file_project );
			$row_file_project = mysqli_fetch_assoc( $res_file_project );

			echo '<div class="right"><div class="your_message">';
			if ( is_null( $row[ 'Message' ] ) ) {
				echo '<a href="file/' . $row[ 'file' ] . '">' . $row[ 'file' ] . '</a>';
				if ( is_null( $row[ 'file' ] ) && is_null( $row[ 'report' ] ) ) {
					echo '<span class="red">Project:</span> <a href="download.php?id_project=' . $row_file_project[ 'ID_project' ] . ' &id_worker=' . $row_file_project[ 'ID_worker' ] . ' &id_client=' . $row_file_project[ 'ID_Client' ] . '">Download Project</a>';
				}
				if ( $row_report_D['T']=='w') {
				echo $text_rep;
				}
			} else {
				echo $row[ 'Message' ];
			}
			echo '</div></div>';
			echo '<br>';
		}
		?>
		<br>
		<?php
		}
		}
		?>