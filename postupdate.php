<?php
include("config.php");
include("thumbnailgenerator.php");
include("uilang.php");

if(isset($_POST["editposttitle"]) && isset($_POST["id"])){
	$id = mysqli_real_escape_string($connection, $_POST["id"]);
	$posttitle = mysqli_real_escape_string($connection, $_POST["editposttitle"]);
	$catid = mysqli_real_escape_string($connection, $_POST["editcatid"]);
	$normalprice = mysqli_real_escape_string($connection, $_POST["editnormalprice"]);
	$discountprice = mysqli_real_escape_string($connection, $_POST["editdiscountprice"]);
	$content = mysqli_real_escape_string($connection, $_POST["editpostcontent"]);
	$moreoptions = mysqli_real_escape_string($connection, $_POST["moreoptions"]);
	$moreimages = mysqli_real_escape_string($connection, $_POST["moreimagesinput"]);
	
	if($posttitle != "" && $content != ""){
		
		$sql = "SELECT * FROM $tableposts WHERE id = $id";
		$result = mysqli_query($connection, $sql);
		if(mysqli_num_rows($result) > 0){
			
			$row = mysqli_fetch_assoc($result);
			
			$oldpicture = $row["picture"];
			
			//Picture upload
			if(isset($_FILES["newpicture"])){
				$maxsize = 524288;
				if($_FILES["newpicture"]["size"] == 0){
					$newpicture = $oldpicture;
				}else{
					if($_FILES['newpicture']['error'] > 0) { echo "<div class='alert'>" .uilang("Error during uploading. Try again"). "</div>"; }
					$extsAllowed = array( 'jpg', 'jpeg', 'png' );
					$uploadedfile = $_FILES["newpicture"]["name"];
					$extension = pathinfo($uploadedfile, PATHINFO_EXTENSION);
					if (in_array($extension, $extsAllowed) ) { 
						$newpicture = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 10);
						$name = "pictures/" . $newpicture .".". $extension;
						
						if(($_FILES['newpicture']['size'] >= $maxsize)){
							createThumbnail($_FILES['newpicture']['tmp_name'], "pictures/" . $newpicture .".". $extension, 512);
						}else{
							$result = move_uploaded_file($_FILES['newpicture']['tmp_name'], $name);
						}
						?>
						
						<div class="alert"><?php echo uilang("Picture upload is OK") ?>.</div>
						<?php
						$newpicture = $newpicture .".". $extension;
						
						//delete previous media
						if($oldpicture != ""){
						if(file_exists("pictures/" . $oldpicture))
							unlink("pictures/" . $oldpicture);
						}
					} else { 
						echo "<div class='alert'>".uilang("File is not valid. Please try again").".</div>";
						$newpicture = $oldpicture;
					}
				}
			}else{
				$newpicture = $oldpicture;
			}
			
			mysqli_query($connection, "UPDATE $tableposts SET title = '$posttitle', catid = $catid, content = '$content', picture = '$newpicture', normalprice='$normalprice', discountprice='$discountprice', options='$moreoptions', moreimages = '$moreimages' WHERE id = $id");
			echo "<div class='alert'>" .uilang("Post successfully updated."). "</div>";
		
		}
	}	
}