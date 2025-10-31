<?php
session_start();

// Example data
$userName = $_SESSION["user_name"];
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
    <title>Home - Finance Dashboard</title>
    <link rel="stylesheet" href="styles2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            background-color: #f5f6fa;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background-color: #1e1e2f;
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 25px;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 8px rgba(0,0,0,0.2);
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
        }

        .logo-img {
            height: 45px;
            width: 45px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 600;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            width: 100%;
        }

        .nav-links li {
            width: 100%;
        }

        .nav-links li a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-links li a:hover,
        .nav-links li a.active {
            background-color: #00b894;
            color: #fff;
        }

        /* Main Content */
        .main-content {
            margin-left: 240px;
            padding: 40px;
            flex-grow: 1;
        }

        .welcome {
            font-size: 26px;
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
            background-color: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
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
            font-size: 28px;
            margin-bottom: 10px;
            color: #0984e3;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="images/personal-growth.png" alt="Logo" class="logo-img">
            <span class="logo-text">Finance</span>
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="home.php" class="active">Home</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="accounts.php">Accounts</a></li>
            <li><a href="transactions.php">Transactions</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="backup.php">Backup</a></li>
            <li><a href="profile.php">Profile</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2 class="welcome">Welcome back<?php echo htmlspecialchars($userName); ?>!</h2>
        <p>Here’s a quick overview of your finances:</p>

        <div class="stats-cards mt-4">
            <div class="card">
                <i class="bi bi-wallet2"></i>
                <h3>Total Balance</h3>
                <p>$<?php echo number_format($totalBalance, 2); ?></p>
            </div>
            <div class="card">
                <i class="bi bi-bank"></i>
                <h3>Accounts</h3>
                <p><?php echo $totalAccounts; ?></p>
            </div>
            <div class="card">
                <i class="bi bi-arrow-up-circle"></i>
                <h3>Transactions</h3>
                <p><?php echo $totalTransactions; ?></p>
            </div>
            <div class="card">
                <i class="bi bi-tags"></i>
                <h3>Categories</h3>
                <p><?php echo $totalCategories; ?></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS & Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
