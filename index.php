
<?php include 'includes/header.php'; ?>
<div class="p-5 mb-4 bg-light rounded-3">
  <div class="container py-5">
    <h1 class="display-6">Welcome to the Campus Lost & Found</h1>
    <p class="lead">Report lost or found items, browse the listings, and help reunite items with their owners.</p>
    <a class="btn btn-primary btn-lg me-2" href="report_lost.php">Report Lost Item</a>
    <a class="btn btn-success btn-lg me-2" href="report_found.php">Report Found Item</a>
    <a class="btn btn-outline-secondary btn-lg" href="search.php">Search Items</a>
  </div>
</div>

<div class="row g-3">
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">Recently Lost</h5>
        <p class="card-text">See the latest reported lost items.</p>
        <a href="view_lost.php" class="btn btn-sm btn-primary">View Lost</a>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">Recently Found</h5>
        <p class="card-text">See items that have been found on campus.</p>
        <a href="view_found.php" class="btn btn-sm btn-success">View Found</a>
      </div>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
