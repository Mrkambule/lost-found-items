
<?php include 'includes/header.php'; ?>
<h2>Search Items</h2>
<form class="row g-2 mt-2" method="get">
  <div class="col-md-4">
    <input type="text" name="q" class="form-control" placeholder="Name or description..." value="<?php echo h($_GET['q'] ?? ''); ?>">
  </div>
  <div class="col-md-3">
    <select name="category" class="form-select">
      <option value="">All Categories</option>
      <?php foreach (categories() as $c): ?>
        <option value="<?php echo h($c); ?>" <?php if (($_GET['category'] ?? '') === $c) echo 'selected'; ?>><?php echo h($c); ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-3">
    <select name="type" class="form-select">
      <option value="">Lost or Found</option>
      <option value="lost" <?php if (($_GET['type'] ?? '')==='lost') echo 'selected'; ?>>Lost</option>
      <option value="found" <?php if (($_GET['type'] ?? '')==='found') echo 'selected'; ?>>Found</option>
    </select>
  </div>
  <div class="col-md-2">
    <button class="btn btn-primary w-100">Search</button>
  </div>
</form>
<?php
$where = [];
$params = [];
$q = trim($_GET['q'] ?? '');
$category = trim($_GET['category'] ?? '');
$type = trim($_GET['type'] ?? '');
if ($q !== '') { $where[] = "(name LIKE ? OR description LIKE ?)"; $params[] = "%$q%"; $params[] = "%$q%"; }
if ($category !== '') { $where[] = "category = ?"; $params[] = $category; }
if ($type !== '' && in_array($type, ['lost','found'], true)) { $where[] = "type = ?"; $params[] = $type; }
$sql = "SELECT * FROM items";
if ($where) { $sql .= " WHERE " . implode(" AND ", $where); }
$sql .= " ORDER BY date_reported DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$items = $stmt->fetchAll();
?>
<div class="row g-3 mt-2">
  <?php if (!$items): ?>
    <div class="col-12"><div class="alert alert-warning">No items matched your search.</div></div>
  <?php endif; ?>
  <?php foreach ($items as $it): ?>
    <div class="col-md-4">
      <div class="card h-100">
        <?php if (!empty($it['photo_path'])): ?>
          <img src="<?php echo h($it['photo_path']); ?>" class="card-img-top" alt="Item photo">
        <?php endif; ?>
        <div class="card-body">
          <h5 class="card-title"><?php echo h($it['name']); ?></h5>
          <p class="card-text small mb-1"><strong>Category:</strong> <?php echo h($it['category']); ?></p>
          <p class="card-text small"><strong>Location:</strong> <?php echo h($it['location']); ?></p>
          <a href="item.php?id=<?php echo (int)$it['id']; ?>" class="btn btn-sm btn-outline-primary">View</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php include 'includes/footer.php'; ?>
