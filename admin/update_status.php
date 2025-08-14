
<?php
require_once __DIR__ . '/../config.php';
if (empty($_SESSION['admin'])) { header('Location: login.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)($_POST['id'] ?? 0);
  $status = $_POST['status'] ?? 'open';
  if (!in_array($status, ['open','claimed','returned'], true)) { $status = 'open'; }
  $stmt = $pdo->prepare("UPDATE items SET status = ? WHERE id = ?");
  $stmt->execute([$status, $id]);
}
header('Location: ../item.php?id=' . (int)($_POST['id'] ?? 0));
exit;
