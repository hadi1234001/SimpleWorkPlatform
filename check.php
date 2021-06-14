<?php
include( 'connect.php' );
session_start();
$id = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];

$code = $_GET[ 'code' ];
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link href="check/check.css" rel="stylesheet" type="text/css">
	<script language="javascript" type="text/javascript">
		window.history.forward();
	</script>
</head>

<body>
	<div class="container">
		<?php
		if ( $T == 'w' )
			$sql = "select Email from worker where ID=$id";
		else
			$sql = "select Email from client where ID=$id";
		$result = mysqli_query( $conn, $sql );
		$row = mysqli_fetch_array( $result );
		$Error = $_GET[ 'Error' ];

		if ( $Error == 3 ) {
			echo "<script>window.alert('Enter login again')</script>";
			$_SESSION[ 'ID' ] = null;
			$_SESSION[ 'T' ] = null;
			if ( $T == 'w' ) {
				$sql_delete="delete from skill_worker where ID_worker=$id";
				mysqli_query($conn,$sql_delete);
				$sql = 'DELETE FROM worker WHERE ID =' . $id;
				header( 'location:loginW.php?' );
			} else {
				$sql = 'DELETE FROM client WHERE ID =' . $id;
				header( 'location:loginC.php?' );
			}
			$result = mysqli_query( $conn, $sql );
		}
		?>
		<span class="text">Enter the code send to Email: <?php echo $row['Email']; ?></span>
		<form action="check1.php?code=<?php echo $code ?>& Error=<?php echo $Error;?>" method="post" class="form">
			<input type="number" class="code" placeholder="123456" name="code">
			<button type="submit" class="btn">check</button>
		</form>
	</div>

</body>
</html>