<?php
session_start();

// Example summary data
$totalIncome = 5000;
$totalExpenses = 2000;
$netBalance = $totalIncome - $totalExpenses;

// Example transactions data for chart
$transactions = [
    ["date"=>"2025-10-01", "income"=>2000, "expense"=>500],
    ["date"=>"2025-10-05", "income"=>1500, "expense"=>200],
    ["date"=>"2025-10-10", "income"=>1500, "expense"=>1300],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Finance Dashboard</title>
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

        .header {
            font-size: 26px;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 30px;
        }

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background-color: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #2d3436;
        }

        .card p {
            font-size: 18px;
            font-weight: 600;
        }

        .card-income p {
            color: #00b894;
        }

        .card-expense p {
            color: #d63031;
        }

        .card-balance p {
            color: #0984e3;
        }

        #transactionsChart {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 20px;
                padding: 20px;
            }
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
            <li><a href="home.php">Home</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="accounts.php">Accounts</a></li>
            <li><a href="transactions.php">Transactions</a></li>
            <li><a href="reports.php" class="active">Reports</a></li>
            <li><a href="backup.php">Backup</a></li>
            <li><a href="profile.php">Profile</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">Reports</div>

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

        <div>
            <canvas id="transactionsChart"></canvas>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('transactionsChart').getContext('2d');

        const chartData = {
            labels: <?php echo json_encode(array_column($transactions, 'date')); ?>,
            datasets: [
                {
                    label: 'Income',
                    data: <?php echo json_encode(array_column($transactions, 'income')); ?>,
                    backgroundColor: 'rgba(0,184,148,0.7)',
                    borderColor: 'rgba(0,184,148,1)',
                    borderWidth: 1
                },
                {
                    label: 'Expenses',
                    data: <?php echo json_encode(array_column($transactions, 'expense')); ?>,
                    backgroundColor: 'rgba(214,48,49,0.7)',
                    borderColor: 'rgba(214,48,49,1)',
                    borderWidth: 1
                }
            ]
        };

        const transactionsChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

</body>
</html>
