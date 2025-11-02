<?php
session_start();

// Example data
$userName = $_SESSION["user_name"] ?? "User";
$totalBalance = 15420.75;
$totalAccounts = 5;
$totalTransactions = 120;
$totalCategories = 8;
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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

    .welcome {
      font-size: 28px;
      font-weight: 600;
      color: #2d3436;
      margin-bottom: 20px;
    }

    .stats-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }

    .card {
      background: rgba(255,255,255,0.5);
      backdrop-filter: blur(10px);
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .card h3 {
      font-size: 22px;
      margin-bottom: 10px;
      color: #2d3436;
    }

    .card p {
      font-size: 18px;
      font-weight: 600;
      color: #00b894;
    }

    .card i {
      font-size: 36px;
      margin-bottom: 10px;
      color: #2575fc;
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
      <li><a href="home.php" class="active">Home</a></li>
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
    <h4><b>Quick overview of your finances:</b></h4>

    <div class="stats-cards mt-4">
      <div class="card">
        <i class="bi bi-wallet2"></i>
        <h3>Total Balance</h3>
        <p>$<?= number_format($totalBalance, 2); ?></p>
      </div>
      <div class="card">
        <i class="bi bi-bank"></i>
        <h3>Accounts</h3>
        <p><?= $totalAccounts; ?></p>
      </div>
      <div class="card">
        <i class="bi bi-arrow-up-circle"></i>
        <h3>Transactions</h3>
        <p><?= $totalTransactions; ?></p>
      </div>
      <div class="card">
        <i class="bi bi-tags"></i>
        <h3>Categories</h3>
        <p><?= $totalCategories; ?></p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
