<?php
session_start();

// Temporary sample data (replace this with DB query later)
$accounts = [
    ["id"=>1, "name"=>"Checking Account", "type"=>"Bank", "balance"=>2000],
    ["id"=>2, "name"=>"Savings Account", "type"=>"Bank", "balance"=>5000],
    ["id"=>3, "name"=>"Cash Wallet", "type"=>"Cash", "balance"=>150],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accounts - Finance Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

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

    .header h2 {
      font-weight: 600;
      color: #2d3436;
    }

    .btn-add {
      background: linear-gradient(90deg, #00b894, #019fef);
      border: none;
      color: white;
      font-weight: 500;
      border-radius: 12px;
      padding: 10px 25px;
      transition: all 0.3s ease;
    }

    .btn-add:hover {
      transform: translateY(-2px);
      background: linear-gradient(90deg, #01a17d, #1280df);
    }

    /* Table Styling */
    table {
      width: 100%;
      background: rgba(255,255,255,0.5);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    th {
      background: #2575fc;
      color: #fff;
      padding: 15px;
      font-weight: 600;
    }

    td {
      padding: 14px;
      color: #333;
      font-weight: 500;
    }

    tr:nth-child(even) {
      background-color: rgba(255,255,255,0.4);
    }

    tr:hover {
      background-color: rgba(37,117,252,0.1);
    }

    .action-btn {
      border: none;
      padding: 6px 14px;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      color: #fff;
      transition: 0.3s;
    }

    .btn-edit {
      background-color: #00b894;
    }
    .btn-edit:hover {
      background-color: #019f7f;
    }
    .btn-delete {
      background-color: #ff4757;
    }
    .btn-delete:hover {
      background-color: #e84118;
    }

    /* Modal Styling */
    .modal-content {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      border: none;
    }

    .modal-header {
      background: linear-gradient(90deg, #2575fc, #6a11cb);
      color: white;
      border-bottom: none;
    }

    .modal-footer {
      border-top: none;
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 25px;
      }
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
        border-radius: 0;
        box-shadow: none;
      }
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
      <li><a href="accounts.php" class="active">Accounts</a></li>
      <li><a href="transactions.php">Transactions</a></li>
      <li><a href="reports.php">Reports</a></li>
      <li><a href="sync.php">Backup</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="header">
      <h2>Manage Accounts</h2>
      <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addAccountModal">➕ Add New Account</button>
    </div>

    <table class="table table-borderless align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Account Name</th>
          <th>Type</th>
          <th>Balance</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($accounts as $acc): ?>
          <tr>
            <td><?= $acc['id']; ?></td>
            <td><?= htmlspecialchars($acc['name']); ?></td>
            <td><?= $acc['type']; ?></td>
            <td>$<?= number_format($acc['balance'], 2); ?></td>
            <td>
              <button class="action-btn btn-edit" data-bs-toggle="modal" data-bs-target="#editAccountModal"
                onclick="editAccount(<?= $acc['id']; ?>, '<?= $acc['name']; ?>', '<?= $acc['type']; ?>', <?= $acc['balance']; ?>)">
                Edit
              </button>
              <button class="action-btn btn-delete" onclick="deleteAccount(<?= $acc['id']; ?>)">Delete</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Add Account Modal -->
  <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="addAccountLabel">Add New Account</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="addAccountForm">
            <div class="mb-3">
              <label class="form-label">Account Name</label>
              <input type="text" class="form-control" id="accountName" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Type</label>
              <select id="accountType" class="form-select" required>
                <option value="Bank">Bank</option>
                <option value="Cash">Cash</option>
                <option value="Card">Card</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Initial Balance ($)</label>
              <input type="number" class="form-control" id="accountBalance" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Account</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Account Modal -->
  <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="editAccountLabel">Edit Account</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="editAccountForm">
            <input type="hidden" id="editAccountId">
            <div class="mb-3">
              <label class="form-label">Account Name</label>
              <input type="text" class="form-control" id="editAccountName" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Type</label>
              <select id="editAccountType" class="form-select" required>
                <option value="Bank">Bank</option>
                <option value="Cash">Cash</option>
                <option value="Card">Card</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Balance ($)</label>
              <input type="number" class="form-control" id="editAccountBalance" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function editAccount(id, name, type, balance) {
      document.getElementById('editAccountId').value = id;
      document.getElementById('editAccountName').value = name;
      document.getElementById('editAccountType').value = type;
      document.getElementById('editAccountBalance').value = balance;
    }

    function deleteAccount(id) {
      if (confirm('Are you sure you want to delete account ID ' + id + '?')) {
        alert('Account deleted (simulation)');
      }
    }

    document.getElementById('addAccountForm').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('New account added (simulation)');
    });

    document.getElementById('editAccountForm').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Account details updated (simulation)');
    });
  </script>
</body>
</html>
