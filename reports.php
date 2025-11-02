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
<title>PFMS</title>
  <link rel="icon" href="logo.jpeg" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    font-size: 28px;
    font-weight: 600;
    color: #2d3436;
    margin-bottom: 30px;
}

/* Summary Cards */
.summary-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
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
    font-size: 20px;
    margin-bottom: 10px;
    color: #2d3436;
}

.card p {
    font-size: 18px;
    font-weight: 600;
}

.card-income p { color: #00b894; }
.card-expense p { color: #d63031; }
.card-balance p { color: #0984e3; }

/* Chart Container */
#transactionsChart {
    background: rgba(255,255,255,0.5);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

@media (max-width: 768px) {
    .main-content { margin-left: 20px; padding: 20px; }
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
        <li><a href="transactions.php">Transactions</a></li>
        <li><a href="reports.php" class="active">Reports</a></li>
        <li><a href="backup.php">Backup</a></li>
        <li><a href="profile.php">Profile</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="header"><h2><b>Reports</b></h2></div>

    <div class="summary-cards">
        <div class="card card-income">
            <h3>Total Income</h3>
            <p>$<?= number_format($totalIncome, 2); ?></p>
        </div>
        <div class="card card-expense">
            <h3>Total Expenses</h3>
            <p>$<?= number_format($totalExpenses, 2); ?></p>
        </div>
        <div class="card card-balance">
            <h3>Net Balance</h3>
            <p>$<?= number_format($netBalance, 2); ?></p>
        </div>
    </div>

    <div>
        <canvas id="transactionsChart"></canvas>
    </div>
</div>

<script>
const ctx = document.getElementById('transactionsChart').getContext('2d');

// Gradient colors for modern look
const gradientIncome = ctx.createLinearGradient(0, 0, 0, 400);
gradientIncome.addColorStop(0, 'rgba(0, 255, 183, 0.8)');
gradientIncome.addColorStop(1, 'rgba(0, 184, 148, 0.6)');

const gradientExpense = ctx.createLinearGradient(0, 0, 0, 400);
gradientExpense.addColorStop(0, 'rgba(255, 99, 132, 0.8)');
gradientExpense.addColorStop(1, 'rgba(214,48,49,0.6)');

const chartData = {
    labels: <?= json_encode(array_column($transactions, 'date')); ?>,
    datasets: [
        {
            label: 'Income',
            data: <?= json_encode(array_column($transactions, 'income')); ?>,
            backgroundColor: gradientIncome,
            borderColor: 'rgba(0,184,148,1)',
            borderWidth: 1,
            borderRadius: 10,
            maxBarThickness: 50
        },
        {
            label: 'Expenses',
            data: <?= json_encode(array_column($transactions, 'expense')); ?>,
            backgroundColor: gradientExpense,
            borderColor: 'rgba(214,48,49,1)',
            borderWidth: 1,
            borderRadius: 10,
            maxBarThickness: 50
        }
    ]
};

new Chart(ctx, {
    type: 'bar',
    data: chartData,
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: { font: { size: 14, weight: '500' }, color: '#2d3436' }
            },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.8)',
                titleColor: '#fff',
                bodyColor: '#fff',
                bodyFont: { size: 14 }
            }
        },
        scales: {
            x: { ticks: { color: '#2d3436', font: { weight: '500' } }, grid: { color: 'rgba(0,0,0,0.05)' } },
            y: { beginAtZero: true, ticks: { color: '#2d3436', font: { weight: '500' } }, grid: { color: 'rgba(0,0,0,0.05)' } }
        }
    }
});
</script>

</body>
</html>
