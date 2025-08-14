
<?php include 'includes/header.php'; ?>
<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();
if (!$item) {
  echo '<div class="alert alert-danger">Item not found.</div>';
  include 'includes/footer.php'; exit;
}
?>
<div class="row">
  <div class="col-md-6">
    <?php if (!empty($item['photo_path'])): ?>
      <img src="<?php echo h($item['photo_path']); ?>" class="img-fluid rounded border" alt="Item photo">
    <?php else: ?>
      <div class="border rounded p-5 text-center text-muted">No photo</div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <h3><?php echo h($item['name']); ?></h3>
    <p><strong>Type:</strong> <?php echo h(ucfirst($item['type'])); ?></p>
    <p><strong>Category:</strong> <?php echo h($item['category']); ?></p>
    <p><strong>Location:</strong> <?php echo h($item['location']); ?></p>
    <p><strong>Date:</strong> <?php echo h($item['date_when']); ?></p>
    <p><strong>Status:</strong> <?php echo h($item['status']); ?></p>
    <p><strong>Description:</strong><br><?php echo nl2br(h($item['description'])); ?></p>
    <hr>
    <h5>Contact</h5>
    <p><?php echo h($item['reporter_name']); ?> — <a href="mailto:<?php echo h($item['reporter_email']); ?>"><?php echo h($item['reporter_email']); ?></a></p>
    <?php if (!empty($_SESSION['admin'])): ?>
      <form method="post" action="admin/update_status.php" class="d-flex gap-2 mt-3">
        <input type="hidden" name="id" value="<?php echo (int)$item['id']; ?>">
        <select name="status" class="form-select w-auto">
          <?php foreach (['open','claimed','returned'] as $s): ?>
            <option value="<?php echo $s; ?>" <?php if ($item['status']===$s) echo 'selected'; ?>><?php echo ucfirst($s); ?></option>
          <?php endforeach; ?>
        </select>
        <button class="btn btn-secondary">Update</button>
      </form>
    <?php endif; ?>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
