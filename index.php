<?php
//Developed by https://webappdev.my.id/

include("config.php");
include("functions.php");
include("uilang.php");

?>

<!DOCTYPE html>
<html>
	<head>
		
		<?php
		
		if(isset($_GET["post"])){
			$postid = mysqli_real_escape_string($connection, $_GET["post"]);
			$sql = "SELECT * FROM $tableposts WHERE postid = '$postid'";
			$result = mysqli_query($connection, $sql);
			if($result){
				$title = shorten_text(mysqli_fetch_assoc($result)["title"], 40, ' ...', false) . " - " . $websitetitle;
			}
			?>
			
			<?php
		}else if(isset($_GET["category"])){
			$title = urldecode($_GET["category"]) . " - " . $websitetitle;
		}else if(isset($_GET["search"])){
			$title = urldecode($_GET["search"]) . " - " . $websitetitle;
		}else{
			$title = $websitetitle;
		}
		
		?>
		
		<title><?php echo $title ?></title>
		
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
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>slick/slick-theme.css"/>
        <script type="text/javascript" src="<?php echo $baseurl ?>slick/slick.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>sharingbuttons.css"/>
		<?php include("style.php"); ?>
		<script src="<?php echo $baseurl ?>somefunctions.js"></script>
	</head>
	<body>
		<div id="header">
			<div>
				<div class="inlinecenterblock" style="padding: 10px; padding-top: 15px; padding-left: 20px; padding-right: 0px;">
					<div>
						<?php
						$currentlogo = "images/logo.png";
						if($logo != "")
							$currentlogo = "pictures/" . $logo;
						?>
						<a href="<?php echo $baseurl ?>"><img src="<?php echo $baseurl . $currentlogo ?>" style="height: 64px;"></a>
					</div>
					
				</div>
				<div class="inlinecenterblock" style="color: <?php echo $maincolor ?>; font-weight: bold;">
					<h1 style="margin: 0px; font-size: 30px;"><a href="<?php echo $baseurl ?>"><?php echo $websitetitle ?></a></h1>
				</div>
			</div>
			<div class="topabout">
				<?php echo $about ?>
			</div>
		</div>
		
		<div class="section" id="searchbar">
			<div style="border-radius: 50px; display: table; width: 100%; border: 2px solid <?php echo $maincolor ?>;">
				<div style="display: table-cell; width: 50px; text-align: center;">
					<i class="fa fa-search"></i>
				</div>
				<div style="display: table-cell">
					<input placeholder="<?php echo uilang("Search") ?>..." style="border: none; background-color: inherit; outline: none; margin: 0px;">
				</div>
				<div style="display: table-cell; width: 50px; text-align: center;">
					<i class="fa fa-times-circle"></i>
				</div>
			</div>
			<div style="text-align: center; padding-top: 20px;">
				<?php
				$sql = "SELECT * FROM $tablecategories ORDER BY category ASC";
				$result = mysqli_query($connection, $sql);
				if($result){
					?>
					<div onclick="filtercategory('')" class="categoryblock" style="border: 1px solid <?php echo $maincolor ?>;padding: 10px; cursor: pointer;"><i class="fa fa-tag"></i> <?php echo uilang("All") ?></div>
					<?php
					while($row = mysqli_fetch_assoc($result)){
						?>
						<div onclick="filtercategory('<?php echo $row["category"] ?>')" class="categoryblock" style="border: 1px solid <?php echo $maincolor ?>;padding: 10px; cursor: pointer;"><i class="fa fa-tag"></i> <?php echo $row["category"] ?></div>
						<?php
					}
				}
				?>
			</div>
		</div>
		
		<div class="section gridcontainerunscrollable">
			<?php
			$sql = "SELECT * FROM $tableposts ORDER BY id DESC";
			$result = mysqli_query($connection, $sql);
			if($result){
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
						$imagefile = $row["picture"];
						if($imagefile == ""){
							$imagefile = "images/defaultimg.jpg";
						}else{
							$imagefile = "pictures/" . $imagefile;
						}
						
						$currentcategory = showCatName($row["catid"]);

						?>
						
						<!-- Thumbnail -->
						<div class="filmblock">
							<div class="categoryname" style="display: none;"><?php echo $currentcategory ?></div>
							<div class="productthumbnail" onclick="showimage('<?php echo $imagefile ?>')" style="cursor: pointer; background: url(<?php echo $baseurl . $imagefile ?>) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
							</div>
							<div>
								
								<?php
								$saleprice = $row["normalprice"];
								$oldprice = "";
								if($row["discountprice"] != 0){
									$saleprice = $row["discountprice"];
									$oldprice = "<span style='margin: 0px; margin-top: 20px; text-decoration: line-through; font-size: 12px; margin-right: 10px; color: gray;'>" . $currencysymbol . number_format($row["normalprice"],2) . "</span>";
								}
								?>
								
								<h2 style="margin-top: 20px;"><?php echo shorten_text($row["title"], 25, ' ...', false) ?></h2><div class="productoptions" style="display: none"><?php echo $row["options"] ?></div><div style="padding-bottom: 20px; font-size: 25px; font-weight: bold; color: <?php echo $maincolor ?>"><?php echo $oldprice . $currencysymbol . number_format($saleprice) ?> <span style="font-size: 12px;">x</span> <input type="number" value=1 style="vertical-align: middle; display: inline-block; width: 40px; padding: 2px; margin: 5px; border-radius: 0px;"></div>
								<div class="morebutton"><i class="fa fa-shopping-cart"></i> <?php echo uilang("Add to Cart") ?></div>
								<div style="padding: 20px;"><a href="#" class="textlink"><?php echo uilang("More") ?>...</a></div>
							</div>
						</div>
						<?php

					}
				}
			}
			
			?>
		</div>
		
		<div id="cartbutton">
			<div style="width: 96px; height: 96px; border-radius: 50%; background-color: white; text-align: center; display: table-cell; vertical-align: middle; border: 2px solid <?php echo $maincolor ?>">
				<i class="fa fa-shopping-cart" style="cursor: pointer;"></i>
			</div>
		</div>
		
		<div id="imagedisplayer" onclick="hideimagedisplayer()"></div>
		
		<!-- Footer -->
		<div class="section footercopyright">
			<span>© <?php echo date("Y"); ?> <?php echo $websitetitle; ?>. All rights reserved.</span>
		</div>
		
		
		
		<script>
			function showimage(img){
				$("#imagedisplayer").html("<img src='<?php echo $baseurl ?>" +img+ "'>").fadeIn()
			}
			
			function hideimagedisplayer(){
				$("#imagedisplayer").fadeOut()
			}
			
			function filtercategory(catname){
				if(catname == ""){
					$(".filmblock").slideDown()
				}else{
					$(".filmblock").hide()
					for(var i = 0; i < $(".filmblock").length; i++){
						if($(".filmblock").eq(i).find(".categoryname").html() == catname)
							$(".filmblock").eq(i).slideDown()
					}
				}
			}
			
			function showproductoptions(){
				for(var i = 0; i < $(".filmblock").length; i++){
					var po = $(".filmblock").eq(i).find(".productoptions").html()
					if(po != ""){
						var poobject = JSON.parse(po)
						var pocontents = ""
						for(var x = 0; x < poobject[0].options.length; x++){
							pocontents += "<option value=" +poobject[0].options[x].price+ ">" +poobject[0].options[x].title+ "</option>"
						}
						$(".filmblock").eq(i).find(".productoptions").html("<label>" +poobject[0].title+ "</label><select style='padding: 3px; width: 114px; margin: 0 auto;'>" + pocontents + "</select>").show()
					}
				}
			}
			
			showproductoptions()
		</script>
	</body>
</html>