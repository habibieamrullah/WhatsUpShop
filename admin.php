<?php
/*
Developed by Habibie
Email: habibieamrullah@gmail.com 
WhatsApp: 6287880334339
WebSite: https://webappdev.my.id
*/

// Start session and include required files
session_start();
require_once("config.php");
require_once("functions.php");
require_once("uilang.php");

// Check if user is logged in
$isLoggedIn = isset($_SESSION["adminusername"]) && isset($_SESSION["adminpassword"]) 
              && $username === $_SESSION["adminusername"] 
              && $password === $_SESSION["adminpassword"];

// Handle logout
if(isset($_GET["logout"])) {
    session_destroy();
    header("Location: " . $baseurl . "admin.php");
    exit;
}

// Handle login form submission
if(!$isLoggedIn && isset($_POST["username"]) && isset($_POST["password"])) {
    if($username === $_POST["username"] && $password === $_POST["password"]) {
        $_SESSION["adminusername"] = $_POST["username"];
        $_SESSION["adminpassword"] = $_POST["password"];
        header("Location: " . $baseurl . "admin.php");
        exit;
    } else {
        $loginError = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel | <?php echo htmlspecialchars($websitetitle) ?></title>
    <meta charset="utf-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="<?php echo $baseurl ?>favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo $baseurl ?>favicon.ico" type="image/x-icon">
    
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>assets/css/font-awesome.css">
    <?php include("style.php"); ?>
    
    <!-- JS -->
    <script src="jquery.min.js"></script>
    <script src="tinymce/tinymce.min.js"></script>
    <script src="jquery.form.js"></script>
    <script src="jscolor.js"></script>
    <script src="<?php echo $baseurl ?>somefunctions.js"></script>
    
    <style>
        body {
            padding: 0;
            margin: 0;
            font-family: 'Dosis', sans-serif;
        }
        .adminleftbaritem {
            padding: 10px;
            border-bottom: 1px solid #2e2e2e;
            cursor: pointer;
            transition: background-color .5s;
        }
        .adminleftbaritem:hover {
            background-color: white;
            color: black;
        }
        .bar {
            background-color: <?php echo $maincolor ?>; 
            display: block;
            height: 3px;
            border-radius: 10px;
            width: 0;
        }
        /* Add more CSS optimizations here */
        .alert {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <?php if(!$isLoggedIn): ?>
        <!-- Login Form -->
        <div class="loginform">
            <div style="text-align: center; padding: 20px;">
                <?php $currentlogo = $logo ? "pictures/" . $logo : "images/logo.png"; ?>
                <img src="<?php echo $currentlogo ?>" width="128" alt="Logo"><br>
                <p><?php echo htmlspecialchars($websitetitle) ?> - Admin Panel</p>
            </div>
            <h1><?php echo uilang("Login") ?></h1>
            <?php if(isset($loginError)): ?>
                <div class="alert">Login error!</div>
            <?php endif; ?>
            <form method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input class="submitbutton" type="submit" value="<?php echo uilang("Login") ?>">
            </form>
        </div>
    <?php else: ?>
        <!-- Admin Panel Content -->
        <div class="barsbutton" onclick="toggleadminmenu()"><i class="fa fa-bars"></i></div>
        
        <div style="display: table; position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; height: 100%;">
            <div style="display: table-row; height: 100%;">
                <!-- Admin Menu -->
                <div class="adminmenubar">
                    <div class="stickythingy">
                        <div style="padding: 40px;">
                            <?php $currentlogo = $logo ? "pictures/" . $logo : "images/logo.png"; ?>
                            <a target="_blank" href="<?php echo $baseurl ?>"><img src="<?php echo $currentlogo ?>" style="display: border-box; width: 100%;" alt="Logo"></a>
                        </div>
                        
                        <?php 
                        $menuItems = [
                            ['icon' => 'fa-home', 'link' => 'admin.php', 'text' => 'Home'],
                            ['icon' => 'fa-plus', 'link' => 'admin.php?newpost', 'text' => 'Add Product'],
                            ['icon' => 'fa-image', 'link' => 'admin.php?pictures', 'text' => 'Pictures'],
                            ['icon' => 'fa-tag', 'link' => 'admin.php?categories', 'text' => 'Categories'],
                            ['icon' => 'fa-file-text', 'link' => 'admin.php?orders', 'text' => 'Orders'],
                            ['icon' => 'fa-cogs', 'link' => 'admin.php?settings', 'text' => 'Settings'],
                            ['icon' => 'fa-sign-out', 'link' => 'admin.php?logout', 'text' => 'Logout']
                        ];
                        
                        foreach ($menuItems as $item): ?>
                            <a href="<?php echo $baseurl . $item['link'] ?>">
                                <div class="adminleftbaritem">
                                    <i class="fa <?php echo $item['icon'] ?>" style="width: 30px;"></i> 
                                    <?php echo uilang($item['text']) ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                        
                        <div style="text-align: center; padding: 30px; font-size: 10px;">
                            <?php echo uilang("Developed by") ?><br>
                            <a target="_blank" class="textlink" style="color: lime;" href="https://webappdev.my.id/">https://webappdev.my.id/</a><br><br>
                            Donate to the author:<br>
                            <a href="https://www.paypal.me/habibieamrullah" class="textlink" style="color: lime;">https://www.paypal.me/habibieamrullah</a>
                        </div>
                    </div>
                </div>
                
                <!-- Main Content Area -->
                <div style="display: table-cell; padding: 25px; vertical-align: top; border-left: 1px solid <?php echo $maincolor ?>;">
                    <?php
                    // Determine which section to show based on GET parameters
                    $section = isset($_GET['newpost']) ? 'newpost' : 
                              (isset($_GET['pictures']) ? 'pictures' : 
                              (isset($_GET['categories']) ? 'categories' : 
                              (isset($_GET['settings']) ? 'settings' : 
                              (isset($_GET['editpost']) ? 'editpost' : 
                              (isset($_GET['orders']) ? 'orders' : 'home')))));
                    
                    include_once("admin_sections/" . $section . ".php");
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Image Displayer -->
        <div id="imagedisplayer" onclick="hideimagedisplayer()"></div>
        
        <!-- TinyMCE Initialization -->
        <script>
            tinymce.init({ 
                selector: 'textarea',
                plugins: 'directionality, code',
                toolbar: 'ltr rtl, code',
                relative_urls: false,
                remove_script_host: false
            });
        </script>
        
        <!-- Global Scripts -->
        <script>
            // Image Picker Functions
            function showimagepicker() {
                $("body").append("<div id='imagepickerui'><h2 onclick='closeimagepicker()' style='cursor: pointer;'><i class='fa fa-arrow-left'></i> Back</h2><div id='imagepickercontent'>Please wait...</div>")
                $.get("imagepicker.php", function(data) {
                    $("#imagepickercontent").html(data)
                })
            }
            
            function insertthis(img) {
                var randata = Math.ceil(Math.random()*10000)
                $("#moreimagesvisual").append("<div class='imgitem' style='display: inline-block; vertical-align: top;' onclick=removethis('" +randata+ "')><div class='imgitemdatarand' style='display: none'>"+randata+"</div><div class='imgitemdata' style='display: none'>"+img+"</div><img src='" + img + "' style='height: 64px; margin: 10px; border-radius: 5px; cursor: not-allowed;'></div>")
                closeimagepicker()
                ipvisualtodata()
            }
            
            function removethis(randata) {
                $(".imgitemdatarand").filter(function() {
                    return $(this).text() === randata;
                }).closest('.imgitem').remove();
                ipvisualtodata()
            }
            
            function ipvisualtodata() {
                var data = $(".imgitemdata").map(function() {
                    return $(this).text();
                }).get().join(",");
                $("#moreimagesinput").val(data)
            }
            
            function ipdatatovisual() {
                var data = $("#moreimagesinput").val().split(",").filter(Boolean);
                data.forEach(function(img) {
                    insertthis(img)
                });
            }
            
            function closeimagepicker() {
                $("#imagepickerui").remove()
            }
        
            function showimage(img) {
                $("#imagedisplayer").html("<img src='<?php echo $baseurl ?>" +img+ "' style='height: 100%;'>").fadeIn()
            }
            
            function hideimagedisplayer() {
                $("#imagedisplayer").fadeOut()
            }
            
            // Product Options Functions
            var moptions = []
            
            function addnewoptiontitle() {
                var nottl = $("#newoptiontitle").val()
                if(nottl) {
                    moptions.push({ title: nottl, options: [] })
                    updatemovisual()
                    closemoform()
                    $("#moformbutton").hide()
                    editmop(0)
                }
            }
            
            function editmop(i) {
                $("#moformedit").show()
                $("#motitletoedit").html(moptions[i].title)
                $("#currentmochilds").empty()
                
                moptions[i].options.forEach(function(opt, index) {
                    $("#currentmochilds").append(
                        `<div style='font-size: 12px; padding: 10px;'>
                            <i class='fa fa-arrow-right'></i> ${opt.title} (${tSep(opt.price)})
                            <span onclick='removeOptionItem(${i}, ${index})' style='cursor: pointer; margin-left: 10px; color: red;'>
                                <i class='fa fa-trash'></i>
                            </span>
                        </div>`
                    )
                })
            }
            
            function removeOptionItem(optionIndex, itemIndex) {
                moptions[optionIndex].options.splice(itemIndex, 1)
                editmop(optionIndex)
                updatemovisual()
            }
            
            function addcurrentmoitem() {
                var moitem = $("#moitem").val()
                var moprice = parseFloat($("#moprice").val()) || 0
                if(moitem && moprice > 0) {
                    moptions[0].options.push({ title: moitem, price: moprice })
                    $("#moitem").val("").focus()
                    $("#moprice").val(0)
                    updatemovisual()
                    editmop(0)
                }
            }
            
            function showmoform() {
                $("#moformbutton").hide()
                $("#moform").show()
            }
            
            function closemoform() {
                $("#moformbutton").show()
                $("#moform").hide()
            }
            
            function closemoeditform() {
                $("#moformedit").hide()
            }
            
            function updatemovisual() {
                if(moptions.length > 0) {
                    var mocontent = ""
                    moptions.forEach(function(opt, i) {
                        mocontent += `<div class='categoryblock'>
                            <div>
                                <i class='fa fa-check-square-o'></i> ${opt.title}
                                <span onclick='editmop(${i})' style='cursor: pointer; margin-left: 20px; font-size: 12px; color: black;'>
                                    <i class='fa fa-edit'></i> <?php echo uilang("Edit") ?>
                                </span>
                            </div>`
                        
                        if(opt.options.length > 0) {
                            opt.options.forEach(function(item) {
                                mocontent += `<div style='font-size: 12px; padding: 10px;'>
                                    <i class='fa fa-arrow-right'></i> ${item.title} (${tSep(item.price)})
                                </div>`
                            })
                        }
                        mocontent += "</div>"
                    })
                    $("#moreoptionsvisual").html(mocontent)
                    $("#moreoptions").val(JSON.stringify(moptions))
                } else {
                    $("#moreoptionsvisual").html("<?php echo uilang("There is no option has been added.") ?>")
                    $("#moformbutton").show()
                }
            }
            
            // Form Upload Progress
            $(function() {
                $('form').ajaxForm({
                    beforeSend: function() {
                        $('#status').empty()
                        $('.bar').width('0%')
                        $('.percent').html('0%')
                        $(".progress").slideDown()
                        $(".postform").slideUp()
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%'
                        $('.bar').width(percentVal)
                        $('.percent').html(percentVal)
                    },
                    complete: function(xhr) {
                        $('#status').html(xhr.responseText)
                    }
                })
            })
            
            // Global Functions
            function toggleadminmenu() {
                $(".adminmenubar").toggle()
            }
            
            // Auto-hide alerts after 2 seconds
            setTimeout(function() {
                $(".alert").slideUp()
            }, 2000)
            
            // Initialize options if they exist
            $(document).ready(function() {
                if($("#moreoptions").val()) {
                    moptions = JSON.parse($("#moreoptions").val())
                    updatemovisual()
                }
                
                if($("#moreimagesinput").val()) {
                    ipdatatovisual()
                }
            })
        </script>
    <?php endif; ?>
</body>
</html>