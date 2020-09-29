<?php

include("config.php");

if(isset($_POST["message"])){
	$message = mysqli_real_escape_string($connection, $_POST["message"]);
	$currenttime = round(microtime(true) * 1000);
	mysqli_query($connection, "INSERT INTO $tablemessages (date, message) VALUES ('$currenttime', '$message')");
}

?>