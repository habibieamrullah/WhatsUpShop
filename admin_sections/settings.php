<?php
/*
Admin - Settings Section
Configure website title, colors, logo, currency, language and feature toggles.
*/
if (!isset($connection)) {
    exit;
}

// Save settings
if (isset($_POST["saveSettings"])) {
    $cfg->websitetitle = mysqli_real_escape_string($connection, $_POST["websitetitle"]);
    $cfg->maincolor = mysqli_real_escape_string($connection, $_POST["maincolor"]);
    $cfg->secondcolor = mysqli_real_escape_string($connection, $_POST["secondcolor"]);
    $cfg->about = mysqli_real_escape_string($connection, $_POST["about"]);
    $cfg->language = mysqli_real_escape_string($connection, $_POST["language"]);
    $cfg->adminwhatsapp = mysqli_real_escape_string($connection, $_POST["adminwhatsapp"]);
    $cfg->currencysymbol = mysqli_real_escape_string($connection, $_POST["currencysymbol"]);
    $cfg->thumbnailmode = (int) $_POST["thumbnailmode"];
    $cfg->enablerecentpostsliders = isset($_POST["enablerecentpostsliders"]);
    $cfg->enablefacebookcomment = isset($_POST["enablefacebookcomment"]);
    $cfg->enablepublishdate = isset($_POST["enablepublishdate"]);
    $cfg->disabledecimals = isset($_POST["disabledecimals"]);

    $share = isset($_POST["sharebuttonsoption"]) ? $_POST["sharebuttonsoption"] : array();
    $cfg->sharebuttonsoption = $share;

    // Logo upload
    if (isset($_FILES["logo"]) && $_FILES["logo"]["size"] > 0) {
        $ext = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));
        if (in_array($ext, array("jpg", "jpeg", "png", "gif"))) {
            $logoname = "logo_" . substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 8) . "." . $ext;
            if (move_uploaded_file($_FILES["logo"]["tmp_name"], "pictures/" . $logoname)) {
                $cfg->logo = $logoname;
            }
        }
    }

    $json = json_encode($cfg, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $stmt = $connection->prepare("UPDATE $tableconfig SET value = ? WHERE config = 'cfg'");
    $stmt->bind_param("s", $json);
    $stmt->execute();
    $stmt->close();

    echo "<div class='alert'>" . uilang("Settings updated!") . "</div>";

    // Refresh local variables
    $websitetitle = stripslashes($cfg->websitetitle);
    $maincolor = $cfg->maincolor;
    $secondcolor = $cfg->secondcolor;
    $about = stripslashes($cfg->about);
    $language = $cfg->language;
    $logo = $cfg->logo;
    $adminwhatsapp = $cfg->adminwhatsapp;
    $currencysymbol = $cfg->currencysymbol;
    $thumbnailmode = $cfg->thumbnailmode;
    $enablerecentpostsliders = $cfg->enablerecentpostsliders;
    $enablefacebookcomment = $cfg->enablefacebookcomment;
    $enablepublishdate = $cfg->enablepublishdate;
    $disabledecimals = $cfg->disabledecimals;
    $sharebuttonsoption = $cfg->sharebuttonsoption;
}

$shareOptions = array("Facebook", "Twitter", "Email", "Pinterest", "Linkedin", "WhatsApp", "Telegram");
$currentLogo = $logo ? "pictures/" . $logo : "images/logo.png";
?>

<div class="admin-page-header">
    <h1><i class="fa fa-cogs"></i> <?php echo uilang("Settings") ?></h1>
    <p class="admin-page-subtitle"><?php echo htmlspecialchars($websitetitle) ?></p>
</div>

