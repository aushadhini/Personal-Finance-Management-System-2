<?php
session_start();

// Example transaction data (replace later with DB query)
if (!isset($_SESSION['transactions'])) {
    $_SESSION['transactions'] = [
        ["id" => 1, "date" => "2025-10-01", "account" => "Checking", "category" => "Salary", "type" => "Income", "amount" => 2000, "notes" => "October Salary"],
        ["id" => 2, "date" => "2025-10-03", "account" => "Credit Card", "category" => "Food", "type" => "Expense", "amount" => 50, "notes" => "Lunch"],
        ["id" => 3, "date" => "2025-10-05", "account" => "Checking", "category" => "Freelance", "type" => "Income", "amount" => 500, "notes" => "Project A"],
        ["id" => 4, "date" => "2025-10-07", "account" => "Cash", "category" => "Transport", "type" => "Expense", "amount" => 20, "notes" => "Bus Fare"],
    ];
}

// Handle new or edited transaction (simulated)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newTx = [
        "id" => $_POST['id'] ? $_POST['id'] : count($_SESSION['transactions']) + 1,
        "date" => $_POST['date'],
        "account" => $_POST['account'],
        "category" => $_POST['category'],
        "type" => $_POST['type'],
        "amount" => $_POST['amount'],
        "notes" => $_POST['notes'],
    ];

    if ($_POST['action'] === 'add') {
        $_SESSION['transactions'][] = $newTx;
    } elseif ($_POST['action'] === 'edit') {
        foreach ($_SESSION['transactions'] as &$tx) {
            if ($tx['id'] == $_POST['id']) { $tx = $newTx; break; }
        }
    } elseif ($_POST['action'] === 'delete') {
        $_SESSION['transactions'] = array_filter($_SESSION['transactions'], fn($t) => $t['id'] != $_POST['id']);
    }

    header("Location: transactions.php");
    exit();
}

$transactions = $_SESSION['transactions'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PFMS</title>
  <link rel="icon" href="logo.jpeg" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    display: flex;
    margin: 0;
    background: linear-gradient(135deg, #eef2f3, #dfe9f3);
}

/* Sidebar */
.sidebar {
    width: 250px;
    background: linear-gradient(180deg, #6a11cb, #2575fc);
    color: white;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 30px;
    position: fixed;
    top: 0;
    left: 0;
    box-shadow: 4px 0 15px rgba(0,0,0,0.15);
    border-radius: 0 20px 20px 0;
}

.logo {
    display: flex;
    align-items: center;
    margin-bottom: 40px;
}

.logo img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    border: 2px solid white;
}

.logo-text {
    font-size: 20px;
    font-weight: 600;
}

.nav-links {
    list-style: none;
    padding: 0;
    width: 100%;
    margin-top: 20px;
}

.nav-links li a {
    display: block;
    padding: 15px 30px;
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    font-weight: 500;
    transition: 0.3s;
    border-left: 4px solid transparent;
}

.nav-links li a:hover,
.nav-links li a.active {
    background: rgba(255,255,255,0.15);
    border-left: 4px solid #fff;
    color: #fff;
    backdrop-filter: blur(5px);
}

/* Main Content */
.main-content {
    margin-left: 270px;
    padding: 40px;
    width: 100%;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.header h2 { font-weight: 600; color: #2d3436; }

.btn-add {
    background-color: #00b894;
    border: none;
    color: white;
    font-weight: 500;
    border-radius: 10px;
    padding: 10px 20px;
    transition: 0.3s;
}

.btn-add:hover { background-color: #019f7f; }

/* Table Styling */
.table-container {
    background: rgba(255,255,255,0.5);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #0984e3;
    color: white;
    border-radius: 10px 10px 0 0;
}

tr:hover { background-color: rgba(0,0,0,0.05); }

.action-btn {
    border: none;
    padding: 5px 12px;
    border-radius: 8px;
    cursor: pointer;
    margin-right: 5px;
    font-size: 14px;
    color: white;
}

.btn-edit { background-color: #00b894; }
.btn-delete { background-color: #d63031; }

.modal-content {
    border-radius: 15px;
    backdrop-filter: blur(10px);
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <img src="logo.jpeg" alt="Logo">
        <span class="logo-text">PFMS</span>
    </div>
    <ul class="nav-links">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="home.php">Home</a></li>
        <li><a href="categories.php">Categories</a></li>
        <li><a href="accounts.php">Accounts</a></li>
        <li><a href="transactions.php" class="active">Transactions</a></li>
        <li><a href="reports.php">Reports</a></li>
        <li><a href="sync.php">Backup</a></li>
        <li><a href="profile.php">Profile</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="header">
        <h2>Transactions</h2>
        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#transactionModal">➕ Add Transaction</button>
    </div>

    <div class="table-container">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Account</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($transactions as $tx): ?>
                <tr>
                    <td><?= $tx['id']; ?></td>
                    <td><?= $tx['date']; ?></td>
                    <td><?= htmlspecialchars($tx['account']); ?></td>
                    <td><?= htmlspecialchars($tx['category']); ?></td>
                    <td><?= $tx['type']; ?></td>
                    <td>$<?= number_format($tx['amount'], 2); ?></td>
                    <td><?= htmlspecialchars($tx['notes']); ?></td>
                    <td>
                        <button class="action-btn btn-edit" onclick='editTransaction(<?= json_encode($tx); ?>)'>Edit</button>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $tx['id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="action-btn btn-delete" onclick="return confirm('Delete this transaction?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="transactionModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Add Transaction</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="tx_id">
          <input type="hidden" name="action" id="tx_action" value="add">

          <label>Date</label>
          <input type="date" class="form-control mb-2" name="date" id="tx_date" required>

          <label>Account</label>
          <input type="text" class="form-control mb-2" name="account" id="tx_account" required>

          <label>Category</label>
          <input type="text" class="form-control mb-2" name="category" id="tx_category" required>

          <label>Type</label>
          <select class="form-control mb-2" name="type" id="tx_type" required>
            <option value="Income">Income</option>
            <option value="Expense">Expense</option>
          </select>

          <label>Amount</label>
          <input type="number" step="0.01" class="form-control mb-2" name="amount" id="tx_amount" required>

          <label>Notes</label>
          <textarea class="form-control mb-2" name="notes" id="tx_notes"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function editTransaction(tx) {
    document.getElementById('modalTitle').innerText = 'Edit Transaction';
    document.getElementById('tx_action').value = 'edit';
    document.getElementById('tx_id').value = tx.id;
    document.getElementById('tx_date').value = tx.date;
    document.getElementById('tx_account').value = tx.account;
    document.getElementById('tx_category').value = tx.category;
    document.getElementById('tx_type').value = tx.type;
    document.getElementById('tx_amount').value = tx.amount;
    document.getElementById('tx_notes').value = tx.notes;
    new bootstrap.Modal(document.getElementById('transactionModal')).show();
}
</script>
</body>
</html>
