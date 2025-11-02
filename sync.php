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
    padding: 50px 40px;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.header {
    font-size: 28px;
    font-weight: 600;
    color: #2d3436;
    margin-bottom: 40px;
}

.btn-backup, .btn-sync {
    border-radius: 15px;
    padding: 15px 35px;
    font-size: 18px;
    font-weight: 500;
    border: none;
    color: white;
    margin: 15px;
    cursor: pointer;
    transition: 0.3s;
    backdrop-filter: blur(8px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.btn-backup {
    background: rgba(9, 132, 227, 0.85);
}

.btn-backup:hover {
    background: rgba(9, 132, 227, 1);
}

.btn-sync {
    background: rgba(0, 184, 148, 0.85);
}

.btn-sync:hover {
    background: rgba(0, 184, 148, 1);
}

.status-message {
    margin-top: 30px;
    font-size: 18px;
    font-weight: 500;
    color: #2d3436;
    padding: 15px 25px;
    background: rgba(255,255,255,0.5);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

@media (max-width: 768px) {
    .main-content {
        margin-left: 20px;
        padding: 20px;
    }
    .btn-backup, .btn-sync {
        width: 80%;
        padding: 12px 0;
        font-size: 16px;
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
        <li><a href="accounts.php">Accounts</a></li>
        <li><a href="transactions.php">Transactions</a></li>
        <li><a href="reports.php">Reports</a></li>
        <li><a href="sync.php" class="active">Backup</a></li>
        <li><a href="profile.php">Profile</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="header"><h2><b>Backup & Sync</b></h2></div>

    <form method="post" class="d-flex flex-column align-items-center">
        <button type="submit" name="backup" class="btn-backup">💾 Backup Database</button>
        <button type="submit" name="sync" class="btn-sync">🔄 Sync Data</button>
    </form>

    <?php if($statusMessage): ?>
        <div class="status-message"><?php echo htmlspecialchars($statusMessage); ?></div>
    <?php endif; ?>
</div>

</body>
</html>
