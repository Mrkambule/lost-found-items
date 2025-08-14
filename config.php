
<?php
// --- Basic configuration for XAMPP (Apache + MySQL) ---
// Adjust these if your XAMPP/MySQL uses different credentials
$DB_HOST = 'localhost';
$DB_NAME = 'lostfound_db';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

session_start();

// Base URL (adjust if you place project in a subfolder)
$BASE_URL = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
if ($BASE_URL === '') { $BASE_URL = '/'; }

function h($str) { return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8'); }

function categories() {
    return ['ID Card','Phone','Laptop','Book','Water Bottle','USB Drive','Keys','Wallet','Backpack','Other'];
}
?>
