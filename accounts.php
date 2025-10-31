<?php
session_start();

// Example accounts (replace with DB query)
$accounts = [
    ["id"=>1, "name"=>"Checking Account", "type"=>"Bank", "balance"=>2000],
    ["id"=>2, "name"=>"Savings Account", "type"=>"Bank", "balance"=>5000],
    ["id"=>3, "name"=>"Cash Wallet", "type"=>"Cash", "balance"=>150],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts - Finance Dashboard</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 26px;
            font-weight: 600;
            color: #2d3436;
        }

        .btn-add {
            background-color: #00b894;
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 10px;
            padding: 10px 20px;
            transition: 0.3s;
        }

        .btn-add:hover {
            background-color: #019f7f;
        }

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

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-btn {
            border: none;
            padding: 5px 12px;
            border-radius: 8px;
            cursor: pointer;
            margin-right: 5px;
            font-size: 14px;
            color: white;
        }

        .btn-edit {
            background-color: #00b894;
        }

        .btn-edit:hover {
            background-color: #019f7f;
        }

        .btn-delete {
            background-color: #d63031;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 20px;
                padding: 20px;
            }

            table, th, td {
                font-size: 14px;
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
            <li><a href="dashoboard.php">Dashboard</a></li>
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
            <h2>Accounts</h2>
            <button class="btn-add" onclick="addAccount();">➕ Add New Account</button>
        </div>

        <table class="table table-borderless">
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
                    <td><?php echo $acc['id']; ?></td>
                    <td><?php echo htmlspecialchars($acc['name']); ?></td>
                    <td><?php echo $acc['type']; ?></td>
                    <td>$<?php echo number_format($acc['balance'],2); ?></td>
                    <td>
                        <button class="action-btn btn-edit" onclick="editAccount(<?php echo $acc['id']; ?>)">Edit</button>
                        <button class="action-btn btn-delete" onclick="deleteAccount(<?php echo $acc['id']; ?>)">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function addAccount() {
            alert('Open Add Account form here!');
        }

        function editAccount(id) {
            alert('Edit account with ID: ' + id);
        }

        function deleteAccount(id) {
            if(confirm('Are you sure you want to delete account ID ' + id + '?')) {
                alert('Account deleted (simulate)');
            }
        }
    </script>
</body>
</html>
