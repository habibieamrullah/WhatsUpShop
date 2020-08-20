<?php
/*
Developed by Habibie
Email: habibieamrullah@gmail.com 
WhatsApp: 6287880334339
WebSite: https://webappdev.my.id
*/

/*
Step 1 : Create a database, and take a note of your database name
Step 2 : Create a database user and assign that user to that database, take a note of user name and password
Step 3 : Adjust database connection on line 20 to 22 based on your notes earlier
Step 4 : Adjust Admin Panel user name and password as you wish
Step 5 : Run the web, and login to your Admin Panel by accessing admin.php page
*/

//Admin panel credentials
$username = "admin";
$password = "admin";

//Database connection
$host = "localhost";
$databaseprefix = "whatsupshop_";

$databasename = "mydatabase";
$dbuser = "root";
$dbpassword = "";

$connection = mysqli_connect($host, $dbuser, $dbpassword, $databasename);
$connection->set_charset("utf8");

//Database table names
$tableconfig = $databaseprefix . "config";
$tableposts = $databaseprefix . "posts";
$tablecategories = $databaseprefix . "categories";
$tablemessages = $databaseprefix . "messages";

//Creating tables - config
mysqli_query($connection, "CREATE TABLE IF NOT EXISTS $tableconfig (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
config VARCHAR(150) NOT NULL,
value VARCHAR(1500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)");

//Creating tables - posts
mysqli_query($connection, "CREATE TABLE IF NOT EXISTS $tableposts (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
postid VARCHAR(70) NOT NULL,
catid INT(6) NOT NULL,
normalprice INT(6) NOT NULL,
discountprice INT(6) NOT NULL,
title VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
time VARCHAR(150) NOT NULL,
options VARCHAR(200) NOT NULL,
picture VARCHAR(150) NOT NULL,
content VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)");

//Creating tables - categories
mysqli_query($connection, "CREATE TABLE IF NOT EXISTS $tablecategories (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
category VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)");

//Creating tables - messages
mysqli_query($connection, "CREATE TABLE IF NOT EXISTS $tablemessages (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
date VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
message VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)");

//Default website config values
$websitetitle = "WhatsUpShop";
$maincolor = "#c04d7b";
$secondcolor = "#a9394c";
$about = "<p>Just another cool online shop.</p><p>Timing 7:00 AM to 9:00 PM</p><p>Free Delivery Within 10KM</p>";
$baseurl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$language = "en";
$logo = "";
$adminwhatsapp = "6287880334339";
$currencysymbol = "$";
$baseurl = str_replace("index.php", "", $baseurl);

//Generating default website config
$sql = "SELECT * FROM $tableconfig";
$result = mysqli_query($connection, $sql);

//Check if its blank
if(mysqli_num_rows($result) == 0){
	//Then generate default values
	$sql = "INSERT INTO $tableconfig (config, value) VALUES ('websitetitle', '$websitetitle');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('maincolor', '$maincolor');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('secondcolor', '$secondcolor');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('about', '$about');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('language', '$language');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('adminwhatsapp', '$adminwhatsapp');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('logo', '$logo');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('currencysymbol', '$currencysymbol');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('baseurl', '$baseurl');";
	
	mysqli_multi_query($connection, $sql);
}else{
	//Then load the website configurations
	while($row = mysqli_fetch_assoc($result)){
		switch($row["config"]){
			case "websitetitle" :
				$websitetitle = $row["value"];
				break;
			case "maincolor" :
				$maincolor = $row["value"];
				break;
			case "secondcolor" :
				$secondcolor = $row["value"];
				break;
			case "about" :
				$about = $row["value"];
				break;
			case "language" :
				$language = $row["value"];
				break;
			case "baseurl" :
				$baseurl = $row["value"];
				break;
			case "adminwhatsapp" :
				$adminwhatsapp = $row["value"];
				break;
			case "logo" :
				$logo = $row["value"];
				break;
			case "currencysymbol" :
				$currencysymbol = $row["value"];
				break;
		}
	}
}

//Creating pictures folder
if(!file_exists("pictures"))
	mkdir("pictures");
?>