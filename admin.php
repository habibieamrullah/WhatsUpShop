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
		<script
          src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous"></script>
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
			.stickythingy{
				position: -webkit-sticky; /* Safari */
				position: sticky;
				top: 0;
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
		<?php
		//if admin logged in
		if(isset($_SESSION["adminusername"]) && isset($_SESSION["adminpassword"])){
			if($username == $_SESSION["adminusername"] && $password == $_SESSION["adminpassword"]){
				?>
				
				<div style="display: table; position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; height: 100%;">
					<div style="display: table-row; height: 100%;">
						<div style="display: table-cell; width: 140px; background-color: black; color: white;">
							<div class="stickythingy">
								<div style="padding: 40px;">
									<?php
									$currentlogo = "images/logo.png";
									if($logo != "")
										$currentlogo = "pictures/" . $logo;
									?>
									<a href="<?php echo $baseurl ?>admin.php"><img src="<?php echo $currentlogo ?>" style="display: border-box; width: 100%;"></a>
								</div>
								<a href="<?php echo $baseurl ?>admin.php"><div class="adminleftbaritem"><i class="fa fa-home" style="width: 30px;"></i> <?php echo uilang("Home") ?></div></a>
								<a href="<?php echo $baseurl ?>admin.php?newpost"><div class="adminleftbaritem"><i class="fa fa-plus" style="width: 30px;"></i> <?php echo uilang("New Post") ?></div></a>
								<a href="<?php echo $baseurl ?>admin.php?categories"><div class="adminleftbaritem"><i class="fa fa-tag" style="width: 30px;"></i> <?php echo uilang("Categories") ?></div></a>
								<a href="<?php echo $baseurl ?>admin.php?orders"><div class="adminleftbaritem"><i class="fa fa-file-text" style="width: 30px;"></i> <?php echo uilang("Orders") ?></div></a>
								<a href="<?php echo $baseurl ?>admin.php?settings"><div class="adminleftbaritem"><i class="fa fa-cogs" style="width: 30px;"></i> <?php echo uilang("Settings") ?></div></a>
								<a href="<?php echo $baseurl ?>admin.php?logout"><div class="adminleftbaritem"><i class="fa fa-sign-out" style="width: 30px;"></i> <?php echo uilang("Logout") ?></div></a>
								
								<div style="text-align: center; padding: 30px; font-size: 10px;">CMS <?php echo uilang("Developed by") ?> <a target="_blank" class="textlink" style="color: lime;" href="https://webappdev.my.id/">https://webappdev.my.id/</a></div>
							</div>
						</div>
						<div style="display: table-cell; padding: 25px; vertical-align: top; border-left: 1px solid <?php echo $maincolor ?>; ">
							<?php
							//newpost
							if(isset($_GET["newpost"])){
								?>
								<div class="postform">
									<h1><?php echo uilang("New Post") ?></h1>
									<form action="postupload.php" method="post" enctype="multipart/form-data">
										<label><i class="fa fa-edit"></i> <?php echo uilang("Title") ?></label>
										<input name="newposttitle" placeholder="<?php echo uilang("Title") ?>">
										<label><i class="fa fa-money"></i> <?php echo uilang("Price") ?></label>
										<input type="number" name="newpostnormalprice" placeholder="<?php echo uilang("Price") ?>">
										<label><i class="fa fa-money"></i> <?php echo uilang("Discount Price") ?></label>
										<input type="number" name="newpostdiscountprice" placeholder="<?php echo uilang("Discount Price") ?>">
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
									
									$websitetitle = mysqli_real_escape_string($connection, $_POST["websitetitle"]);
									$maincolor = mysqli_real_escape_string($connection, $_POST["maincolor"]);
									$secondcolor = mysqli_real_escape_string($connection, $_POST["secondcolor"]);
									$about = mysqli_real_escape_string($connection, $_POST["about"]);
									$adminwhatsapp = mysqli_real_escape_string($connection, $_POST["adminwhatsapp"]);
									$language = mysqli_real_escape_string($connection, $_POST["language"]);
									$currencysymbol = mysqli_real_escape_string($connection, $_POST["currencysymbol"]);
									$baseurl = mysqli_real_escape_string($connection, $_POST["baseurl"]);
									
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$websitetitle' WHERE config = 'websitetitle'");
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$maincolor' WHERE config = 'maincolor'");
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$secondcolor' WHERE config = 'secondcolor'");
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$about' WHERE config = 'about'");
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$adminwhatsapp' WHERE config = 'adminwhatsapp'");
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$language' WHERE config = 'language'");
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$currencysymbol' WHERE config = 'currencysymbol'");
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$baseurl' WHERE config = 'baseurl'");
									
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
									
									//Picture upload
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
												$logo = $newpicture;
												mysqli_query($connection, "UPDATE $tableconfig SET value = '$logo' WHERE config = 'logo'");
												
											} else { echo "<div class='alert'>" .uilang("File is not valid. Please try again"). ".</div>"; }
										}
									}
									
									echo "<div class='alert'>" .uilang("Settings updated!"). "</div>";
								}
								?>
								<form method="post" enctype="multipart/form-data">
								<?php
								$sql = "SELECT * FROM $tableconfig";
								$result = mysqli_query($connection, $sql);
								while($row = mysqli_fetch_assoc($result)){
									switch($row["config"]){
										case "websitetitle" :
											?>
											<label><i class="fa fa-font"></i> <?php echo uilang("Website Title") ?></label>
											<input placeholder="<?php echo uilang("Website Title") ?>" name="websitetitle" value="<?php echo $row["value"] ?>">
											<?php
											break;
										case "maincolor" :
											?>
											<label><i class="fa fa-paint-brush"></i> <?php echo uilang("Main Color") ?></label>
											<input placeholder="<?php echo uilang("Main Color") ?>" name="maincolor" value="<?php echo $row["value"] ?>" data-jscolor="">
											<?php
											break;
										case "secondcolor" :
											?>
											<label><i class="fa fa-paint-brush"></i> <?php echo uilang("Secondary Color") ?></label>
											<input placeholder="<?php echo uilang("Secondary Color") ?>" name="secondcolor" value="<?php echo $row["value"] ?>" data-jscolor="">
											<?php
											break;
										case "currencysymbol" :
											?>
											<label><i class="fa fa-money"></i> <?php echo uilang("Currency Symbol") ?></label>
											<input placeholder="<?php echo uilang("Currency Symbol") ?>" name="currencysymbol" value="<?php echo $row["value"] ?>">
											<?php
											break;
										case "adminwhatsapp" :
											?>
											<label><i class="fa fa-whatsapp"></i> <?php echo uilang("Admin WhatsApp Phone Number") ?></label>
											<input placeholder="<?php echo uilang("Admin WhatsApp Phone Number") ?>" name="adminwhatsapp" value="<?php echo $row["value"] ?>">
											<?php
											break;
										case "about" :
											?>
											<label><i class="fa fa-info"></i> <?php echo uilang("About") ?></label>
											<textarea placeholder="<?php echo uilang("About") ?>" name="about"><?php echo $row["value"] ?></textarea>
											<br>
											<?php
											break;
										case "language" :
											?>
											<label><i class="fa fa-language"></i> <?php echo uilang("Language") ?></label>
											<select name="language">
												<?php
												if($row["value"] == "en"){
													?>
													<option selected value="en">English</option>
													<option value="id">Bahasa Indonesia</option>
													<?php
												}else if($row["value"] == "id"){
													?>
													<option value="en">English</option>
													<option selected value="id">Bahasa Indonesia</option>
													<?php
												}
												?>
											</select>
											<br>
											<?php
											break;
										case "logo" :
											?>
											<label><i class="fa fa-check-circle"></i> Logo</label>
											<?php
											if($row["value"] == ""){
												?>
												<div style="display: inline-block; vertical-align: middle;">
													<img src="images/logo.png" width="64">
												</div>
												<?php
											}else{
												?>
												<div style="display: inline-block; text-align: center; vertical-align: middle;">
													<img src="pictures/<?php echo $row["value"] ?>" width="64"><br>
													<a href="<?php echo $baseurl ?>admin.php?settings&removelogo" class="textlink"><i class="fa fa-trash"></i> Remove</a>
												</div>
												<?php
											}
											?>
											<input name="newpicture" type="file" name="logo" style="display: inline-block; width: 300px; vertical-align: middle;">
											<br>
											<?php
											break;
										case "baseurl" :
											?>
											<label><i class="fa fa-link"></i> <?php echo uilang("Base URL (make sure to include '/' symbol at the end)") ?></label>
											<input placeholder="<?php echo uilang("Base URL") ?>" name="baseurl" value="<?php echo $row["value"] ?>">
											<?php
											break;
									}
								}
								?>
								<label><i class="fa fa-globe"></i> <?php echo uilang("Website Icon (.ico file)") ?></label>
								<input type="file" name="favicon">
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
											<input type="number" name="editnormalprice" placeholder="<?php echo uilang("Price") ?>" value="<?php echo $row["normalprice"] ?>">
											<label><i class="fa fa-money"></i> <?php echo uilang("Discount Price") ?></label>
											<input type="number" name="editdiscountprice" placeholder="<?php echo uilang("Discount Price") ?>" value="<?php echo $row["discountprice"] ?>">
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
												moptions = JSON.parse($("#moreoptions").val())
												updatemovisual()
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
													<td><?php echo $row["title"] ?></td>
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
				
				<script>
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
				<div style="padding: 100px; width: 400px; margin: 0 auto;">
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
			
		</script>
	</body>
</html>