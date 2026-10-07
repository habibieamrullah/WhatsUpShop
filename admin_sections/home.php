<?php
/*
Admin Dashboard - Home Section
Displays an overview of store statistics and quick actions.
*/
if (!isset($connection)) {
    exit;
}

// Gather statistics
$totalPosts = 0;
$totalCategories = 0;
$totalOrders = 0;

$res = mysqli_query($connection, "SELECT COUNT(*) AS c FROM $tableposts");
if ($res) { $totalPosts = (int) mysqli_fetch_assoc($res)["c"]; }

$res = mysqli_query($connection, "SELECT COUNT(*) AS c FROM $tablecategories");
if ($res) { $totalCategories = (int) mysqli_fetch_assoc($res)["c"]; }

$res = mysqli_query($connection, "SELECT COUNT(*) AS c FROM $tablemessages");
if ($res) { $totalOrders = (int) mysqli_fetch_assoc($res)["c"]; }

// Recent products
$recentPosts = array();
$res = mysqli_query($connection, "SELECT * FROM $tableposts ORDER BY id DESC LIMIT 5");
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        $recentPosts[] = $r;
    }
}
?>

<div class="admin-page-header">
    <h1><i class="fa fa-dashboard"></i> <?php echo uilang("Home") ?></h1>
    <p class="admin-page-subtitle"><?php echo htmlspecialchars($websitetitle) ?> &mdash; <?php echo uilang("Dashboard") ?></p>
</div>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: <?php echo $maincolor ?>;"><i class="fa fa-cube"></i></div>
        <div class="stat-body">
            <div class="stat-value"><?php echo $totalPosts ?></div>
            <div class="stat-label"><?php echo uilang("Published Posts") ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: <?php echo $secondcolor ?>;"><i class="fa fa-tags"></i></div>
        <div class="stat-body">
            <div class="stat-value"><?php echo $totalCategories ?></div>
            <div class="stat-label"><?php echo uilang("Categories") ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #4caf50;"><i class="fa fa-shopping-bag"></i></div>
        <div class="stat-body">
            <div class="stat-value"><?php echo $totalOrders ?></div>
            <div class="stat-label"><?php echo uilang("Orders") ?></div>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fa fa-bolt"></i> <?php echo uilang("Quick Actions") ?></h2>
    </div>
    <div class="admin-card-body">
        <div class="quick-actions">
            <a class="quick-action" href="<?php echo $baseurl ?>admin.php?newpost">
                <i class="fa fa-plus-circle"></i>
                <span><?php echo uilang("Add Product") ?></span>
            </a>
            <a class="quick-action" href="<?php echo $baseurl ?>admin.php?categories">
                <i class="fa fa-tag"></i>
                <span><?php echo uilang("Categories") ?></span>
            </a>
            <a class="quick-action" href="<?php echo $baseurl ?>admin.php?orders">
                <i class="fa fa-file-text"></i>
                <span><?php echo uilang("Orders") ?></span>
            </a>
            <a class="quick-action" href="<?php echo $baseurl ?>admin.php?settings">
                <i class="fa fa-cogs"></i>
                <span><?php echo uilang("Settings") ?></span>
            </a>
            <a class="quick-action" target="_blank" href="<?php echo $baseurl ?>">
                <i class="fa fa-external-link"></i>
                <span><?php echo uilang("View Shop") ?></span>
            </a>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fa fa-clock-o"></i> <?php echo uilang("Recently Published") ?></h2>
    </div>
    <div class="admin-card-body">
        <?php if (count($recentPosts) == 0): ?>
            <div class="empty-state">
                <i class="fa fa-inbox"></i>
                <p><?php echo uilang("There is no post published") ?>.</p>
                <a class="buybutton" href="<?php echo $baseurl ?>admin.php?newpost"><i class="fa fa-plus"></i> <?php echo uilang("Add Product") ?></a>
            </div>
        <?php else: ?>
            <div class="recent-list">
                <?php foreach ($recentPosts as $rp):
                    $img = $rp["picture"] != "" ? "pictures/" . $rp["picture"] : "images/defaultimg.jpg";
                ?>
                    <a class="recent-item" href="<?php echo $baseurl ?>admin.php?editpost=<?php echo $rp["id"] ?>">
                        <div class="recent-thumb" style="background-image: url('<?php echo $baseurl . $img ?>');"></div>
                        <div class="recent-info">
                            <div class="recent-title"><?php echo htmlspecialchars($rp["title"]) ?></div>
                            <div class="recent-meta">
                                <i class="fa fa-tag"></i> <?php echo htmlspecialchars(showCatName($rp["catid"])) ?>
                                &nbsp;&middot;&nbsp;
                                <i class="fa fa-money"></i> <?php echo $currencysymbol . number_format($rp["normalprice"], 2) ?>
                            </div>
                        </div>
                        <div class="recent-edit"><i class="fa fa-pencil"></i></div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
