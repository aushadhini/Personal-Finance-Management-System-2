<?php
session_start();

$userName = $_SESSION["user_name"] ?? "User";

// Example balance and summary data (replace with DB queries)
$balance = 5300;
$totalIncome = 8000;
$totalExpenses = 2700;
$netBalance = $totalIncome - $totalExpenses;

// Example recent transactions
$transactions = [
    ["id"=>1, "date"=>"2025-10-01", "account"=>"Checking", "category"=>"Salary", "type"=>"Income", "amount"=>2000, "notes"=>"October Salary"],
    ["id"=>2, "date"=>"2025-10-03", "account"=>"Credit Card", "category"=>"Food", "type"=>"Expense", "amount"=>50, "notes"=>"Lunch"],
    ["id"=>3, "date"=>"2025-10-05", "account"=>"Checking", "category"=>"Freelance", "type"=>"Income", "amount"=>500, "notes"=>"Project A"],
    ["id"=>4, "date"=>"2025-10-07", "account"=>"Cash", "category"=>"Transport", "type"=>"Expense", "amount"=>20, "notes"=>"Bus Fare"],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PFMS</title>
  <link rel="icon" href="logo.jpeg" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: linear-gradient(135deg, #eef2f3, #dfe9f3);
      display: flex;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      height: 100vh;
      background: linear-gradient(180deg, #6a11cb, #2575fc);
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 0;
      position: fixed;
      left: 0;
      top: 0;
      box-shadow: 4px 0 15px rgba(0,0,0,0.15);
      border-radius: 0 20px 20px 0;
    }

    .logo {
      display: flex;
      align-items: center;
      margin-bottom: 40px;
    }

    .logo-img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 12px;
      border: 2px solid white;
    }

    .logo-text {
      font-size: 20px;
      font-weight: 600;
      letter-spacing: 1px;
    }

    .nav-links {
      list-style: none;
      padding: 0;
      width: 100%;
      margin-top: 20px;
    }

    .nav-links li a {
      display: block;
      color: rgba(255,255,255,0.9);
      text-decoration: none;
      padding: 15px 30px;
      font-weight: 500;
      transition: all 0.3s ease;
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
      flex-grow: 1;
    }

    .welcome {
      font-size: 26px;
      font-weight: 600;
      color: #333;
    }

    .subtext {
      font-size: 16px;
      color: #666;
      margin-bottom: 30px;
    }

    /* Balance card with glassmorphism */
    .balance-section {
      background: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      margin-bottom: 40px;
    }

    .balance-section h2 {
      font-size: 18px;
      color: #555;
    }

    .balance-section .balance-amount {
      font-size: 40px;
      font-weight: 700;
      color: #2575fc;
    }

    /* Summary cards */
    .summary-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 25px;
      margin-bottom: 40px;
    }

    .card {
      border: none;
      background: rgba(255,255,255,0.5);
      backdrop-filter: blur(10px);
      border-radius: 18px;
      text-align: center;
      padding: 25px 20px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .card h3 {
      font-size: 18px;
      color: #555;
      margin-bottom: 8px;
    }

    .card p {
      font-size: 22px;
      font-weight: 700;
      margin: 0;
    }

    .card-income p { color: #00b894; }
    .card-expense p { color: #ff4757; }
    .card-balance p { color: #1e90ff; }

    /* Transactions Table */
    table {
      width: 100%;
      background: rgba(255,255,255,0.6);
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
    }

    tr:nth-child(even) {
      background-color: rgba(255,255,255,0.5);
    }

    tr:hover {
      background-color: rgba(37,117,252,0.1);
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
      <img src="logo.jpeg" alt="Logo" class="logo-img">
      <span class="logo-text">PFMS</span>
    </div>

    <ul class="nav-links">
      <li><a href="dashboard.php" class="active">Dashboard</a></li>
      <li><a href="home.php">Home</a></li>
      <li><a href="categories.php">Categories</a></li>
      <li><a href="accounts.php">Accounts</a></li>
      <li><a href="transactions.php">Transactions</a></li>
      <li><a href="reports.php">Reports</a></li>
      <li><a href="sync.php">Backup</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h2 class="welcome">Welcome back, <?php echo htmlspecialchars($userName); ?>!</h2>
    <p class="subtext">Here’s your latest financial overview.</p>

    <div class="balance-section">
      <h2>Total Balance</h2>
      <p class="balance-amount">$<?php echo number_format($balance, 2); ?></p>
    </div>

    <div class="summary-cards">
      <div class="card card-income">
        <h3>Total Income</h3>
        <p>$<?php echo number_format($totalIncome, 2); ?></p>
      </div>
      <div class="card card-expense">
        <h3>Total Expenses</h3>
        <p>$<?php echo number_format($totalExpenses, 2); ?></p>
      </div>
      <div class="card card-balance">
        <h3>Net Balance</h3>
        <p>$<?php echo number_format($netBalance, 2); ?></p>
      </div>
    </div>

    <h3 class="mb-3 fw-semibold text-secondary">Recent Transactions</h3>
    <table class="table table-borderless align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Date</th>
          <th>Account</th>
          <th>Category</th>
          <th>Type</th>
          <th>Amount</th>
          <th>Notes</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($transactions as $tx): ?>
          <tr>
            <td><?php echo $tx['id']; ?></td>
            <td><?php echo $tx['date']; ?></td>
            <td><?php echo htmlspecialchars($tx['account']); ?></td>
            <td><?php echo htmlspecialchars($tx['category']); ?></td>
            <td><?php echo $tx['type']; ?></td>
            <td>$<?php echo number_format($tx['amount'], 2); ?></td>
            <td><?php echo htmlspecialchars($tx['notes']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
