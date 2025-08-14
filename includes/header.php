
<?php require_once __DIR__ . '/../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Campus Lost & Found</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Lost & Found</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="report_lost.php">Report Lost</a></li>
        <li class="nav-item"><a class="nav-link" href="report_found.php">Report Found</a></li>
        <li class="nav-item"><a class="nav-link" href="view_lost.php">View Lost</a></li>
        <li class="nav-item"><a class="nav-link" href="view_found.php">View Found</a></li>
        <li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
      </ul>
      <ul class="navbar-nav">
        <?php if (!empty($_SESSION['admin'])): ?>
          <li class="nav-item"><a class="nav-link" href="admin/dashboard.php">Admin</a></li>
          <li class="nav-item"><a class="nav-link" href="admin/logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="admin/login.php">Admin Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<main class="container my-4">
