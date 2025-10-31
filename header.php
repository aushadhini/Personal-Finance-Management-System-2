<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION["user_name"])) {
    header("Location: signin.php");
    exit();
}

$userName = $_SESSION["user_name"];
?>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <img src="images/personal-growth.png" alt="Logo" class="logo-img">
        <span class="logo-text">Finance</span>
    </div>
    <ul class="nav-links">
        <li><a href="dashboard.php" class="<?php if(basename($_SERVER['PHP_SELF'])=='dashboard.php'){echo 'active';} ?>">Dashboard</a></li>
        <li><a href="categories.php" class="<?php if(basename($_SERVER['PHP_SELF'])=='categories.php'){echo 'active';} ?>">Categories</a></li>
        <li><a href="accounts.php" class="<?php if(basename($_SERVER['PHP_SELF'])=='accounts.php'){echo 'active';} ?>">Accounts</a></li>
        <li><a href="transactions.php" class="<?php if(basename($_SERVER['PHP_SELF'])=='transactions.php'){echo 'active';} ?>">Transactions</a></li>
        <li><a href="reports.php" class="<?php if(basename($_SERVER['PHP_SELF'])=='reports.php'){echo 'active';} ?>">Reports</a></li>
        <li><a href="sync.php" class="<?php if(basename($_SERVER['PHP_SELF'])=='sync.php'){echo 'active';} ?>">Backup</a></li>
        <li><a href="profile.php" class="<?php if(basename($_SERVER['PHP_SELF'])=='profile.php'){echo 'active';} ?>">Profile</a></li>
    </ul>
</div>

<!-- Sidebar Styles (can be moved to a separate CSS file) -->
<style>
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
</style>
