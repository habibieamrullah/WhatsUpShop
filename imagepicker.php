<?php

include("config.php");
include("uilang.php");

$dirpath = "pictures/*";
$files = array();
$files = glob($dirpath);
usort($files, function($x, $y) {
	return filemtime($x) < filemtime($y);
});

foreach($files as $item){
	echo "<div style='display: inline-block; vertical-align: top; text-align: center;'>";
	echo "<div><img src='" .$baseurl. "/" . $item . "' height='128px' style='margin: 5px; border-radius: 5px; cursor: pointer;' onclick=insertthis('" . $item . "')></div>";
	echo "</div>";
}

echo "<p>Click <a class='textlink' href='?pictures'>here</a> to upload more additional images.</p>";