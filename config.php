<?php
/*
Developed by Habibie
Email: habibieamrullah@gmail.com 
WhatsApp: 6287880334339
Website: https://webappdev.my.id
*/

require_once("dbcon.php");

// === Admin Panel Credentials ===
// Disarankan pindahkan ke .env.php dan jangan upload ke repo publik
define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD_HASH", password_hash("admin", PASSWORD_DEFAULT)); // hashed password

// === Koneksi Database ===
$connection = mysqli_connect($host, $dbuser, $dbpassword, $databasename);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
$connection->set_charset("utf8");

// === Nama Tabel ===
$tableconfig = $tableprefix . "config";
$tableposts = $tableprefix . "posts";
$tablecategories = $tableprefix . "categories";
$tablemessages = $tableprefix . "messages";

// === Fungsi Buat Tabel ===
function createTable($connection, $query) {
    if (!mysqli_query($connection, $query)) {
        error_log("Table creation failed: " . mysqli_error($connection));
        die("Table creation error.");
    }
}

// === Buat Tabel ===
createTable($connection, "CREATE TABLE IF NOT EXISTS $tableconfig (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    config VARCHAR(150) NOT NULL,
    value TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)");

createTable($connection, "CREATE TABLE IF NOT EXISTS $tableposts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    postid VARCHAR(70) NOT NULL,
    catid INT NOT NULL,
    normalprice FLOAT NOT NULL,
    discountprice FLOAT NOT NULL,
    title VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    time DATETIME NOT NULL,
    options VARCHAR(200) NOT NULL,
    picture VARCHAR(300) NOT NULL,
    moreimages TEXT NOT NULL,
    content TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    INDEX (postid),
    INDEX (catid)
)");

createTable($connection, "CREATE TABLE IF NOT EXISTS $tablecategories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)");

createTable($connection, "CREATE TABLE IF NOT EXISTS $tablemessages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date DATETIME NOT NULL,
    message TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)");

// === Default Config Website ===
$cfg = new \stdClass();
$cfg->websitetitle = "Toko Online WA";
$cfg->maincolor = "#f28433";
$cfg->secondcolor = "#ffb98a";
$cfg->about = "<p>Toko online simpel sederhana berbasis WhatsApp.</p>";
$cfg->language = "id";
$cfg->logo = "";
$cfg->adminwhatsapp = "6287880334339";
$cfg->currencysymbol = "$";
$cfg->enablerecentpostsliders = true;
$cfg->enablefacebookcomment = true;
$cfg->enablepublishdate = true;
$cfg->sharebuttonsoption = array();
$cfg->thumbnailmode = 0;
$cfg->disabledecimals = 0;

// === Base URL ===
$baseurl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
         . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$cfg->baseurl = str_replace("index.php", "", $baseurl);

// === Konversi ke JSON (safe) ===
$JSONcfg = json_encode($cfg, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

// === Load atau Simpan Konfigurasi ===
$sql = "SELECT * FROM $tableconfig WHERE config = 'cfg'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) == 0) {
    // Insert default config menggunakan prepared statement
    $stmt = $connection->prepare("INSERT INTO $tableconfig (config, value) VALUES (?, ?)");
    $configName = 'cfg';
    $stmt->bind_param("ss", $configName, $JSONcfg);
    $stmt->execute();
    $stmt->close();
} else {
    // Load konfigurasi
    $row = mysqli_fetch_assoc($result);
    $cfg = json_decode($row["value"]);
}

// === Mapping ke Variabel (kalau dibutuhkan) ===
$websitetitle = stripslashes($cfg->websitetitle ?? "");
$maincolor = $cfg->maincolor ?? "#f28433";
$secondcolor = $cfg->secondcolor ?? "#ffb98a";
$about = stripslashes($cfg->about ?? "");
$language = $cfg->language ?? "id";
$logo = $cfg->logo ?? "";
$adminwhatsapp = $cfg->adminwhatsapp ?? "";
$currencysymbol = str_replace("u20b9", "₹", $cfg->currencysymbol ?? "$");
$baseurl = $cfg->baseurl ?? "";
$enablerecentpostsliders = $cfg->enablerecentpostsliders ?? true;
$sharebuttonsoption = $cfg->sharebuttonsoption ?? array();
$enablefacebookcomment = $cfg->enablefacebookcomment ?? true;
$enablepublishdate = $cfg->enablepublishdate ?? true;
$thumbnailmode = $cfg->thumbnailmode ?? 0;
$disabledecimals = $cfg->disabledecimals ?? 0;

// === Buat Folder 'pictures' jika belum ada ===
if (!file_exists("pictures")) {
    mkdir("pictures", 0755, true);
}
?>
