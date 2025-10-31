<?php
session_start();

// Simulate backup/sync actions
$statusMessage = "";

if (isset($_POST['backup'])) {
    // Here you can write actual database backup code
    $statusMessage = "Database backup completed successfully!";
}

if (isset($_POST['sync'])) {
    // Here you can write actual data sync code
    $statusMessage = "Data synced successfully with server!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup & Sync - Finance Dashboard</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            font-size: 26px;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 30px;
        }

        .btn-backup, .btn-sync {
            border-radius: 10px;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 500;
            border: none;
            color: white;
            margin: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-backup {
            background-color: #0984e3;
        }

        .btn-backup:hover {
            background-color: #0652c5;
        }

        .btn-sync {
            background-color: #00b894;
        }

        .btn-sync:hover {
            background-color: #019f7f;
        }

        .status-message {
            margin-top: 20px;
            font-size: 18px;
            font-weight: 500;
            color: #2d3436;
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
            <li><a href="reports.php">Reports</a></li>
            <li><a href="sync.php" class="active">Backup</a></li>
            <li><a href="profile.php">Profile</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">Backup & Sync</div>

        <form method="post">
            <button type="submit" name="backup" class="btn-backup">Backup Database</button>
            <button type="submit" name="sync" class="btn-sync">Sync Data</button>
        </form>

        <?php if($statusMessage): ?>
            <div class="status-message"><?php echo htmlspecialchars($statusMessage); ?></div>
        <?php endif; ?>
    </div>

</body>
</html>
