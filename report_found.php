
<?php include 'includes/header.php'; ?>
<h2>Report Found Item</h2>
<form action="actions/save_item.php" method="post" enctype="multipart/form-data" class="mt-3">
  <input type="hidden" name="type" value="found">

<div class="mb-3">
  <label class="form-label">Item Name</label>
  <input type="text" name="name" class="form-control" required>
</div>
<div class="mb-3">
  <label class="form-label">Category</label>
  <select name="category" class="form-select" required>
    <?php foreach (categories() as $c): ?>
      <option value="<?php echo h($c); ?>"><?php echo h($c); ?></option>
    <?php endforeach; ?>
  </select>
</div>
<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" class="form-control" rows="4" placeholder="Color, brand, unique marks..."></textarea>
</div>
<div class="mb-3">
  <label class="form-label">Location (where it was found)</label>
  <input type="text" name="location" class="form-control" placeholder="Building, room, area">
</div>
<div class="mb-3">
  <label class="form-label">Date Found</label>
  <input type="date" name="date_when" class="form-control" required>
</div>
<div class="mb-3">
  <label class="form-label">Photo (optional, JPG/PNG, max 3MB)</label>
  <input type="file" name="photo" accept=".jpg,.jpeg,.png" class="form-control">
</div>
<div class="mb-3">
  <label class="form-label">Your Name</label>
  <input type="text" name="reporter_name" class="form-control" required>
</div>
<div class="mb-3">
  <label class="form-label">Your Email</label>
  <input type="email" name="reporter_email" class="form-control" required>
</div>

  <button class="btn btn-success" type="submit">Submit Found Report</button>
</form>
<?php include 'includes/footer.php'; ?>
