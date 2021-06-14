<?php

/*
Developed by Habibie
Email: habibieamrullah@gmail.com 
WhatsApp: 6287880334339
WebSite: https://webappdev.my.id
Donate: https://www.paypal.com/paypalme/habibieamrullah
*/

include("config.php");
include("functions.php");
include("uilang.php");

$deccount = 2;
if($cfg->disabledecimals == 1)
    $deccount = 0;


if($websitetitle == ""){
	?>
	Welcome! Open this page once again. If you still see this message, it means you did not set up the configuration correctly in config.php file.
	<?php
}else{
	
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
			
			<script src="jquery.min.js"></script>
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
					<div class="inlinecenterblock">
						<div>
							<?php
							$currentlogo = "images/logo.png";
							if($logo != "")
								$currentlogo = "pictures/" . $logo;
							?>
							<a href="<?php echo $baseurl ?>"><img src="<?php echo $baseurl . $currentlogo ?>" style="height: 64px;"></a>
						</div>
						
					</div>
					
					<div class="inlinecenterblock">
						<h1 style="margin: 0px; font-size: 30px; color: <?php echo $maincolor ?>; font-weight: bold;"><a href="<?php echo $baseurl ?>"><?php echo $websitetitle ?></a></h1>
						<div style="font-size: 13px;"><?php echo $about ?></div>
					</div>
					
					<div class="inlinecenterblock floatright">
						<div style="border-radius: 50px; display: table; box-sizing: border-box; width: 100%; border: 2px solid <?php echo $maincolor ?>;">
							<div style="display: table-cell; width: 50px; text-align: center;">
								<i class="fa fa-search"></i>
							</div>
							<div style="display: table-cell">
								<input <?php if(isset($_GET["post"])){ ?> onkeyup="searchonhomepage()" <?php } else { ?> onkeyup="quicksearch()" <?php } ?> id="quicksearch" placeholder="<?php echo uilang("Search") ?>..." style="border: none; background-color: inherit; outline: none; margin: 0px; padding: 10px;">
							</div>
							<div style="display: table-cell; width: 50px; text-align: center; cursor: pointer;" onclick="clearSearchInput()">
								<i class="fa fa-times-circle"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<?php
			
			//Post (single page)
			
			if(isset($_GET["post"])){
				?>
				<div class="section" id="categoriesbar">
					<div style="text-align: center; overflow: auto; white-space: nowrap;">
						<?php
						$sql = "SELECT * FROM $tablecategories ORDER BY category ASC";
						$result = mysqli_query($connection, $sql);
						if($result){
							?>
							<a href="<?php echo $baseurl ?>#filtercat=all"><div onclick="filtercategory('')" class="categoryblock" style="border: 1px solid <?php echo $maincolor ?>;padding: 10px; cursor: pointer;"><i class="fa fa-tag"></i> <?php echo uilang("All") ?></div></a>
							<?php
							while($row = mysqli_fetch_assoc($result)){
								?>
								<a href="<?php echo $baseurl ?>#filtercat=<?php echo $row["category"] ?>"><div onclick="filtercategory('<?php echo $row["category"] ?>')" class="categoryblock" style="border: 1px solid <?php echo $maincolor ?>;padding: 10px; cursor: pointer;"><i class="fa fa-tag"></i> <?php echo $row["category"] ?></div></a>
								<?php
							}
						}
						?>
					</div>
				</div>

				<div class="section">
					
										
					<div class="posttableblock">
						<div class="postcontent">
						
							<?php
							$postid = mysqli_real_escape_string($connection, $_GET["post"]);
							if($postid != ""){
								$sql = "SELECT * FROM  $tableposts WHERE postid = '$postid'";
								$result = mysqli_query($connection, $sql);
								if(mysqli_num_rows($result) == 0){
									echo "<p>" .uilang("Nothing found"). "</p>";
								}else{
									$row = mysqli_fetch_assoc($result);
									
									$picture = $row["picture"];
									$picturefile = $row["picture"];
									
									if($picture != ""){
										$picturefile = "pictures/" . $picture;
										$picture = $baseurl . "pictures/" . $picture;
									}else{
										$picturefile = "images/defaultimg.jpg";
										$picture = $baseurl . "images/defaultimg.jpg";
									}
									
									$mil = $row["time"];
									$seconds = $mil / 1000;
									$postdate = date("d-m-Y", $seconds);
									?>
									
									<div style="display: table; width: 100%;">
										<div class="producthalfbox leftphb">
											<!--
											<div id="productpic" style="background-image: url(<?php echo $picture ?>); background-attachment: fill; background-position: center; background-repeat: no-repeat; background-size: auto 100%;"></div>
											-->
											<div>
												<img src="<?php echo $picture ?>" style="cursor: pointer; width: 100%; border-radius: 5px;" <?php if($row["picture"] != "") { ?>onclick="showimage('pictures/<?php echo $row["picture"] ?>')"<?php } ?>>
											</div>
											<div id="moreimages">
												<?php
												if($row["moreimages"] != ""){
													$mimgs = explode(",", $row["moreimages"]);
													for($i = 0; $i < count($mimgs); $i++){
														if($mimgs[$i] != ""){
															?>
															<img src="<?php echo $baseurl . $mimgs[$i] ?>" style="height: 64px; border-radius: 5px; cursor: pointer;" onclick="showimage('<?php echo $mimgs[$i] ?>')">
															<?php
														}
													}
												}
												?>
											</div>
										</div>
										<div class="producthalfbox">
											
											<?php
											$saleprice = $row["normalprice"];
											$oldprice = "";
											if($row["discountprice"] != 0){
												$saleprice = $row["discountprice"];
												$oldprice = "<span style='margin: 0px; margin-top: 20px; text-decoration: line-through; font-size: 20px; margin-right: 10px; color: gray;'>" . $currencysymbol . number_format($row["normalprice"], $deccount) . "</span>";
											}
											?>
											
											<h1><?php echo $row["title"] ?> <i class="fa fa-angle-double-right"></i> <?php echo $oldprice . $currencysymbol . number_format($saleprice, $deccount) ?></h1>
											
											<div>
												<?php echo $row["content"] ?>
											</div>
											
											<!-- Social Share Buttons-->
											<div style="font-size: 12px;">
												<?php
												if(isset($sharebuttonsoption))
													showSharer($baseurl . "?post/" . $row["postid"], $websitetitle, $sharebuttonsoption);
												?>
											</div>
											<br><br>
											
											<!-- Facebook Comments Plugin -->
											<?php 
											if($enablefacebookcomment){
												?>
												<div style="width: 100%; box-sizing: border-box; background-color: white; border-radius: 10px; padding: 14px;">
													<div id="fb-root"></div>
													<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&amp;version=v5.0&amp;appId=569420283509636&amp;autoLogAppEvents=1"></script>
													 
													<div class="fb-comments" data-href="<?php echo $baseurl ?>?post/<?php echo $row["postid"] ?>" data-width="100%"  data-numposts="14"></div>
													
												</div>
												<?php
											}
											?>
											
										</div>
									</div>								
									
									<script>
										function viewedThis(postid){
											$.post("<?php echo $baseurl ?>viewcounter.php", {
												postid : postid
											}, function(data){
												console.log(data)
											})
										}
										//viewedThis("<?php echo $postid ?>")
									</script>
									<?php
								}
							}
							?>
							
						</div>
						<div class="randomvids">
							<div class="randomvidblock orderblock">
								<h2><?php echo uilang("Order") ?></h2>
								<label><i class="fa fa-plus"></i> <?php echo uilang("Quantity") ?></label>
								<input id="currentQ" type="number" value=1 onchange="updateCurrentTotal()" min=1 step=1 style="border-radius: 0px;" onkeyup="onlyNumbers(this)">
								
								<?php
								if($row["options"] != ""){
									?>
									<div id="productoptions" style="display: none"><?php echo $row["options"] ?></div>
									<script>
										var moptions = JSON.parse($("#productoptions").html())
										var productoptions = "<label>" + moptions[0].title + "</label>" 
										productoptions += "<select id='productoptionsselect' onchange='overridethisprice()'>"
										for(var i = 0; i < moptions[0].options.length; i++){
											productoptions += "<option value=" +moptions[0].options[i].price+ ">" + moptions[0].options[i].title + "</option>"
										}
										productoptions += "</select>"
										$("#productoptions").html(productoptions).show()
										setTimeout(function(){
											overridethisprice()
										}, 1000)
									</script>
									<?php
								}
								?>
								
								<!--
								<label><i class="fa fa-file-text-o"></i> <?php echo uilang("Notes") ?></label>
								<textarea id="ordernotes" placeholder="<?php echo uilang("Write some notes...") ?>" style="border-radius: 0px;"></textarea>
								-->
								<p id="currenttotal" style="font-size: 30px;">Rp. 12345</p>
								<div class="buybutton" onclick="addthisonetocart()"><i class="fa fa-shopping-cart"></i> <?php echo uilang("Add to Cart") ?></div>
								
								<script>
									var currentprice = <?php echo $saleprice ?>;
									var currentTotal = 0
									var currentitem = {
										id : 0,
										title : "<?php echo $row["title"] ?>",
										price : currentprice,
										quantity : 0,
										image : "<?php echo $picturefile ?>",
										notes : "",
									}
									
									function overridethisprice(){
										currentprice = parseFloat($("#productoptionsselect").val())
										currentitem.price = parseFloat($("#productoptionsselect").val())
										currentitem.title = "<?php echo $row["title"] ?> - " + $("#productoptionsselect option:selected").text()
										updateCurrentTotal()
									}
									
									function updateCurrentTotal(){
										
										var currentQ = $("#currentQ").val()
										if(currentQ > 0){
											currentTotal = currentQ * currentprice
										}else{
											$("#currentQ").val("1")
											currentQ = 1
											currentTotal = currentQ * currentprice
										}
										
										currentitem.quantity = parseFloat(currentQ)
										$("#currenttotal").html("<?php echo $currencysymbol ?> " + tSep(currentTotal.toFixed(<?php echo $deccount ?>)))
									}
									updateCurrentTotal()
									
									function addthisonetocart(){
										currentitem.notes = $("#ordernotes").val()
										
										if(cartobject.length == 0){
											console.log("Added first product")
											cartobject.push(currentitem)
											updatecartcount()
											savedata()
											location.reload()
											return
										}else{
											for(var i = 0; i < cartobject.length; i++){
												if(cartobject[i].title == currentitem.title && cartobject[i].price == currentitem.price){
													console.log("Added quantity only")
													cartobject[i].quantity += currentitem.quantity
													updatecartcount()
													savedata()
													location.reload()
													return
												}
											}
											console.log("Pushing new product to cartobject")
											cartobject.push(currentitem)
											updatecartcount()
											savedata()
											location.reload()
											return
										}	

									}
									
								</script>
								
							</div>
							
							<div class="randomvidblock"><?php echo uilang("You may like:") ?></div>
							<?php
							$sql = "SELECT * FROM $tableposts ORDER BY RAND() LIMIT 5";
							$result = mysqli_query($connection, $sql);
							if(mysqli_num_rows($result) > 0){
								while($row = mysqli_fetch_assoc($result)){
									?>
									<a href="<?php echo $baseurl ?>?post=<?php echo $row["postid"] ?>">
										<div class="randomvidblock">
											<?php
											$imagefile = $row["picture"];
											if($imagefile == ""){
												$imagefile = "images/defaultimg.jpg";
											}else{
												$imagefile = "pictures/" . $imagefile;
											}										

											$saleprice = number_format($row["normalprice"], $deccount);
											$oldprice = "";
											if($row["discountprice"] != 0){
												$saleprice = number_format($row["discountprice"], $deccount);
												$oldprice = "<span style='margin: 0px; margin-top: 20px; text-decoration: line-through; font-size: 12px; margin-right: 10px; color: gray;'>" . $currencysymbol . number_format($row["normalprice"], $deccount) . "</span>";
											}
											
											?>
											<div class="lilimage" style="background: url(<?php echo $baseurl . $imagefile ?>) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"></div>
											<div class="lildescr">
												<div class="shorttext" style="font-size: 18px; font-weight: bold;">
													<?php echo $row["title"] ?><br><i class="fa fa-angle-double-right"></i> <?php echo $oldprice. $currencysymbol . number_format($saleprice, $deccount) ?>
												</div>
												<div style="padding-left: 14px;">
													<p><?php echo shorten_text(strip_tags($row["content"]), 75, ' ...', false) ?></p>
												</div>
												<div style="padding-left: 14px;">
													<p style="color: <?php echo $maincolor ?>; font-weight: bold; font-size: 12px;"><?php if($enablepublishdate){ ?><i class="fa fa-calendar" style="width: 10px;"></i> <?php echo $postdate ?> <?php } ?><i class="fa fa-tag" style="margin-left: 5px; width: 10px;"></i> <?php echo showCatName($row["catid"]) ?></p>
												</div>
												
											</div>
										</div>
									</a>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
				<?php
			}
			
			//Home
			
			else{
				?>
				<div class="section" id="categoriesbar">
					<div style="text-align: center; overflow: auto; white-space: nowrap;">
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
				
				<?php
				if($enablerecentpostsliders){
					?>
					
					<div class="section firstthreecontainer">
						<div id="firstthree">
							<?php
							$sql = "SELECT * FROM $tableposts ORDER BY id DESC LIMIT 3";
							$result = mysqli_query($connection, $sql);
							if($result){
								if(mysqli_num_rows($result) == 0){
									echo "<p>" .uilang("There is no post published"). ".</p>";
								}else{
									while($row = mysqli_fetch_assoc($result)){
										$imagefile = $row["picture"];
										if($imagefile == ""){
											$imagefile = "images/filmbg.jpg";
										}else{
											$imagefile = "pictures/" . $imagefile;
										}
										?>
										
										<div class="firstthreeblock" style="background: url(<?php echo $baseurl . $imagefile ?>) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
											<a href="?post=<?php echo $row["postid"] ?>">
												<div style="display: table; width: 100%; height: 100%; background-color: rgba(0,0,0,.5); padding: 40px; box-sizing: border-box; border-radius: 5px;">
													<div class="smallinmobile w75">
														<h2><?php echo shorten_text($row["title"], 40, ' ...', true) ?></h2>
														<p><?php echo shorten_text(strip_tags($row["content"]), 256, ' ...', false) ?></p>
													</div>
													<div class="smallinmobile w25" style="vertical-align: middle; text-align: center;">
														<div class="morebutton"><?php echo uilang("MORE") ?> <i class="fa fa-chevron-right" style="width: 30px;"></i></div>
													</div>
												</div>
											</a>
										</div>
										<?php
									}
								}
							}
							
							?>
						</div>
					</div>
					<?php
				}
				?>
				
				<div class="section gridcontainerunscrollable">
					<?php
					$sql = "SELECT * FROM $tableposts ORDER BY id DESC";
					$result = mysqli_query($connection, $sql);
					if($result){
						if(mysqli_num_rows($result) > 0){
							$productindex = 0;
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
									<a href="<?php echo $baseurl ?>?post=<?php echo $row["postid"] ?>">
										<?php
										if($thumbnailmode == "0"){
											?>
												<div class="productthumbnail" style="cursor: pointer; background-image: url(<?php echo $baseurl . $imagefile ?>); background-attachment: fill; background-position: center; background-repeat: no-repeat; background-size: auto 100%;">
											</div>
											<?php
										}else if($thumbnailmode == "1"){
											?>
												<div class="productthumbnail" style="cursor: pointer; background-image: url(<?php echo $baseurl . $imagefile ?>); background-attachment: fill; background-position: center; background-repeat: no-repeat; background-size: 100% 100%;">
											</div>
											<?php
										}
										?>
									</a>
									<div class="prodimage" style="display: none;"><?php echo $imagefile ?></div>
									<div>
										
										<?php
										$saleprice = $row["normalprice"];
										$oldprice = "";
										if($row["discountprice"] != 0){
											$saleprice = $row["discountprice"];
											$oldprice = "<span style='margin: 0px; margin-top: 20px; text-decoration: line-through; font-size: 12px; margin-right: 10px; color: gray;'>" . $currencysymbol . number_format($row["normalprice"], $deccount) . "</span>";
										}
										?>
										
										<h2 style="margin-top: 20px;" class="producttitle"><?php echo shorten_text($row["title"], 25, ' ...', false) ?></h2><div class="realproducttitle" style="display: none"><?php echo $row["title"] ?></div><div class="productoptions" style="display: none"><?php echo $row["options"] ?></div><div style="padding-bottom: 20px; font-size: 25px; font-weight: bold; color: <?php echo $maincolor ?>"><?php echo $oldprice . $currencysymbol . "<span class='thiscurrentpricedisplay'>" . number_format($saleprice, $deccount) ?></span><span style="display: none;" class="thiscurrentprice"><?php echo $saleprice ?></span> <span style="font-size: 12px;">x</span> <input class="productquantity" type="number" value=1 min=1 style="vertical-align: middle; display: inline-block; width: 60px; font-weight: bold; padding: 10px; margin: 5px; border-radius: 0px;" onkeyup="onlyNumbers(this)"></div>
										<div class="morebutton" onclick="addtocart(<?php echo $productindex ?>)"><i class="fa fa-shopping-cart"></i> <?php echo uilang("Add to Cart") ?></div>
										<div style="padding: 20px;"><a onclick="showmore(<?php echo $productindex ?>)" class="textlink whatsmorebutton" style="cursor: pointer; text-decoration: none;"><i class="fa fa-chevron-down"></i> <?php echo uilang("More") ?></a><div class="whatsmorecontent" style="display: none; padding: 5px; font-size: 12px;"><?php echo shorten_text(strip_tags($row["content"]), 50, " ...") ?><br><a class="textlink" href="<?php echo $baseurl ?>?post=<?php echo $row["postid"] ?>"><?php echo uilang("Continue") ?></a></div></div>
									</div>
								</div>
								<?php
								
								$productindex = $productindex + 1;

							}
						}
					}
					
					?>
				</div>
				<?php
			}
			
			?>
			
			<div id="cartbutton" onclick="showcartui()">
				<div class="cartbuttoncircle" style="-webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.35); -moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.35); box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.35); border-radius: 50%; background-color: white; text-align: center; display: table-cell; vertical-align: middle; border: 2px solid <?php echo $maincolor ?>; position: relative;">
					<div style="position: absolute; top: 0; text-align: center; font-size: 20px; left: 0; right: 0; padding: 5px; font-weight: bold;" id="cartcount"></div>
					<i class="fa fa-shopping-cart" style="cursor: pointer;"></i>
				</div>
			</div>
			
			<div id="imagedisplayer" onclick="hideimagedisplayer()"></div>
			
			
			<!-- Footer -->
			<div class="section footercopyright">
				<span>© <?php echo date("Y"); ?> <?php echo $websitetitle; ?>. All rights reserved.</span>
			</div>
			
			<div id="cartui">
				<div style="max-width: 720px; margin: 0 auto;">
				<h3 onclick='hidecartui()' style='color: <?php echo $maincolor ?>; cursor: pointer;'><i class='fa fa-arrow-left'></i> Back</h3>
					<h1><i class='fa fa-shopping-cart'></i> <?php echo uilang("Shopping Cart") ?></h1>
					<div id="cartdata"></div>
				</div>
			</div>
			
			
			
			<script>
			
				function showimage(img){
					$("#imagedisplayer").html("<img src='<?php echo $baseurl ?>" +img+ "' style='height: 100%;'>").fadeIn()
				}
				
				function hideimagedisplayer(){
					$("#imagedisplayer").fadeOut()
				}
				
				var currentcategory = ""
				
				function filtercategory(catname){
					currentcategory = catname
					if(catname == ""){
						$(".filmblock").fadeIn()
					}else{
						$(".filmblock").hide()
						for(var i = 0; i < $(".filmblock").length; i++){
							if($(".filmblock").eq(i).find(".categoryname").html() == catname)
								$(".filmblock").eq(i).fadeIn()
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
								if(x == 0){
									var selectedprice = poobject[0].options[x].price
									$(".thiscurrentprice").eq(i).html(selectedprice)
									selectedprice = parseFloat(selectedprice)
									$(".thiscurrentpricedisplay").eq(i).html(tSep(selectedprice.toFixed(<?php echo $deccount ?>)))
								}
								pocontents += "<option value=" +poobject[0].options[x].price + ">" +poobject[0].options[x].title+ "</option>"
							}
							$(".filmblock").eq(i).find(".productoptions").html("<label class='poptionname'>" +poobject[0].title+ "</label><select onchange='overrideprice("+i+")' class='currentproductoption"+i+"' style='padding: 3px; width: 114px; margin: 0 auto;'>" + pocontents + "</select>").show()
						}
					}
				}
				
				showproductoptions()
				
				function showmore(n){
					$(".whatsmorecontent").eq(n).slideToggle()
				}
				
				function overrideprice(n){
					var selectedprice = $(".currentproductoption"+n+" option:selected").val()
					$(".thiscurrentprice").eq(n).html($(".currentproductoption"+n+" option:selected").val())
					selectedprice = parseFloat(selectedprice)
					$(".thiscurrentpricedisplay").eq(n).html(tSep(selectedprice.toFixed(<?php echo $deccount ?>)))
				}
				
				var cartobject = []
				
				function savedata(){
					localStorage.setItem("<?php echo $websitetitle ?>", JSON.stringify(cartobject))
				}
				
				function loaddata(){
					cartobject = JSON.parse(localStorage.getItem("<?php echo $websitetitle ?>"))
				}
				
				if(localStorage.getItem("<?php echo $websitetitle ?>") === null)
					savedata()
				else
					loaddata()
				
				loaddata()
				updatecartcount()
				
				function addtocart(n){
					
					var prod = $(".filmblock").eq(n)
					var prodop = prod.find(".currentproductoption"+n+" option:selected").text()
					if(prodop != "")
						prodop = " - " + prodop
					var prodtitle = prod.find(".realproducttitle").text() + prodop
					var prodprice = parseFloat(prod.find(".thiscurrentprice").text())
					var prodquantity = parseFloat(prod.find(".productquantity").val())
					var prodimage = prod.find(".prodimage").eq(0).text()
					
					function pushit(){
						cartobject.push({
							id : n,
							title : prodtitle,
							price : prodprice,
							quantity : prodquantity,
							image : prodimage,
							notes : "",
						})
						updatecartcount()
						savedata()
					}
					
					if(cartobject.length == 0){
						pushit()
					}else{
						for(var i = 0; i < cartobject.length; i++){
							if(cartobject[i].title == prodtitle && cartobject[i].price == prodprice){
								cartobject[i].quantity += prodquantity
								updatecartcount()
								savedata()
								return
							}
						}
						pushit()
						return
					}				
					
				}
				
				function updatecartcount(){
					
					$("#cartbutton").fadeOut(100, function(){
						$("#cartbutton").fadeIn()
					})
					$("#cartcount").html(cartobject.length)
					
				}
				
				function removeitem(i){
					cartobject.splice(i, 1);
					showcartui();
				}
				
				var ordermessage = ""
				
				function showcartui(){
					
					var today = new Date()
					var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()
					var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds()
					var dateTime = date+' '+time
					var orderid = ( Math.floor(Math.random() * 9000) + 1000 ) + "/" + dateTime
					
					ordermessage = "ORDER ID: " + orderid + "\nDATE: " +today+ "\n"
					var cartdata = ""
					var grandtotal = 0;
					if(cartobject.length > 0){
						cartdata += "<div style='display: table; width: 100%;'>";
						for(var i = 0; i < cartobject.length; i++){
							var tmpttl = cartobject[i].price * cartobject[i].quantity
							cartdata += "<div style='margin-bottom: 10px;'><div style='display: table-cell; vertical-align: middle;'><img src='<?php echo $baseurl ?>"+cartobject[i].image+"' style='max-width: 64px; border-radius: 5px; margin-bottom: 10px;'></div><div style='display: table-cell; vertical-align: middle; padding-left: 10px; padding-right: 10px; font-size: 14px;'>"+cartobject[i].title + " <?php echo $currencysymbol ?>" + tSep(parseFloat(cartobject[i].price).toFixed(<?php echo $deccount ?>)) + "</div><div style='display: table-cell; vertical-align: middle;'>*</div><div style='display: table-cell; vertical-align: top;'><input id='cartq"+i+"' onchange='modifycq("+i+")' class='productquantity' type='number' value=" + cartobject[i].quantity + " min=1 style='vertical-align: middle; display: inline-block; width: 60px; font-weight: bold; padding: 10px; margin: 5px; border-radius: 0px;' onkeyup='onlyNumbers(this)'></div><div style='display: table-cell; vertical-align: middle;'>=</div><div style='display: table-cell; vertical-align: middle;'><div style='padding-left: 5px; padding-right: 5px;'><?php echo $currencysymbol ?>" + tSep(tmpttl.toFixed(<?php echo $deccount ?>)) + "</div></div><div style='display: table-cell; vertical-align: middle; padding-left: 5px; padding-right: 5px;' onclick='removeitem("+i+")'><i class='fa fa-trash' style='color: red;'></i></div></div>"
							grandtotal += tmpttl
							
							ordermessage += "- " + cartobject[i].title + " x " + cartobject[i].quantity + " = <?php echo $currencysymbol ?> " + tmpttl.toFixed(<?php echo $deccount ?>) + "\n"
						}
						cartdata += "</div>";
					}
					
					ordermessage += "<?php echo uilang("Total") ?> = <?php echo $currencysymbol ?> " + grandtotal.toFixed(<?php echo $deccount ?>) + "\n"
					
					cartdata += "<hr style='background-color: white;'><h1><?php echo uilang("Total") ?> = <?php echo $currencysymbol ?>" + tSep(grandtotal.toFixed(<?php echo $deccount ?>)) + "</h1>"
					cartdata += "<h3><?php echo uilang("Contact Information") ?></h3><label><?php echo uilang("Name") ?></label><input id='cdname' placeholder='<?php echo uilang("Name") ?>'>"
					cartdata += "<label><?php echo uilang("Mobile") ?></label><input id='cdmobile' type='number' placeholder='<?php echo uilang("Mobile") ?>'>"
					cartdata += "<label><?php echo uilang("Delivery Address") ?></label><input id='cdaddress' placeholder='<?php echo uilang("Delivery Address") ?>'>"
					cartdata += "<label><?php echo uilang("Delivery Method") ?></label><select id='cdmethod'><?php echo uilang("Delivery Method") ?><option>Take Away</option><option>Home Delivery</option><option>Dining</option></select>"
					cartdata += "<label><?php echo uilang("Order Notes") ?></label><textarea id='cartordernotes' placeholder='<?php echo uilang("Order Notes") ?>'></textarea>"
					cartdata += "<div style='text-align: center;'><div class='buybutton' onclick='hidecartui()'><i class='fa fa-arrow-left'></i> <?php echo uilang("Back to Shop") ?></div><div class='buybutton' onclick='clearcart()'><i class='fa fa-times'></i> <?php echo uilang("Clear Cart") ?></div><div class='buybutton' onclick='chatnow()'><i class='fa fa-whatsapp'></i> <?php echo uilang("Order on WhatsApp") ?></div></div>"
					$("#cartdata").html(cartdata)
					$("#cartui").fadeIn()
					savedata()
					
				}
				
				function hidecartui(){
					
					$("#cartui").fadeOut()
					
				}
				
				function clearcart(){
					cartobject = []
					showcartui()
					updatecartcount()
				}
				
				function modifycq(n){
					var newvalue = parseFloat($("#cartq"+n).val())
					cartobject[n].quantity = newvalue
					showcartui()
				}
				
				function chatnow(){
					var cdname = $("#cdname").val()
					var cdmobile = $("#cdmobile").val()
					var cdaddress = $("#cdaddress").val()
					var cdmethod = $("#cdmethod").val()
					
					if(cdname != "" && cdmobile != "" && cdaddress != "" && cdmethod != ""){
					
						ordermessage += "<?php echo uilang("Name") ?>: " + cdname + "\n<?php echo uilang("Mobile") ?>: " + cdmobile + "\n<?php echo uilang("Address") ?>: " + cdaddress + "\n<?php echo uilang("Delivery Method") ?>: " + cdmethod + "\n" + "ORDER NOTES: " + $("#cartordernotes").val()
						$.post("<?php echo $baseurl ?>ordernotes.php", {
							"message" : ordermessage
						}, function(data){
							ordermessage = ordermessage.replaceAll("&", "and");
							var omuri = encodeURI(ordermessage);
							console.log(ordermessage);
							//location.href = "https://wa.me/<?php echo $adminwhatsapp ?>?text=" + omuri
							window.open("https://wa.me/<?php echo $adminwhatsapp ?>?text=" + omuri, '_blank');
						})
					
					}else{
						alert("<?php echo uilang("Please fill all details.") ?>")
					}
				}
				
				function quicksearch(){
					var keyword = $("#quicksearch").val();
					keyword = keyword.toLowerCase();
					if(keyword.length > 0){
						for(var i = 0; i < $(".filmblock").length; i++){
							if($(".filmblock")[i].innerHTML.toLowerCase().indexOf(keyword) > -1) $(".filmblock")[i].style.display = "inline-block";
							else $(".filmblock")[i].style.display = "none";
						}
					} else $(".filmblock").css({ display : "inline-block" });
					
				}
				
				function clearSearchInput(){
					$("#quicksearch").val("")
					quicksearch()
				}
				
				var postsearchinterval
				function searchonhomepage(){
					clearInterval(postsearchinterval)
					postsearchinterval = setTimeout(function(){
						var qstring = $("#quicksearch").val()
						if(qstring != "")
							location.href = "<?php echo $baseurl ?>#search=" + qstring
					}, 2000)
				}
				
				try{
					if(location.href.split("#")[1].split("=")[0] == "search"){
						if(location.href.split("#")[1].split("=")[1] != ""){
							$("#quicksearch").val(location.href.split("#")[1].split("=")[1])
							quicksearch()
						}
					}else if(location.href.split("#")[1].split("=")[0] == "filtercat"){
						if(location.href.split("#")[1].split("=")[1] != ""){
							filtercategory(location.href.split("#")[1].split("=")[1]);
						}
					}
				}catch(e){
					console.log(e)
				}
				
				$(document).ready(function(){
					$('#firstthree').slick({
						autoplaySpeed: 3000,
						autoplay : true,
						infinite: true,
					});
				})
				
				function onlyNumbers(num){
				   if ( /[^0-9]+/.test(num.value) ){
					  num.value = num.value.replace(/[^0-9]*/g,"")
				   }
				}
			</script>
		</body>
	</html>
	
	<?php

}
?>

