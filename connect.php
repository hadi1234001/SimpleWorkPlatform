<?php
$conn=mysqli_connect("localhost","root","12345678","freelance");
if(!$conn){
	echo(mysqli_connect_errno());
}