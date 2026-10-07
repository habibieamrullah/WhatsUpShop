<?php
/*
Admin - Categories Section
Add, rename and delete product categories.
*/
if (!isset($connection)) {
    exit;
}

// Add category
if (isset($_POST["newcategory"]) && trim($_POST["newcategory"]) != "") {
    $newcat = mysqli_real_escape_string($connection, trim($_POST["newcategory"]));
    mysqli_query($connection, "INSERT INTO $tablecategories (category) VALUES ('$newcat')");
    echo "<div class='alert'>" . uilang("New category has been added") . "</div>";
}

// Rename category
if (isset($_POST["editcategoryid"]) && isset($_POST["editcategoryname"]) && trim($_POST["editcategoryname"]) != "") {
    $ecid = (int) $_POST["editcategoryid"];
    $ecname = mysqli_real_escape_string($connection, trim($_POST["editcategoryname"]));
    mysqli_query($connection, "UPDATE $tablecategories SET category = '$ecname' WHERE id = $ecid");
    echo "<div class='alert'>" . uilang("Category updated") . "</div>";
}

// Delete category
if (isset($_GET["deletecat"])) {
    $dcid = (int) $_GET["deletecat"];
    mysqli_query($connection, "DELETE FROM $tablecategories WHERE id = $dcid");
    echo "<div class='alert'>" . uilang("One category removed") . "</div>";
}

$cats = array();
$res = mysqli_query($connection, "SELECT * FROM $tablecategories ORDER BY category ASC");
if ($res) {
    while ($c = mysqli_fetch_assoc($res)) {
        $cats[] = $c;
    }
}
?>

<div class="admin-page-header">
    <h1><i class="fa fa-tags"></i> <?php echo uilang("Categories") ?></h1>
    <p class="admin-page-subtitle"><?php echo count($cats) ?> <?php echo uilang("Categories") ?></p>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fa fa-plus"></i> <?php echo uilang("New category") ?></h2>
    </div>
    <div class="admin-card-body">
        <form action="<?php echo $baseurl ?>admin.php?categories" method="post" class="inline-form">
            <input type="text" name="newcategory" placeholder="<?php echo uilang("New category") ?>" required>
            <input class="submitbutton" type="submit" value="<?php echo uilang("Add") ?>">
        </form>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fa fa-list"></i> <?php echo uilang("Categories") ?></h2>
    </div>
    <div class="admin-card-body">
        <?php if (count($cats) == 0): ?>
            <div class="empty-state">
                <i class="fa fa-tag"></i>
                <p><?php echo uilang("No category has been added") ?></p>
            </div>
        <?php else: ?>
            <div class="category-list">
                <?php foreach ($cats as $c): ?>
                    <div class="category-row">
                        <form action="<?php echo $baseurl ?>admin.php?categories" method="post" class="category-edit-form">
                            <input type="hidden" name="editcategoryid" value="<?php echo $c["id"] ?>">
                            <input type="text" name="editcategoryname" value="<?php echo htmlspecialchars($c["category"]) ?>">
                            <button class="icon-btn" type="submit" title="<?php echo uilang("Update") ?>"><i class="fa fa-check"></i></button>
                        </form>
                        <a class="icon-btn danger" href="<?php echo $baseurl ?>admin.php?categories&deletecat=<?php echo $c["id"] ?>" onclick="return confirm('<?php echo uilang("Delete") ?>?');" title="<?php echo uilang("Delete") ?>"><i class="fa fa-trash"></i></a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
