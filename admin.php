<?php
/*
Developed by Habibie
Email: habibieamrullah@gmail.com 
WhatsApp: 6287880334339
WebSite: https://webappdev.my.id
*/

session_start();
include("config.php");
include("functions.php");
include("uilang.php");

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Admin Panel | <?php echo $websitetitle ?></title>
		<meta charset="utf-8">
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="<?php echo $baseurl ?>favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo $baseurl ?>favicon.ico" type="image/x-icon">
		<script src="jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
		
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>assets/css/font-awesome.css">
		
		<script src="tinymce/tinymce.min.js"></script>
		<script>
			tinymce.init({ selector : 'textarea' , plugins : 'directionality, code', toolbar : 'ltr rtl, code', relative_urls: false, remove_script_host : false, });
		</script>
		<script src="jquery.form.js"></script>
		<script src="jscolor.js"></script>
		<script src="<?php echo $baseurl ?>somefunctions.js"></script>
		<?php include("style.php"); ?>
		<style>
			body{
				padding: 0px;
				margin: 0px;
			}
			.adminleftbaritem{
				padding: 10px;
				border-bottom: 1px solid #2e2e2e;
				cursor: pointer;
			}
			.adminleftbaritem:hover{
				background-color: white;
				color: black;
				transition: background-color .5s;
			}
			
			.bar{
				background-color: <?php echo $maincolor ?>; 
				display: block;
				height: 3px;
				border-radius: 10px;
				width: 0;
			}
		</style>
	</head>
	<body>
		<div class="barsbutton" onclick="toggleadminmenu()"><i class="fa fa-bars"></i></div>
		<?php
		//if admin logged in
		if(isset($_SESSION["adminusername"]) && isset($_SESSION["adminpassword"])){
			if($username == $_SESSION["adminusername"] && $password == $_SESSION["adminpassword"]){
				?>
				
				<div style="display: table; position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; height: 100%;">
					<div style="display: table-row; height: 100%;">
						<div class="adminmenubar">
							<div class="stickythingy">
								<div style="padding: 40px;">
									<?php
									$currentlogo = "images/logo.png";
									if($logo != ""){
										$currentlogo = "pictures/" . $logo;
									}
									?>
									<a target="_blank" href="<?php echo $baseurl ?>"><img src="<?php echo $currentlogo ?>" style="display: border-box; width: 100%;"></a>
								</div>
								<a href="<?php echo $baseurl ?>admin.php"><div class="adminleftbaritem"><i class="fa fa-home" style="width: 30px;"></i> <?php echo uilang("Home") ?></div></a>
								<a href="<?php echo $baseurl ?>admin.php?newpost"><div class="adminleftbaritem"><i class="fa fa-plus" style="width: 30px;"></i> <?php echo uilang("Add Product") ?></div></a>
								<a href="<?php echo $baseurl ?>admin.php?pictures"><div class="adminleftbaritem"><i class="fa fa-image" style="width: 30px;"></i> <?php echo uilang("Pictures") ?></div></a>
								<a href="<?php echo $baseurl ?>admin.php?categories"><div class="adminleftbaritem"><i class="fa fa-tag" style="width: 30px;"></i> <?php echo uilang("Categories") ?></div></a>
								<a href="<?php echo $baseurl ?>admin.php?orders"><div class="adminleftbaritem"><i class="fa fa-file-text" style="width: 30px;"></i> <?php echo uilang("Orders") ?></div></a>
								<a href="<?php echo $baseurl ?>admin.php?settings"><div class="adminleftbaritem"><i class="fa fa-cogs" style="width: 30px;"></i> <?php echo uilang("Settings") ?></div></a>
								<a href="<?php echo $baseurl ?>admin.php?logout"><div class="adminleftbaritem"><i class="fa fa-sign-out" style="width: 30px;"></i> <?php echo uilang("Logout") ?></div></a>
								
								<div style="text-align: center; padding: 30px; font-size: 10px;"><?php echo uilang("Developed by") ?><br><a target="_blank" class="textlink" style="color: lime;" href="https://webappdev.my.id/">https://webappdev.my.id/</a><br><br>Donate to the author:<br><a href="https://www.paypal.me/habibieamrullah" class="textlink" style="color: lime;">https://www.paypal.me/habibieamrullah</a></div>
							</div>
						</div>
						<div style="display: table-cell; padding: 25px; vertical-align: top; border-left: 1px solid <?php echo $maincolor ?>; ">
							<?php
							//newpost
							if(isset($_GET["newpost"])){
								?>
								<div class="postform">
									<h1><?php echo uilang("Add Product") ?></h1>
									<form action="postupload.php" method="post" enctype="multipart/form-data">
										<label><i class="fa fa-edit"></i> <?php echo uilang("Title") ?></label>
										<input name="newposttitle" placeholder="<?php echo uilang("Title") ?>">
										<label><i class="fa fa-money"></i> <?php echo uilang("Price") ?></label>
										<input type="number" step="0.01" name="newpostnormalprice" placeholder="<?php echo uilang("Price") ?>">
										<label><i class="fa fa-money"></i> <?php echo uilang("Discount Price") ?></label>
										<input type="number" step="0.01" name="newpostdiscountprice" placeholder="<?php echo uilang("Discount Price") ?>">
										<label><i class="fa fa-tag"></i> <?php echo uilang("Category") ?></label>
										<select name="catid">
											<?php
											$catsql = "SELECT * FROM $tablecategories ORDER BY category ASC";
											$catresult = mysqli_query($connection, $catsql);
											if(mysqli_num_rows($catresult) > 0){
												while($catrow = mysqli_fetch_assoc($catresult)){
													?>
													<option value="<?php echo $catrow["id"] ?>"><?php echo $catrow["category"] ?></option>
													<?php
												}
											}
											?>
											<option value="0" selected="selected"><?php echo uilang("Uncategorized") ?></option>
										</select>
										<label><i class="fa fa-file"></i> <?php echo uilang("Content") ?></label>
										<textarea name="newpostcontent" style="height: 250px;"></textarea>
										<br><br>
										
										<label><i class="fa fa-image"></i> <?php echo uilang("Image File") ?></label>
										<input class="fileinput" name="newpicture" type="file" accept="image/jpeg, image/png">
										
										<label><i class="fa fa-image"></i> <?php echo uilang("Additional Images") ?></label>
										<div id="moreimagesvisual"></div>
										<input id="moreimagesinput" name="moreimagesinput" style="display: none;">
										<div class="buybutton" onclick="showimagepicker()"><i class="fa fa-plus"></i> <?php echo uilang("Add") ?></div>
										<br><br>
										
										<label><i class="fa fa-check-square-o"></i> <?php echo uilang("Add more options") ?></label>
										<input id="moreoptions" name="moreoptions" style="display: none">
										<div id="moreoptionsvisual" style="margin-bottom: 10px;"></div>
										<div id="moformbutton" class="buybutton" onclick="showmoform()"><i class="fa fa-plus"></i> <?php echo uilang("Add") ?></div>
										<div id="moform" style="border: 1px solid black; border-radius: 6px; padding: 20px; display: none;">
											<label><i class="fa fa-plus"></i> <?php echo uilang("Add new option title:") ?></label>
											<input placeholder="<?php echo uilang("Option Title") ?>" id="newoptiontitle">
											<div class="buybutton" onclick="addnewoptiontitle()"><i class="fa fa-plus"></i> <?php echo uilang("Add") ?></div>
											<div class="buybutton" onclick="closemoform()"><i class="fa fa-times"></i> <?php echo uilang("Close") ?></div>
										</div>
										<div id="moformedit" style="border: 1px solid black; border-radius: 6px; padding: 20px; display: none;">
											<h2><i class="fa fa-check-square-o"></i> <?php echo uilang("Edit") ?> <span id="motitletoedit"></span></h2>
											<div id="currentmochilds"></div>
											<label><?php echo uilang("Add new item for this option") ?></label>
											<input id="moitem" placeholder="<?php echo uilang("Add new item for this option") ?>">
											<label><?php echo uilang("Product price when this option is selected") ?></label>
											<input id="moprice" type="number" placeholder="<?php echo uilang("Price") ?>" value=0>
											<div class="buybutton" onclick="addcurrentmoitem()"><i class="fa fa-plus"></i> <?php echo uilang("Add") ?></div>
											<div class="buybutton" onclick="closemoeditform()"><i class="fa fa-times"></i> <?php echo uilang("Close") ?></div>
										</div>
										
										<br>
										<br>
										<br>
										<input type="submit" value="<?php echo uilang("Submit") ?>" class="submitbutton">
									</form>
									
									
									
								</div>
								<div class="progress" style="display: none">
									<div id="upploadprogresstitle">
										<h1><?php echo uilang("Upload progress") ?> <span class="percent">0%</span></h1>
										<div class="bar"></div>
									</div>
									<div id="status" style="margin-top: 30px;"></div>
								</div>
								
								<script>
									$(function() {

										var bar = $('.bar');
										var percent = $('.percent');
										var status = $('#status');

										$('form').ajaxForm({
											beforeSend: function() {
												status.empty();
												var percentVal = '0%';
												bar.width(percentVal);
												percent.html(percentVal);
												$(".progress").slideDown();
												$(".postform").slideUp();
											},
											uploadProgress: function(event, position, total, percentComplete) {
												var percentVal = percentComplete + '%';
												bar.width(percentVal);
												percent.html(percentVal);
											},
											complete: function(xhr) {
												status.html(xhr.responseText);
											}
										});
									}); 
								</script>
								<?php
							
							}
							//pictures
							else if(isset($_GET["pictures"])){
								?>
								<h1><?php echo uilang("Pictures") ?></h1>
								<?php
								
								if(isset($_GET["delete"])){
									if(file_exists("pictures/" . $_GET["delete"])){
										unlink("pictures/" . $_GET["delete"]);
										echo "<div class='alert'>" . uilang("A picture has been deleted.") . "</div>";
									}
								}
								
								if(isset($_POST["submitmorepictures"])){
									
									include("thumbnailgenerator.php");
									
									$files = array_filter($_FILES['newmorepicture']['name']);
									$total = count($files);
									
									$hasfile = false;

									// Loop through each file
									for( $i=0 ; $i < $total ; $i++ ) {

										//Get the temp file path
										$tmpFilePath = $_FILES['newmorepicture']['tmp_name'][$i];

										//Make sure we have a file path
										if ($tmpFilePath != ""){
										  
										  
											$maxsize = 524288;
											
											$extsAllowed = array( 'jpg', 'jpeg', 'png' );
											$uploadedfile = $_FILES['newmorepicture']['name'][$i];
											$extension = pathinfo($uploadedfile, PATHINFO_EXTENSION);
											if (in_array($extension, $extsAllowed) ) { 
												$newpicture = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 10);
												$name = "pictures/" . $newpicture .".". $extension;
												
												if(($_FILES['newmorepicture']['size'][$i] >= $maxsize)){
													createThumbnail($_FILES['newmorepicture']['tmp_name'][$i], "pictures/" . $newpicture .".". $extension, 512);
												}else{
													$result = move_uploaded_file($_FILES['newmorepicture']['tmp_name'][$i], $name);
												}
												
												$hasfile = true;
											}
										}
									}
									if($hasfile)
										echo "<div class='alert'>" . uilang("More picture(s) has been added.") . "</div>";
								}
								
								
								$dirpath = "pictures/*";
								$files = array();
								$files = glob($dirpath);
								usort($files, function($x, $y) {
									return filemtime($x) < filemtime($y);
								});
								
								foreach($files as $item){
									echo "<div style='display: inline-block; vertical-align: top; text-align: center;'>";
									echo "<div><img src='" .$baseurl. "/" . $item . "' height='128px' style='margin: 5px; border-radius: 5px; cursor: pointer;' onclick=showimage('" . $item . "')></div>";
									echo "<a class='textlink' href='?pictures&delete=" . explode("/", $item)[1] . "'><i class='fa fa-trash'></i> " . uilang("Delete") . "</a></div>";
								}
								
								?>
								<div style="margin-top: 50px">
									<form method="post" enctype="multipart/form-data">
										<label><i class="fa fa-image"></i> <?php echo uilang("Add more picture") ?></label>
										<input class="fileinput" name="newmorepicture[]" type="file" accept="image/jpeg, image/png" multiple="multiple">
										<input name = "submitmorepictures" type="submit" value="<?php echo uilang("Submit") ?>" class="submitbutton">
									</form>
								</div>
								<?php
								
							}
							//categories
							else if(isset($_GET["categories"])){
								?>
								<h1><?php echo uilang("Categories") ?></h1>
								<?php
								if(isset($_POST["newcategory"])){
									$newcategory = mysqli_real_escape_string($connection, $_POST["newcategory"]);
									if($newcategory != ""){
										mysqli_query($connection, "INSERT INTO $tablecategories (category) VALUES ('$newcategory')");
										echo "<div class='alert'>" .uilang("New category has been added"). ".</div>";
									}
								}
								
								if(isset($_GET["deletecategory"])){
									$id = mysqli_real_escape_string($connection, $_GET["deletecategory"]);
									mysqli_query($connection, "DELETE FROM $tablecategories WHERE id = $id");
									echo "<div class='alert'>" .uilang("One category removed"). ".</div>";
								}
								
								//update category
								if(isset($_GET["updatecategory"])){
									?>
									<h3><a href="<?php echo $baseurl ?>admin.php?categories"><i class="fa fa-arrow-left"></i> <?php echo uilang("Back") ?></a></h3>
									<?php
									$id = mysqli_real_escape_string($connection, $_GET["updatecategory"]);
									
									if(isset($_POST["newcategoryupdate"])){
										$newcatname = mysqli_real_escape_string($connection, $_POST["newcategoryupdate"]);
										if($newcatname != ""){
											mysqli_query($connection, "UPDATE $tablecategories SET category = '$newcatname' WHERE id = $id");
											echo "<div class='alert'>" . uilang("Category updated") . ".</div>";
										}
									}
									
									$sql = "SELECT * FROM $tablecategories WHERE id = $id";
									$row = mysqli_fetch_assoc(mysqli_query($connection, $sql));
									?>
									<form method="post">
										<label><?php echo uilang("Enter new name for category") ?>: <?php echo $row["category"] ?></label>
										<input type="text" placeholder="<?php echo uilang("Category") ?>" name="newcategoryupdate" value="<?php echo $row["category"] ?>">
										<input type="submit" value="<?php echo uilang("Update") ?>" class="submitbutton">
									</form>
									<?php
								}else{
									$sql = "SELECT * FROM $tablecategories";
									$result = mysqli_query($connection, $sql);
									if(mysqli_num_rows($result) > 0){
										while($row = mysqli_fetch_assoc($result)){
											?>
											<div class="categoryblock"><i class="fa fa-tag"></i> <?php echo $row["category"] ?> <span style="margin-left: 20px; font-size: 12px; color: black;"><a href="<?php echo $baseurl ?>admin.php?categories&updatecategory=<?php echo $row["id"] ?>"><i class="fa fa-edit"></i> <?php echo uilang("Edit") ?></a> | <a href="<?php echo $baseurl ?>admin.php?categories&deletecategory=<?php echo $row["id"] ?>"><i class="fa fa-trash"></i> <?php echo uilang("Delete") ?></a></span></div>
											<?php
										}
									}else{
										echo "<p>" .uilang("No category has been added"). ".</p>";
									}
									?>
									<br><br>
									<form method="post">
										<label><i class="fa fa-tag"></i> <?php echo uilang("New category") ?></label>
										<input type="text" placeholder="<?php echo uilang("New category") ?>" name="newcategory">
										<input type="submit" value="<?php echo uilang("Submit") ?>" class="submitbutton">
									</form>
									<?php
								}
							}
							
							//settings
							else if(isset($_GET["settings"])){
								?>
								<h1><?php echo uilang("Settings") ?></h1>
								<?php
								
								if(isset($_GET["removelogo"])){
									echo "<div class='alert'>Logo has been removed.</div>";
									mysqli_query($connection, "UPDATE $tableconfig SET value = '' WHERE config = 'logo'");
									//delete previous media
									if(file_exists("pictures/" . $logo))
										unlink("pictures/" . $logo);
								}
								
								if(isset($_POST["websitetitle"])){
									
									$cfg = new \stdClass();
									$cfg->websitetitle = mysqli_real_escape_string($connection, $_POST["websitetitle"]);
									$cfg->maincolor = mysqli_real_escape_string($connection, $_POST["maincolor"]);
									$cfg->secondcolor = mysqli_real_escape_string($connection, $_POST["secondcolor"]);
									$cfg->about = $_POST["about"];
									$cfg->language = mysqli_real_escape_string($connection, $_POST["language"]);
									$cfg->thumbnailmode = mysqli_real_escape_string($connection, $_POST["thumbnailmode"]);
									$cfg->logo = $logo;
									$cfg->adminwhatsapp = mysqli_real_escape_string($connection, $_POST["adminwhatsapp"]);
									$cfg->currencysymbol = mysqli_real_escape_string($connection, $_POST["currencysymbol"]);
									$cfg->baseurl = mysqli_real_escape_string($connection, $_POST["baseurl"]);
									$cfg->enablerecentpostsliders = mysqli_real_escape_string($connection, $_POST["enablerecentpostsliders"]);
									$cfg->enablefacebookcomment = mysqli_real_escape_string($connection, $_POST["enablefacebookcomment"]);
									$cfg->enablepublishdate = mysqli_real_escape_string($connection, $_POST["enablepublishdate"]);
									$cfg->disabledecimals = mysqli_real_escape_string($connection, $_POST["disabledecimals"]);
									if(isset($_POST["sharebuttonsoption"]))
										$cfg->sharebuttonsoption = $_POST["sharebuttonsoption"];
									$JSONcfg = addslashes(json_encode($cfg));
									
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$JSONcfg' WHERE config = 'cfg'");
									
									//Favicon upload
									if(isset($_FILES["favicon"])){
										if($_FILES["favicon"]["size"] == 0){
											//
										}else{
											if($_FILES['favicon']['error'] > 0) { echo "<div class='alert'>" .uilang("Error during uploading. Try again"). "</div>"; }
											$extsAllowed = array( 'ico' );
											$uploadedfile = $_FILES["favicon"]["name"];
											$extension = pathinfo($uploadedfile, PATHINFO_EXTENSION);
											if (in_array($extension, $extsAllowed) ) { 
												$favicon = "favicon.ico";
												$result = move_uploaded_file($_FILES['favicon']['tmp_name'], $favicon);
												?>
												<div class="alert"><?php echo uilang("Icon upload is OK") ?>.</div>
												<?php
												
											} else { echo "<div class='alert'>" .uilang("File is not valid. Please try again"). ".</div>"; }
										}
									}
									
									//Logo upload
									if(isset($_FILES["newpicture"])){
										$maxsize = 524288;
										if($_FILES["newpicture"]["size"] == 0){
											//
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
												
												<div class="alert"><?php echo uilang("Logo upload is OK") ?>.</div>
												<?php
												$newpicture = $newpicture .".". $extension;
												
												/*
												if($logo != ""){
													//delete previous media
													if(file_exists("pictures/" . $logo)){
														unlink("pictures/" . $logo);
													}
												}
												*/
												
												$logo = $newpicture;
												
												$sql = "SELECT * FROM $tableconfig WHERE config = 'cfg'";
												$result = mysqli_query($connection, $sql);
												$row = mysqli_fetch_assoc($result)["value"];
												$cfg = json_decode($row);
												
												$cfg->logo = $logo;
												$JSONcfg = json_encode($cfg);
												
												mysqli_query($connection, "UPDATE $tableconfig SET value = '$JSONcfg' WHERE config = 'cfg'");
												
											} else { echo "<div class='alert'>" .uilang("File is not valid. Please try again"). ".</div>"; }
										}
									}
									echo "<div class='alert'>" .uilang("Settings updated!"). "</div>";
									?>
									<script>
									setTimeout(function(){
										location.href = "?settings";
									}, 1000);
									</script>
									<?php
								}
								
								?>
								<form method="post" enctype="multipart/form-data">
								
									<?php
									
									$sql = "SELECT * FROM $tableconfig WHERE config = 'cfg'";
									$result = mysqli_query($connection, $sql);
									
									$row = mysqli_fetch_assoc($result)["value"];
									$cfg = json_decode($row);
									
									?>
									
									<label><i class="fa fa-font"></i> <?php echo uilang("Website Title") ?></label>
									<input placeholder="<?php echo uilang("Website Title") ?>" name="websitetitle" value="<?php echo stripslashes($cfg->websitetitle) ?>">
									
									<label><i class="fa fa-paint-brush"></i> <?php echo uilang("Main Color") ?></label>
									<input placeholder="<?php echo uilang("Main Color") ?>" name="maincolor" value="<?php echo $cfg->maincolor ?>" data-jscolor="">
									
									<label><i class="fa fa-paint-brush"></i> <?php echo uilang("Secondary Color") ?></label>
									<input placeholder="<?php echo uilang("Secondary Color") ?>" name="secondcolor" value="<?php echo $cfg->secondcolor ?>" data-jscolor="">
									
									<label><i class="fa fa-money"></i> <?php echo uilang("Currency Symbol") ?></label>
									<input placeholder="<?php echo uilang("Currency Symbol") ?>" name="currencysymbol" value="<?php echo $currencysymbol ?>">
									
									<label><i class="fa fa-money"></i> <?php echo uilang("Disable Decimals") ?></label>
									<select name="disabledecimals">
										<option value=0 <?php if($cfg->disabledecimals == "0"){ echo "selected"; } ?>><?php echo uilang("No") ?></option>
										<option value=1 <?php if($cfg->disabledecimals == "1"){ echo "selected"; } ?>><?php echo uilang("Yes") ?></option>
									</select>
									<br>
												
									<label><i class="fa fa-whatsapp"></i> <?php echo uilang("Admin WhatsApp Phone Number") ?></label>
									<input placeholder="<?php echo uilang("Admin WhatsApp Phone Number") ?>" name="adminwhatsapp" value="<?php echo $cfg->adminwhatsapp ?>">
									
									<label><i class="fa fa-info"></i> <?php echo uilang("About") ?></label>
									<textarea placeholder="<?php echo uilang("About") ?>" name="about"><?php echo stripslashes($cfg->about) ?></textarea>
									<br>
									
									<label><i class="fa fa-language"></i> <?php echo uilang("Home Thumbnail Mode") ?></label>
									<select name="thumbnailmode">
										<option value=0 <?php if($cfg->thumbnailmode == "0"){ echo "selected"; } ?>><?php echo uilang("Center Filled") ?></option>
										<option value=1 <?php if($cfg->thumbnailmode == "1"){ echo "selected"; } ?>><?php echo uilang("Stretched Width or Height") ?></option>
									</select>
									<br>
									
									<label><i class="fa fa-language"></i> <?php echo uilang("Language") ?></label>
									<select name="language">
										<?php
										if($cfg->language == "en"){
											?>
											<option selected value="en">English</option>
											<option value="id">Bahasa Indonesia</option>
											<?php
										}else if($cfg->language == "id"){
											?>
											<option value="en">English</option>
											<option selected value="id">Bahasa Indonesia</option>
											<?php
										}
										?>
									</select>
									<br>
									
									<label><i class="fa fa-check-circle"></i> Logo</label>
									<?php
									if($cfg->logo == ""){
										?>
										<div style="display: inline-block; vertical-align: middle;">
											<img src="images/logo.png" width="64">
										</div>
										<?php
									}else{
										?>
										<div style="display: inline-block; text-align: center; vertical-align: middle;">
											<img src="pictures/<?php echo $cfg->logo ?>" width="64"><br>
											<a href="<?php echo $baseurl ?>admin.php?settings&removelogo" class="textlink"><i class="fa fa-trash"></i> Remove</a>
										</div>
										<?php
									}
									?>
									<input name="newpicture" type="file" name="logo" style="display: inline-block; width: 300px; vertical-align: middle;">
									<br>
												
									<label><i class="fa fa-globe"></i> <?php echo uilang("Website Icon (.ico file)") ?></label>
									<input type="file" name="favicon">
									
									<label><i class="fa fa-calendar"></i> <?php echo uilang("Enable Publish Date?") ?></label>
									<select name="enablepublishdate">
										<?php 
										if($enablepublishdate){
											?>
											<option value=0><?php echo uilang("No") ?></option>
											<option value=1 selected><?php echo uilang("Yes") ?></option>
											<?php
										}else{
											?>
											<option value=0 selected><?php echo uilang("No") ?></option>
											<option value=1><?php echo uilang("Yes") ?></option>
											<?php
										}
										?>
									</select>
									
									<label><i class="fa fa-exchange"></i> <?php echo uilang("Enable Recent Posts Slider?") ?></label>
									<select name="enablerecentpostsliders">
										<?php 
										if($enablerecentpostsliders){
											?>
											<option value=0><?php echo uilang("No") ?></option>
											<option value=1 selected><?php echo uilang("Yes") ?></option>
											<?php
										}else{
											?>
											<option value=0 selected><?php echo uilang("No") ?></option>
											<option value=1><?php echo uilang("Yes") ?></option>
											<?php
										}
										?>
									</select>
									
									
									
									<label><i class="fa fa-share-alt"></i> <?php echo uilang("Share Buttons Option") ?></label>
									
									<input type="checkbox" name="sharebuttonsoption[]" value="Facebook" <?php if(IsChecked($sharebuttonsoption, "Facebook")){ echo "checked"; } ?>><label for="sbo1" style="display: inline-block;">Facebook</label>
									<input type="checkbox" name="sharebuttonsoption[]" value="Twitter" <?php if(IsChecked($sharebuttonsoption, "Twitter")){ echo "checked"; } ?>><label for="sbo2" style="display: inline-block;">Twitter</label>
									<input type="checkbox" name="sharebuttonsoption[]" value="Email" <?php if(IsChecked($sharebuttonsoption, "Email")){ echo "checked"; } ?>><label for="sbo3" style="display: inline-block;">Email</label>
									<input type="checkbox" name="sharebuttonsoption[]" value="Pinterest" <?php if(IsChecked($sharebuttonsoption, "Pinterest")){ echo "checked"; } ?>><label for="sbo4" style="display: inline-block;">Pinterest</label>
									<input type="checkbox" name="sharebuttonsoption[]" value="Linkedin" <?php if(IsChecked($sharebuttonsoption, "Linkedin")){ echo "checked"; } ?>><label for="sbo5" style="display: inline-block;">Linkedin</label>
									<input type="checkbox" name="sharebuttonsoption[]" value="WhatsApp" <?php if(IsChecked($sharebuttonsoption, "WhatsApp")){ echo "checked"; } ?>><label for="sbo6" style="display: inline-block;">WhatsApp</label>
									<input type="checkbox" name="sharebuttonsoption[]" value="Telegram" <?php if(IsChecked($sharebuttonsoption, "Telegram")){ echo "checked"; } ?>><label for="sbo7" style="display: inline-block;">Telegram</label>
									
									
									<label><i class="fa fa-facebook"></i> <?php echo uilang("Enable Facebook Comment?") ?></label>
									<select name="enablefacebookcomment">
										<?php 
										if($enablefacebookcomment){
											?>
											<option value=0><?php echo uilang("No") ?></option>
											<option value=1 selected><?php echo uilang("Yes") ?></option>
											<?php
										}else{
											?>
											<option value=0 selected><?php echo uilang("No") ?></option>
											<option value=1><?php echo uilang("Yes") ?></option>
											<?php
										}
										?>
									</select>
									
									<label><i class="fa fa-link"></i> <?php echo uilang("Base URL (make sure to include '/' symbol at the end)") ?></label>
									<input placeholder="<?php echo uilang("Base URL") ?>" name="baseurl" value="<?php echo $cfg->baseurl ?>">
									
									
									
									<input class="submitbutton" type="submit" value="<?php echo uilang("Update") ?>">
								</form>
								
								<?php
								
							}
							//edit post
							else if(isset($_GET["editpost"])){
								
								$id = mysqli_real_escape_string($connection, $_GET["editpost"]);
								
								$sql = "SELECT * FROM $tableposts WHERE id = $id";
								$result = mysqli_query($connection, $sql);
								if(mysqli_num_rows($result) > 0){
									$row = mysqli_fetch_assoc($result);
									?>
									
									<div class="postform">
										<h1><?php echo uilang("Edit Post") ?></h1>
										<form action="postupdate.php" method="post" enctype="multipart/form-data">
											<label><i class="fa fa-edit"></i> <?php echo uilang("Title") ?></label>
											<input name="editposttitle" placeholder="<?php echo uilang("Title") ?>" value="<?php echo $row["title"] ?>">
											<label><i class="fa fa-money"></i> <?php echo uilang("Price") ?></label>
											<input type="number" step="0.01" name="editnormalprice" placeholder="<?php echo uilang("Price") ?>" value="<?php echo $row["normalprice"] ?>">
											<label><i class="fa fa-money"></i> <?php echo uilang("Discount Price") ?></label>
											<input type="number" step="0.01" name="editdiscountprice" placeholder="<?php echo uilang("Discount Price") ?>" value="<?php echo $row["discountprice"] ?>">
											<label><i class="fa fa-tag"></i> <?php echo uilang("Category") ?></label>
											
											<select name="editcatid">
												<?php
												$catsql = "SELECT * FROM $tablecategories ORDER BY category ASC";
												$catresult = mysqli_query($connection, $catsql);
												if(mysqli_num_rows($catresult) > 0){
													while($catrow = mysqli_fetch_assoc($catresult)){
														if($catrow["id"] == $row["catid"]){
															?>
															<option value="<?php echo $catrow["id"] ?>" selected="selected"><?php echo $catrow["category"] ?></option>
															<?php
														}else{
															?>
															<option value="<?php echo $catrow["id"] ?>"><?php echo $catrow["category"] ?></option>
															<?php
														}
													}
												}
												if($row["catid"] == 0){
													?>
													<option value="0" selected="selected"><?php echo uilang("Uncategorized") ?></option>
													<?php
												}
												?>
											</select>
											
											<label><i class="fa fa-file"></i> <?php echo uilang("Content") ?></label>
											<textarea name="editpostcontent" style="height: 250px;"><?php echo $row["content"] ?></textarea>
											<br><br>
											
											<label><i class="fa fa-image"></i> <?php echo uilang("Image File") ?></label>
											<input class="fileinput" name="newpicture" type="file" accept="image/jpeg, image/png">
											
											<label><i class="fa fa-image"></i> <?php echo uilang("Additional Images") ?></label>
											<div id="moreimagesvisual"></div>
											<input id="moreimagesinput" name="moreimagesinput" value="<?php echo $row["moreimages"] ?>" style="display: none;">
											<div class="buybutton" onclick="showimagepicker()"><i class="fa fa-plus"></i> <?php echo uilang("Add") ?></div>
											<br><br>
											
											<label><i class="fa fa-check-square-o"></i> <?php echo uilang("Add more options") ?></label>
											<input id="moreoptions" name="moreoptions" value='<?php echo $row["options"] ?>' style="display: none;">
											<div id="moreoptionsvisual" style="margin-bottom: 10px;"></div>
											<div id="moformbutton" class="buybutton" onclick="showmoform()"><i class="fa fa-plus"></i> <?php echo uilang("Add") ?></div>
											<div id="moform" style="border: 1px solid black; border-radius: 6px; padding: 20px; display: none;">
												<label><i class="fa fa-plus"></i> <?php echo uilang("Add new option title:") ?></label>
												<input placeholder="<?php echo uilang("Option Title") ?>" id="newoptiontitle">
												<div class="buybutton" onclick="addnewoptiontitle()"><i class="fa fa-plus"></i> <?php echo uilang("Add") ?></div>
												<div class="buybutton" onclick="closemoform()"><i class="fa fa-times"></i> <?php echo uilang("Close") ?></div>
											</div>
											<div id="moformedit" style="border: 1px solid black; border-radius: 6px; padding: 20px; display: none;">
												<h2><i class="fa fa-check-square-o"></i> <?php echo uilang("Edit") ?> <span id="motitletoedit"></span></h2>
												<div id="currentmochilds"></div>
												<label><?php echo uilang("Add new item for this option") ?></label>
												<input id="moitem" placeholder="<?php echo uilang("Add new item for this option") ?>">
												<label><?php echo uilang("Product price when this option is selected") ?></label>
												<input id="moprice" type="number" placeholder="<?php echo uilang("Price") ?>" value=0>
												<div class="buybutton" onclick="addcurrentmoitem()"><i class="fa fa-plus"></i> <?php echo uilang("Add") ?></div>
												<div class="buybutton" onclick="closemoeditform()"><i class="fa fa-times"></i> <?php echo uilang("Close") ?></div>
											</div>
											
											<br>
											<br>
											<br>
											<input name="id" value="<?php echo $row["id"] ?>" style="display: none;">
											<input type="submit" value="<?php echo uilang("Update") ?>" class="submitbutton">
										</form>
										
										<script>
											setTimeout(function(){
												if($("#moreoptions").val() != ""){
													moptions = JSON.parse($("#moreoptions").val())
													updatemovisual()
												}
												
												if($("#moreimagesinput").val() != ""){
													ipdatatovisual()
												}
											}, 1000)
										</script>
									</div>
									<div class="progress" style="display: none">
									<div id="upploadprogresstitle">
										<h1><?php echo uilang("Upload progress") ?> <span class="percent">0%</span></h1>
										<div class="bar"></div>
									</div>
									<div id="status" style="margin-top: 30px;"></div>
								</div>
								
								<script>
									$(function() {

										var bar = $('.bar');
										var percent = $('.percent');
										var status = $('#status');

										$('form').ajaxForm({
											beforeSend: function() {
												status.empty();
												var percentVal = '0%';
												bar.width(percentVal);
												percent.html(percentVal);
												$(".progress").slideDown();
												$(".postform").slideUp();
											},
											uploadProgress: function(event, position, total, percentComplete) {
												var percentVal = percentComplete + '%';
												bar.width(percentVal);
												percent.html(percentVal);
											},
											complete: function(xhr) {
												status.html(xhr.responseText);
											}
										});
									}); 
								</script>
								<?php
								}
							}
							//
							else if(isset($_GET["orders"])){
								?>
								<h1><?php echo uilang("Order") ?></h1>
								<?php
								$sql = "SELECT * FROM $tablemessages ORDER BY id DESC";
								$result = mysqli_query($connection, $sql);
								if($result){
									if(mysqli_num_rows($result) == 0){
										echo "<p>" . uilang("There is no order recorded.") . "</p>";
									}else{
										?>
										<table style="width: 100%">
											<tr>
												<th style="width: 100px;"><?php echo uilang("Date") ?></th>
												<th style="width: 100px;"><?php echo uilang("Order") ?></th>
											</tr>
											<?php
											while($row = mysqli_fetch_assoc($result)){
												$mil = $row["date"];
												$seconds = $mil / 1000;
												$postdate = date("d-m-Y", $seconds);
												?>
												<tr>
													<td><?php echo $postdate ?></td>
													<td><?php echo nl2br($row["message"]) ?></td>
												</tr>
												<?php
											}
											?>
										</table>
										<?php
									}
								}
							}
							//home
							else{
								?>
								<h1><?php echo uilang("Home") ?></h1>
								<?php
								if(isset($_GET["deletepost"])){
									$id = mysqli_real_escape_string($connection, $_GET["deletepost"]);
									
									$sql = "SELECT * FROM $tableposts WHERE id = $id";
									$result = mysqli_query($connection, $sql);
									if(mysqli_num_rows($result) > 0){
										$row = mysqli_fetch_assoc($result);
										
										$postpic = $row["picture"];
										
										if($postpic != ""){
											if(file_exists("pictures/" . $postpic))
												unlink("pictures/" . $postpic);
										}
										
										mysqli_query($connection, "DELETE FROM $tableposts WHERE id = $id");
										
										echo "<div class='alert'>\"" . $_GET["title"] . "\" " .uilang("has been deleted"). ".</div>";
									}
									
								}
								
								$sql = "SELECT * FROM $tableposts ORDER BY id DESC";
								$result = mysqli_query($connection, $sql);
								if($result){
									if(mysqli_num_rows($result) == 0){
										echo "<p>" .uilang("There is no post published"). ".</p>";
									}else{
										?>
										<h3><i class="fa fa-file"></i> <?php echo uilang("Published Posts") ?></h3>
										<table style="width: 100%">
											<tr>
												<th style="width: 100px;"><?php echo uilang("Date") ?></th>
												<th><?php echo uilang("Title") ?></th>
												<th style="width: 100px;"><?php echo uilang("Category") ?></th>
												<th style="width: 50px;"><?php echo uilang("Edit") ?></th>
												<th style="width: 50px;"><?php echo uilang("Delete") ?></th>
											</tr>
											<?php
											while($row = mysqli_fetch_assoc($result)){
												$mil = $row["time"];
												$seconds = $mil / 1000;
												$postdate = date("d-m-Y", $seconds);
												?>
												<tr>
													<td><?php echo $postdate ?></td>
													<td><a target="_blank" href="<?php echo $baseurl . "?post=" . $row["postid"] ?>"><i class="fa fa-external-link"></i> <?php echo $row["title"] ?></a></td>
													<td><?php echo showCatName($row["catid"]) ?></td>
													<td><a href="<?php echo $baseurl ?>admin.php?editpost=<?php echo $row["id"] ?>"><i class="fa fa-edit"></i> <?php echo uilang("Edit") ?></a></td>
													<td><a href="<?php echo $baseurl ?>admin.php?deletepost=<?php echo $row["id"] ?>&title=<?php echo $row["title"] ?>"><i class="fa fa-trash"></i> <?php echo uilang("Delete") ?></a></td>
												</tr>
												<?php
											}
											?>
										</table>
										<?php
									}
								}else{
									?>
									<script>
										alert("<?php echo uilang("WELCOME!\nClick OK to start.\nIf this message appears again, please check that you have correct database connection.") ?>")
										location.reload()
									</script>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
				
				<div id="imagedisplayer" onclick="hideimagedisplayer()"></div>
				
				<script>
				
					function showimagepicker(){
						$("body").append("<div id='imagepickerui'><h2 onclick='closeimagepicker()' style='cursor: pointer;'><i class='fa fa-arrow-left'></i> Back</h2><div id='imagepickercontent'>Please wait...</div>")
						$.get("imagepicker.php", function(data){
							$("#imagepickercontent").html(data)
						})
					}
					
					function insertthis(img){
						var randata = Math.ceil(Math.random()*10000)
						$("#moreimagesvisual").append("<div class='imgitem' style='display: inline-block; vertical-align: top;' onclick=removethis('" +randata+ "')><div class='imgitemdatarand' style='display: none'>"+randata+"</div><div class='imgitemdata' style='display: none'>"+img+"</div><img src='" + img + "' style='height: 64px; margin: 10px; border-radius: 5px; cursor: not-allowed;'></div>")
						closeimagepicker()
						ipvisualtodata()
					}
					
					function removethis(randata){
						for(var i = 0; i < $(".imgitem").length; i++){
							if($(".imgitemdatarand").eq(i).text() == randata)
								$(".imgitem").eq(i).remove()
						}
						ipvisualtodata()
					}
					
					function ipvisualtodata(){
						var data = ""
						for(var i = 0; i < $(".imgitem").length; i++){
							data += $(".imgitemdata").eq(i).text() + ",";
						}
						$("#moreimagesinput").val(data)
					}
					
					function ipdatatovisual(){
						var data = $("#moreimagesinput").val()
						data = data.split(",")
						for(var i = 0; i < data.length; i++){
							if(data[i] != ""){
								insertthis(data[i])
							}
						}
					}
					
					function closeimagepicker(){
						$("#imagepickerui").remove()
					}
				
					function showimage(img){
						$("#imagedisplayer").html("<img src='<?php echo $baseurl ?>" +img+ "' style='height: 100%;'>").fadeIn()
					}
					
					
					function hideimagedisplayer(){
						$("#imagedisplayer").fadeOut()
					}
					
					var moptions = []

					function addnewoptiontitle(){
						
						var nottl = $("#newoptiontitle").val()
						if(nottl != ""){
							moptions.push({ title : nottl , options : [] })
							updatemovisual()
							closemoform()
							$("#moformbutton").hide()
							editmop(0)
						}
						
					}

					function editmop(i){
						$("#moformedit").show()
						$("#motitletoedit").html(moptions[i].title)
					}

					function addcurrentmoitem(){
						var moitem = $("#moitem").val()
						var moprice = $("#moprice").val()
						if(moitem != "" && moprice > 0){
							moptions[0].options.push({ title : moitem, price : moprice})
							$("#moitem").val("").focus()
							$("#moprice").val(0)
							updatemovisual()
						}
					}

					function showmoform(){
						$("#moformbutton").hide()
						$("#moform").show()
					}
					function closemoform(){
						$("#moformbutton").show()
						$("#moform").hide()
					}
					function closemoeditform(){
						$("#moformedit").hide()
					}
					function updatemovisual(){
						if(moptions.length == 1){
							$("#moreoptionsvisual").html("")
							var mocontent = ""
							for(var i = 0; i < moptions.length; i++){
								mocontent += "<div class='categoryblock'><div><i class='fa fa-check-square-o'></i> " + moptions[i].title + "<span onclick='editmop("+i+")'style='cursor: pointer; margin-left: 20px; font-size: 12px; color: black;'><i class='fa fa-edit'></i> <?php echo uilang("Edit") ?></span></div>"
								if(moptions[i].options.length > 0){
									for(var x = 0; x < moptions[i].options.length; x++){
										mocontent += "<div style='font-size: 12px; padding: 10px;'><i class='fa fa-arrow-right'></i> " +moptions[i].options[x].title+ " (" +tSep(moptions[i].options[x].price)+ ")</div>"
									}
								}
								mocontent += "</div>"
							}
							$("#moreoptionsvisual").append(mocontent)
							$("#newoptiontitle").val("")
							$("#moform").hide()
							$("#moformbutton").hide()
							$("#moreoptions").val(JSON.stringify(moptions))
						}else{
							$("#moreoptionsvisual").html("<?php echo uilang("There is no option has been added.") ?>")
							$("#moformbutton").show()
						}
					}
					updatemovisual()
				</script>
				
				<?php
			}else{
				echo "<div class='alert'>Login error!</div>";
			}
		}
		//not logged in
		else{
			//check login info
			if(isset($_POST["username"]) && isset($_POST["password"])){
				if($username == $_POST["username"] && $password == $_POST["password"]){
					$_SESSION["adminusername"] = $_POST["username"];
					$_SESSION["adminpassword"] = $_POST["password"];
					echo "<div class='alert'>" .uilang("Login success!"). "</div>";
					echo "<script>location.href='" .$baseurl. "admin.php'</script>";
				}else{
					echo "<div class='alert'>Login error!</div>";
				}
			}
			//show login form
			else{
				?>
				<div class="loginform">
					<div style="text-align: center; padding: 20px;">
						<?php
						$currentlogo = "images/logo.png";
						if($logo != "")
							$currentlogo = "pictures/" . $logo;
						?>
						<img src="<?php echo $currentlogo ?>" width="128"><br>
						<p><?php echo $websitetitle ?> - Admin Panel</p>
					</div>
					<h1><?php echo uilang("Login") ?></h1>
					<form method="post">
						<input type="text" name="username" placeholder="Username">
						<input type="password" name="password" placeholder="Password">
						<input class="submitbutton" type="submit" value="<?php echo uilang("Login") ?>">
					</form>
				</div>
				<?php
			}
			
			
		}
		
		//log out
		if(isset($_GET["logout"])){
			session_destroy();
			echo "Bye!";
			echo "<script>location.href='" .$baseurl. "admin.php'</script>";
		}
		?>
		
		<script>
			setTimeout(function(){
				$(".alert").slideUp()
			}, 2000)
			
			function toggleadminmenu(){
				$(".adminmenubar").toggle()
			}
			
		</script>
	</body>
</html>