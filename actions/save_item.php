
<?php
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Method not allowed'); }

$type = $_POST['type'] ?? '';
if (!in_array($type, ['lost','found'], true)) { exit('Invalid type'); }

$name = trim($_POST['name'] ?? '');
$category = trim($_POST['category'] ?? '');
$description = trim($_POST['description'] ?? '');
$location = trim($_POST['location'] ?? '');
$date_when = $_POST['date_when'] ?? null;
$reporter_name = trim($_POST['reporter_name'] ?? '');
$reporter_email = trim($_POST['reporter_email'] ?? '');

if ($name === '' || $category === '' || !$date_when || $reporter_name === '' || $reporter_email === '') {
    exit('Please fill all required fields.');
}

// Handle photo upload
$photo_path = null;
if (!empty($_FILES['photo']['name'])) {
    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
    if (!isset($allowed[$_FILES['photo']['type']])) {
        exit('Only JPG/PNG allowed.');
    }
    if ($_FILES['photo']['size'] > 3 * 1024 * 1024) {
        exit('Max file size is 3MB.');
    }
    $ext = $allowed[$_FILES['photo']['type']];
    $fname = 'item_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $target = __DIR__ . '/../uploads/' . $fname;
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
        exit('Failed to upload photo.');
    }
    $photo_path = 'uploads/' . $fname;
}

// Insert into DB
$stmt = $pdo->prepare("INSERT INTO items (type, name, category, description, location, date_when, photo_path, reporter_name, reporter_email) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->execute([$type, $name, $category, $description, $location, $date_when, $photo_path, $reporter_name, $reporter_email]);

header('Location: ../' . ($type === 'lost' ? 'view_lost.php' : 'view_found.php'));
exit;