<form action="<?php echo $baseurl ?>admin.php?settings" method="post" enctype="multipart/form-data">
    <div class="admin-card">
        <div class="admin-card-header"><h2><i class="fa fa-info-circle"></i> <?php echo uilang("Website Title") ?></h2></div>
        <div class="admin-card-body">
            <div class="form-group">
                <label><?php echo uilang("Website Title") ?></label>
                <input type="text" name="websitetitle" value="<?php echo htmlspecialchars($websitetitle) ?>">
            </div>
            <div class="form-group">
                <label><?php echo uilang("About") ?></label>
                <textarea name="about"><?php echo htmlspecialchars($about) ?></textarea>
            </div>
            <div class="form-group">
                <label><?php echo uilang("Logo") ?></label>
                <div class="current-image"><img src="<?php echo $baseurl . $currentLogo ?>" alt="Logo"></div>
                <input class="fileinput" type="file" name="logo" accept="image/*">
            </div>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header"><h2><i class="fa fa-paint-brush"></i> <?php echo uilang("Main Color") ?></h2></div>
        <div class="admin-card-body">
            <div class="form-row">
                <div class="form-group">
                    <label><?php echo uilang("Main Color") ?></label>
                    <input type="text" name="maincolor" class="jscolor" value="<?php echo htmlspecialchars($maincolor) ?>">
                </div>
                <div class="form-group">
                    <label><?php echo uilang("Secondary Color") ?></label>
                    <input type="text" name="secondcolor" class="jscolor" value="<?php echo htmlspecialchars($secondcolor) ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header"><h2><i class="fa fa-globe"></i> <?php echo uilang("Language") ?></h2></div>
        <div class="admin-card-body">
            <div class="form-row">
                <div class="form-group">
                    <label><?php echo uilang("Language") ?></label>
                    <select name="language">
                        <option value="en" <?php if ($language == "en") echo "selected"; ?>>English</option>
                        <option value="id" <?php if ($language == "id") echo "selected"; ?>>Bahasa Indonesia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo uilang("Currency Symbol") ?></label>
                    <input type="text" name="currencysymbol" value="<?php echo htmlspecialchars($currencysymbol) ?>">
                </div>
                <div class="form-group">
                    <label><?php echo uilang("Admin WhatsApp Phone Number") ?></label>
                    <input type="text" name="adminwhatsapp" value="<?php echo htmlspecialchars($adminwhatsapp) ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header"><h2><i class="fa fa-sliders"></i> <?php echo uilang("Settings") ?></h2></div>
        <div class="admin-card-body">
            <div class="form-group">
                <label><?php echo uilang("Home Thumbnail Mode") ?></label>
                <select name="thumbnailmode">
                    <option value="0" <?php if ($thumbnailmode == 0) echo "selected"; ?>><?php echo uilang("Center Filled") ?></option>
                    <option value="1" <?php if ($thumbnailmode == 1) echo "selected"; ?>><?php echo uilang("Stretched Width or Height") ?></option>
                </select>
            </div>
            <div class="toggle-group">
                <label class="toggle"><input type="checkbox" name="enablerecentpostsliders" <?php if ($enablerecentpostsliders) echo "checked"; ?>> <span><?php echo uilang("Enable Recent Posts Slider?") ?></span></label>
                <label class="toggle"><input type="checkbox" name="enablefacebookcomment" <?php if ($enablefacebookcomment) echo "checked"; ?>> <span><?php echo uilang("Enable Facebook Comment?") ?></span></label>
                <label class="toggle"><input type="checkbox" name="enablepublishdate" <?php if ($enablepublishdate) echo "checked"; ?>> <span><?php echo uilang("Enable Publish Date?") ?></span></label>
                <label class="toggle"><input type="checkbox" name="disabledecimals" <?php if ($disabledecimals) echo "checked"; ?>> <span><?php echo uilang("Disable Decimals") ?></span></label>
            </div>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header"><h2><i class="fa fa-share-alt"></i> <?php echo uilang("Share Buttons Option") ?></h2></div>
        <div class="admin-card-body">
            <div class="toggle-group">
                <?php foreach ($shareOptions as $so): ?>
                    <label class="toggle"><input type="checkbox" name="sharebuttonsoption[]" value="<?php echo $so ?>" <?php if (IsChecked($sharebuttonsoption, $so)) echo "checked"; ?>> <span><?php echo $so ?></span></label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <input class="submitbutton" type="submit" name="saveSettings" value="<?php echo uilang("Submit") ?>">
    </div>
</form>
