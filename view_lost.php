
<?php include 'includes/header.php'; ?>
<h2>Lost Items</h2>
<?php
$type = 'lost';
$q = $pdo->prepare("SELECT * FROM items WHERE type = ? ORDER BY date_reported DESC");
$q->execute([$type]);
$items = $q->fetchAll();
?>
<div class="row g-3 mt-2">
  <?php if (!$items): ?>
    <div class="col-12"><div class="alert alert-warning">No items to display.</div></div>
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
