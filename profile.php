<?php
session_start();

// Simulated user data (replace with DB query)
$userName = $_SESSION["user_name"] ?? "User";
$userEmail = "user@example.com";
$userMobile = "0771234568";
$userGender = "female";
$userPhoto = "default.png"; // default profile picture

$statusMessage = "";

// Handle profile update
if (isset($_POST['update_profile'])) {
    $userName = $_POST['name'];
    $userEmail = $_POST['email'];
    $userMobile = $_POST['mobile'];
    $userGender = $_POST['gender'];
    $statusMessage = "Profile updated successfully!";
}

// Handle password change
if (isset($_POST['update_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        $statusMessage = "Password updated successfully!";
    } else {
        $statusMessage = "New password and confirm password do not match!";
    }
}

// Handle profile photo upload
if (isset($_POST['update_photo'])) {
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        $filename = $_FILES['profile_photo']['name'];
        $tempname = $_FILES['profile_photo']['tmp_name'];
        $folder = "uploads/" . $filename;
        move_uploaded_file($tempname, $folder);
        $userPhoto = $filename;
        $statusMessage = "Profile photo updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile - Finance Dashboard</title>
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

h2 { font-size: 28px; font-weight: 600; margin-bottom: 20px; }

.status-message {
    margin-bottom: 20px;
    font-size: 16px;
    color: #2d3436;
}

/* Profile Section */
.profile-section {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
}

.profile-info, .profile-form {
    background: rgba(255,255,255,0.5);
    backdrop-filter: blur(10px);
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    flex: 1;
    min-width: 300px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.profile-info:hover, .profile-form:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}

.profile-info img.profile-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
}

.profile-info p {
    margin: 5px 0;
    font-size: 16px;
    font-weight: 500;
}

.profile-form input, .profile-form select {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.profile-form button {
    padding: 10px 20px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(90deg, #00b894, #019fef);
    color: white;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.profile-form button:hover {
    background: linear-gradient(90deg, #01a17d, #1280df);
}

@media (max-width: 768px) {
    .main-content { margin-left: 20px; padding: 20px; }
    .profile-section { flex-direction: column; }
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
        <li><a href="sync.php">Backup</a></li>
        <li><a href="profile.php" class="active">Profile</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    <h2>My Profile</h2>

    <?php if($statusMessage): ?>
        <div class="status-message"><?= htmlspecialchars($statusMessage); ?></div>
    <?php endif; ?>

    <div class="profile-section">

        <!-- Profile Info -->
        <div class="profile-info text-center">
            <img src="uploads/<?= $userPhoto; ?>" alt="Profile Picture" class="profile-img">
            <p><strong>Name:</strong> <?= htmlspecialchars($userName); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($userEmail); ?></p>
            <p><strong>Mobile:</strong> <?= htmlspecialchars($userMobile); ?></p>
            <p><strong>Gender:</strong> <?= ucfirst($userGender); ?></p>

            <!-- Upload Photo -->
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="profile_photo" required class="mb-2">
                <button type="submit" name="update_photo">Change Photo</button>
            </form>
        </div>

        <!-- Edit Profile & Change Password -->
        <div class="profile-form">
            <h3>Edit Profile</h3>
            <form method="post">
                <input type="text" name="name" value="<?= htmlspecialchars($userName); ?>" placeholder="Full Name" required>
                <input type="email" name="email" value="<?= htmlspecialchars($userEmail); ?>" placeholder="Email" required>
                <input type="text" name="mobile" value="<?= htmlspecialchars($userMobile); ?>" placeholder="Mobile" required>
                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male" <?= $userGender=="male"?"selected":""; ?>>Male</option>
                    <option value="female" <?= $userGender=="female"?"selected":""; ?>>Female</option>
                </select>
                <button type="submit" name="update_profile">Update Profile</button>
            </form>

            <hr style="margin:20px 0;">

            <h3>Change Password</h3>
            <form method="post">
                <input type="password" name="current_password" placeholder="Current Password" required>
                <input type="password" name="new_password" placeholder="New Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
                <button type="submit" name="update_password">Update Password</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
