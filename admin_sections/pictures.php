<?php
/*
Admin - Pictures Section
Upload and manage additional product images.
*/
if (!isset($connection)) {
    exit;
}

// Handle image deletion
if (isset($_GET["deletepic"])) {
    $delpic = basename($_GET["deletepic"]);
    $delpath = "pictures/" . $delpic;
    if ($delpic != "" && file_exists($delpath)) {
        unlink($delpath);
        echo "<div class='alert'>" . uilang("A picture has been deleted.") . "</div>";
    }
}

// Handle upload
if (isset($_FILES["picturefile"]) && $_FILES["picturefile"]["size"] > 0) {
    $extsAllowed = array('jpg', 'jpeg', 'png', 'gif');
    $extension = strtolower(pathinfo($_FILES["picturefile"]["name"], PATHINFO_EXTENSION));
    if (in_array($extension, $extsAllowed)) {
        $newname = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 10) . "." . $extension;
        if (move_uploaded_file($_FILES["picturefile"]["tmp_name"], "pictures/" . $newname)) {
            echo "<div class='alert'>" . uilang("Picture upload is OK") . ".</div>";
        } else {
            echo "<div class='alert'>" . uilang("Error during uploading. Try again") . "</div>";
        }
    } else {
        echo "<div class='alert'>" . uilang("File is not valid. Please try again") . ".</div>";
    }
}

$files = glob("pictures/*");
if ($files === false) { $files = array(); }
usort($files, function ($x, $y) {
    return filemtime($x) < filemtime($y);
});
?>

<div class="admin-page-header">
    <h1><i class="fa fa-image"></i> <?php echo uilang("Pictures") ?></h1>
    <p class="admin-page-subtitle"><?php echo count($files) ?> <?php echo uilang("Pictures") ?></p>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fa fa-cloud-upload"></i> <?php echo uilang("Add more picture") ?></h2>
    </div>
    <div class="admin-card-body">
        <form action="<?php echo $baseurl ?>admin.php?pictures" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input class="fileinput" type="file" name="picturefile" accept="image/*" required>
            </div>
            <div class="form-actions">
                <input class="submitbutton" type="submit" value="<?php echo uilang("Submit") ?>">
            </div>
        </form>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fa fa-th"></i> <?php echo uilang("Pictures") ?></h2>
    </div>
    <div class="admin-card-body">
        <?php if (count($files) == 0): ?>
            <div class="empty-state">
                <i class="fa fa-picture-o"></i>
                <p><?php echo uilang("Nothing found") ?></p>
            </div>
        <?php else: ?>
            <div class="picture-grid">
                <?php foreach ($files as $item): ?>
                    <div class="picture-item">
                        <img src="<?php echo $baseurl . $item ?>" alt="picture" onclick="showimage('<?php echo $item ?>')">
                        <a class="picture-delete" href="<?php echo $baseurl ?>admin.php?pictures&deletepic=<?php echo urlencode(basename($item)) ?>" onclick="return confirm('<?php echo uilang("Delete") ?>?');">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
