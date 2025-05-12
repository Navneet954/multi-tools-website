<?php
// Initialize session to store expenses
session_start();
if (!isset($_SESSION['expenses'])) {
    $_SESSION['expenses'] = [];
}

// Handle new expense addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_expense'])) {
    $title = htmlspecialchars($_POST['title']);
    $amount = floatval($_POST['amount']);
    $date = $_POST['date'];

    $_SESSION['expenses'][] = [
        'title' => $title,
        'amount' => $amount,
        'date' => $date,
    ];
}

// Handle clearing all expenses
if (isset($_POST['clear_expenses'])) {
    $_SESSION['expenses'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Expense Tracker</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a2e0e6adcf.js" crossorigin="anonymous"></script>
  <style>
    body {
      background: #f8f9fa;
    }
    .ad-space {
      background: #e9ecef;
      border: 2px dashed #ced4da;
      padding: 20px;
      text-align: center;
      margin-bottom: 20px;
      color: #6c757d;
    }
    .expense-card {
      transition: 0.3s;
    }
    .expense-card:hover {
      transform: scale(1.02);
    }
  </style>
</head>
<body>

<div class="container py-4">
  
  <!-- Top Ad Space -->
  <div class="ad-space mb-4">
    <strong>Top Ad Space (728x90)</strong>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <div class="card mb-4 shadow">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Expense Tracker</h4>
        </div>
        <div class="card-body">
          <form method="POST" class="row g-3">
            <div class="col-md-5">
              <input type="text" name="title" class="form-control" placeholder="Expense Title" required>
            </div>
            <div class="col-md-3">
              <input type="number" name="amount" step="0.01" class="form-control" placeholder="Amount" required>
            </div>
            <div class="col-md-3">
              <input type="date" name="date" class="form-control" required>
            </div>
            <div class="col-md-1 d-grid">
              <button type="submit" name="add_expense" class="btn btn-success"><i class="fas fa-plus"></i></button>
            </div>
          </form>
        </div>
      </div>

      <!-- Expense List -->
      <div class="card shadow expense-card">
        <div class="card-header bg-dark text-white">
          <h5 class="mb-0">Expense List</h5>
        </div>
        <div class="card-body">
          <?php if (!empty($_SESSION['expenses'])): ?>
            <ul class="list-group mb-3">
              <?php 
              $total = 0;
              foreach ($_SESSION['expenses'] as $expense): 
                  $total += $expense['amount'];
              ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div>
                    <strong><?php echo $expense['title']; ?></strong><br>
                    <small class="text-muted"><?php echo $expense['date']; ?></small>
                  </div>
                  <span class="badge bg-primary rounded-pill">₹<?php echo number_format($expense['amount'], 2); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
            <div class="d-flex justify-content-between align-items-center">
              <h5>Total</h5>
              <h5 class="text-success">₹<?php echo number_format($total, 2); ?></h5>
            </div>
            <form method="POST" class="mt-3">
              <button type="submit" name="clear_expenses" class="btn btn-danger btn-sm">Clear All Expenses</button>
            </form>
          <?php else: ?>
            <p class="text-muted">No expenses added yet.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Right Sidebar Ad -->
    <div class="col-lg-4">
      <div class="ad-space">
        <strong>Sidebar Ad Space (300x250)</strong>
      </div>
    </div>
  </div>

  <!-- Bottom Ad Space -->
  <div class="ad-space mt-4">
    <strong>Bottom Ad Space (728x90)</strong>
  </div>

</div>

</body>
</html>
