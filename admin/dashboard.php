
<?php require_once __DIR__ . '/../config.php'; ?>
<?php
if (empty($_SESSION['admin'])) { header('Location: login.php'); exit; }
$filter = $_GET['type'] ?? '';
$where = '';
$params = [];
if (in_array($filter, ['lost','found'], true)) { $where = 'WHERE type = ?'; $params[] = $filter; }
$stmt = $pdo->prepare("SELECT * FROM items $where ORDER BY date_reported DESC");
$stmt->execute($params);
$items = $stmt->fetchAll();
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
<h3>Admin Dashboard</h3>
<div class="d-flex gap-2 my-3">
  <a href="?">All</a> | <a href="?type=lost">Lost</a> | <a href="?type=found">Found</a>
</div>
<div class="table-responsive">
<table class="table table-striped align-middle">
  <thead><tr>
    <th>ID</th><th>Type</th><th>Name</th><th>Category</th><th>Status</th><th>Date</th><th>Actions</th>
  </tr></thead>
  <tbody>
    <?php foreach ($items as $it): ?>
      <tr>
        <td><?php echo (int)$it['id']; ?></td>
        <td><?php echo h($it['type']); ?></td>
        <td><?php echo h($it['name']); ?></td>
        <td><?php echo h($it['category']); ?></td>
        <td><?php echo h($it['status']); ?></td>
        <td><?php echo h($it['date_when']); ?></td>
        <td class="d-flex gap-2">
          <form method="post" action="update_status.php" class="d-flex gap-2">
            <input type="hidden" name="id" value="<?php echo (int)$it['id']; ?>">
            <select name="status" class="form-select form-select-sm w-auto">
              <?php foreach (['open','claimed','returned'] as $s): ?>
                <option value="<?php echo $s; ?>" <?php if ($it['status']===$s) echo 'selected'; ?>><?php echo ucfirst($s); ?></option>
              <?php endforeach; ?>
            </select>
            <button class="btn btn-sm btn-secondary">Save</button>
          </form>
          <form method="post" action="delete_item.php" onsubmit="return confirm('Delete this item?');">
            <input type="hidden" name="id" value="<?php echo (int)$it['id']; ?>">
            <button class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
