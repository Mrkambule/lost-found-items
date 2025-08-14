
<?php
require_once __DIR__ . '/../config.php';
if (empty($_SESSION['admin'])) { header('Location: login.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)($_POST['id'] ?? 0);
  // delete image file if exists
  $stmt = $pdo->prepare("SELECT photo_path FROM items WHERE id = ?");
  $stmt->execute([$id]);
  if ($row = $stmt->fetch()) {
     if (!empty($row['photo_path'])) {
        $path = __DIR__ . '/../' . $row['photo_path'];
        if (is_file($path)) @unlink($path);
     }
  }
  $pdo->prepare("DELETE FROM items WHERE id = ?")->execute([$id]);
}
header('Location: dashboard.php');
exit;
