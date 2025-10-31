<?php
session_start();

// Redirect if not logged in


$userName = $_SESSION["user_name"];

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            margin: 0;
            background-color: #f5f6fa;
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
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .subtext {
            font-size: 16px;
            color: #636e72;
            margin-bottom: 30px;
        }

        .balance-section {
            background-color: #00b894;
            color: white;
            padding: 25px 40px;
            border-radius: 15px;
            display: inline-block;
            margin-bottom: 30px;
        }

        .balance-section h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .balance-section .balance-amount {
            font-size: 28px;
            font-weight: 600;
        }

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 20px;
            font-weight: 600;
        }

        .card-income p { color: #00b894; }
        .card-expense p { color: #d63031; }
        .card-balance p { color: #0984e3; }

        table {
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #0984e3;
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        tr:nth-child(even) { background-color: #f2f2f2; }

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
        .btn-edit:hover { background-color: #019f7f; }
        .btn-delete { background-color: #d63031; }
        .btn-delete:hover { background-color: #c0392b; }

        @media (max-width: 768px) {
            .main-content { margin-left: 20px; padding: 20px; }
            table, th, td { font-size: 14px; }
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
        <p class="subtext">Here's your financial summary today.</p>

        <div class="balance-section">
            <h2>Total Balance</h2>
            <p class="balance-amount">$<?php echo number_format($balance,2); ?></p>
        </div>

        <div class="summary-cards">
            <div class="card card-income">
                <h3>Total Income</h3>
                <p>$<?php echo number_format($totalIncome,2); ?></p>
            </div>
            <div class="card card-expense">
                <h3>Total Expenses</h3>
                <p>$<?php echo number_format($totalExpenses,2); ?></p>
            </div>
            <div class="card card-balance">
                <h3>Net Balance</h3>
                <p>$<?php echo number_format($netBalance,2); ?></p>
            </div>
        </div>

        <h3>Recent Transactions</h3>
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
                </tr>
            </thead>
            <tbody>
                <?php foreach($transactions as $tx): ?>
                <tr>
                    <td><?php echo $tx['id']; ?></td>
                    <td><?php echo $tx['date']; ?></td>
                    <td><?php echo htmlspecialchars($tx['account']); ?></td>
                    <td><?php echo htmlspecialchars($tx['category']); ?></td>
                    <td><?php echo $tx['type']; ?></td>
                    <td>$<?php echo number_format($tx['amount'],2); ?></td>
                    <td><?php echo htmlspecialchars($tx['notes']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>