<?php

$con = mysqli_connect("localhost","user","password");//add username and password 
if (!$con)
	die('Could not connect : '.mysqli_error());
mysqli_select_db($con, "user");
?>
