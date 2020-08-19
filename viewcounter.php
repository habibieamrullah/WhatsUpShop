<?php

include("config.php");
include("functions.php");

if(isset($_POST["postid"])){
	
    $postid = mysqli_real_escape_string($connection, $_POST["postid"]);
    $currentviewer = get_client_ip();
    $sql = "SELECT * FROM $tableposts WHERE postid = '$postid' AND lastviewer = '$currentviewer'";
    $result = mysqli_query($connection, $sql);
    
    if(mysqli_num_rows($result) == 0){
        $currentview = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM $tableposts WHERE postid = '$postid'"))["views"];
        $currentview++;
        mysqli_query($connection, "UPDATE $tableposts SET views = $currentview, lastviewer = '$currentviewer' WHERE postid = '$postid'");
    }
    
    echo "Viewed " . $postid . " by " . $currentviewer;
}