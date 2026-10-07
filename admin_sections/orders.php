<?php
/*
Admin - Orders Section
View order messages submitted through the WhatsApp checkout.
*/
if (!isset($connection)) {
    exit;
}

// Delete a single order
if (isset($_GET["deleteorder"])) {
    $doid = (int) $_GET["deleteorder"];
    mysqli_query($connection, "DELETE FROM $tablemessages WHERE id = $doid");
    echo "<div class='alert'>" . uilang("has been deleted") . "</div>";
}

// Clear all orders
if (isset($_GET["clearorders"])) {
    mysqli_query($connection, "DELETE FROM $tablemessages");
    echo "<div class='alert'>" . uilang("has been deleted") . "</div>";
}

$orders = array();
$res = mysqli_query($connection, "SELECT * FROM $tablemessages ORDER BY id DESC");
if ($res) {
    while ($o = mysqli_fetch_assoc($res)) {
        $orders[] = $o;
    }
}
?>

<div class="admin-page-header">
    <h1><i class="fa fa-file-text"></i> <?php echo uilang("Orders") ?></h1>
    <p class="admin-page-subtitle"><?php echo count($orders) ?> <?php echo uilang("Orders") ?></p>
</div>

<?php if (count($orders) == 0): ?>
    <div class="admin-card">
        <div class="admin-card-body">
            <div class="empty-state">
                <i class="fa fa-inbox"></i>
                <p><?php echo uilang("There is no order recorded.") ?></p>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="admin-card">
        <div class="admin-card-header">
            <h2><i class="fa fa-list"></i> <?php echo uilang("Order Items") ?></h2>
            <a class="icon-btn danger" href="<?php echo $baseurl ?>admin.php?orders&clearorders=1" onclick="return confirm('<?php echo uilang("Delete") ?>?');"><i class="fa fa-trash"></i> <?php echo uilang("Delete") ?></a>
        </div>
        <div class="admin-card-body">
            <div class="order-list">
                <?php foreach ($orders as $o):
                    $ts = $o["date"];
                    if (is_numeric($ts) && $ts > 100000000000) {
                        $ts = $ts / 1000;
                    }
                    $dateStr = is_numeric($ts) ? date("d-m-Y H:i", (int) $ts) : $o["date"];
                ?>
                    <div class="order-item">
                        <div class="order-head">
                            <span class="order-date"><i class="fa fa-calendar"></i> <?php echo $dateStr ?></span>
                            <a class="icon-btn danger" href="<?php echo $baseurl ?>admin.php?orders&deleteorder=<?php echo $o["id"] ?>" onclick="return confirm('<?php echo uilang("Delete") ?>?');"><i class="fa fa-trash"></i></a>
                        </div>
                        <pre class="order-message"><?php echo htmlspecialchars($o["message"]) ?></pre>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
