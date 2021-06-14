<?php
include( 'connect.php' );
session_start();
$ID = $_SESSION[ 'ID' ];
$T = $_SESSION[ 'T' ];
$id_project=$_GET['id_project'];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="Delivery/Delivery.css" rel="stylesheet" type="text/css">
	<script src="jquery-3.1.1.js"></script>
	<script src="Delivery.js"></script>
</head>

<body>
<span class="title">Delivery project</span> <br>
<span class="title thanks">Thanks You For Completing The Project</span>
<div class="container">
	<input type="hidden" value='<?php echo $id_project;?>' id="id">
  <form action="javascript:upload_file()" method="post" enctype="multipart/form-data">
    <input type="text" class="textfile" id="textfile" readonly >
    <label> <h3 class="inputfile">click to Choose a file</h3>
      <input type="file" id="file" hidden="none"  name="file"  class="file" onchange="copyname(this)">
    </label>
    <button type="submit" class="upload_file" name="upload_file" id="upload_file">upload file</button>
  </form>
</div>
</body>
</html>
<script>
	function copyname( element ) {
		var file = element.files;
		document.getElementById( 'textfile' ).value = file[0].name;
	}
</script>