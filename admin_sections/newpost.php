<?php
/*
Admin - Add Product (New Post) Section
*/
if (!isset($connection)) {
    exit;
}
?>

<div class="admin-page-header">
    <h1><i class="fa fa-plus-circle"></i> <?php echo uilang("Add Product") ?></h1>
    <p class="admin-page-subtitle"><?php echo uilang("New Post") ?></p>
</div>

<div class="progress" style="display: none;">
    <div class="progress-label"><?php echo uilang("Upload progress") ?>: <span class="percent">0%</span></div>
    <div class="progress-track"><div class="bar"></div></div>
</div>

<div id="status"></div>

<form class="postform admin-card" action="<?php echo $baseurl ?>postupload.php" method="post" enctype="multipart/form-data">
    <div class="admin-card-body">
        <div class="form-group">
            <label><i class="fa fa-header"></i> <?php echo uilang("Title") ?></label>
            <input type="text" name="newposttitle" placeholder="<?php echo uilang("Title") ?>" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label><i class="fa fa-tag"></i> <?php echo uilang("Category") ?></label>
                <select name="catid">
                    <?php
                    $res = mysqli_query($connection, "SELECT * FROM $tablecategories ORDER BY category ASC");
                    if ($res && mysqli_num_rows($res) > 0) {
                        while ($c = mysqli_fetch_assoc($res)) {
                            echo "<option value='" . $c["id"] . "'>" . htmlspecialchars($c["category"]) . "</option>";
                        }
                    } else {
                        echo "<option value='0'>" . uilang("Uncategorized") . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label><i class="fa fa-money"></i> <?php echo uilang("Price") ?></label>
                <input type="number" step="any" name="newpostnormalprice" placeholder="<?php echo uilang("Price") ?>" value="0">
            </div>
            <div class="form-group">
                <label><i class="fa fa-percent"></i> <?php echo uilang("Discount Price") ?></label>
                <input type="number" step="any" name="newpostdiscountprice" placeholder="<?php echo uilang("Discount Price") ?>" value="0">
            </div>
        </div>

        <div class="form-group">
            <label><i class="fa fa-picture-o"></i> <?php echo uilang("Image File") ?></label>
            <input class="fileinput" type="file" name="newpicture" accept="image/*">
        </div>

        <div class="form-group">
            <label><i class="fa fa-th"></i> <?php echo uilang("Additional Images") ?></label>
            <input type="hidden" id="moreimagesinput" name="moreimagesinput" value="">
            <div id="moreimagesvisual" class="imgvisual"></div>
            <div class="buybutton" onclick="showimagepicker()"><i class="fa fa-plus"></i> <?php echo uilang("Add more picture") ?></div>
        </div>

        <div class="form-group">
            <label><i class="fa fa-list"></i> <?php echo uilang("Option") ?></label>
            <input type="hidden" id="moreoptions" name="moreoptions" value="">
            <div id="moreoptionsvisual" class="optionsvisual"><?php echo uilang("There is no option has been added.") ?></div>
            <div id="moformbutton" class="buybutton" onclick="showmoform()"><i class="fa fa-plus"></i> <?php echo uilang("Add more options") ?></div>
            <div id="moform" style="display: none;" class="subform">
                <label><?php echo uilang("Add new option title:") ?></label>
                <input type="text" id="newoptiontitle" placeholder="<?php echo uilang("Option Title") ?>">
                <div class="buybutton" onclick="addnewoptiontitle()"><i class="fa fa-check"></i> <?php echo uilang("Add") ?></div>
                <div class="buybutton" onclick="closemoform()"><i class="fa fa-times"></i> <?php echo uilang("Close") ?></div>
            </div>
            <div id="moformedit" style="display: none;" class="subform">
                <h3><i class="fa fa-edit"></i> <span id="motitletoedit"></span></h3>
                <div id="currentmochilds"></div>
                <label><?php echo uilang("Add new item for this option") ?></label>
                <input type="text" id="moitem" placeholder="<?php echo uilang("Option") ?>">
                <input type="number" step="any" id="moprice" placeholder="<?php echo uilang("Product price when this option is selected") ?>" value="0">
                <div class="buybutton" onclick="addcurrentmoitem()"><i class="fa fa-plus"></i> <?php echo uilang("Add") ?></div>
                <div class="buybutton" onclick="closemoeditform()"><i class="fa fa-times"></i> <?php echo uilang("Close") ?></div>
            </div>
        </div>

        <div class="form-group">
            <label><i class="fa fa-file-text-o"></i> <?php echo uilang("Content") ?></label>
            <textarea name="newpostcontent" placeholder="<?php echo uilang("Content") ?>"></textarea>
        </div>

        <div class="form-actions">
            <input class="submitbutton" type="submit" value="<?php echo uilang("Submit") ?>">
        </div>
    </div>
</form>
