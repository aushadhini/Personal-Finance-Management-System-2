<?php
session_start();

// Simulated user data (replace with DB query)
$userName = $_SESSION["user_name"];
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
        // Update password in DB (simulated)
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

        h2 { font-size: 24px; font-weight: 600; margin-bottom: 20px; }

        .profile-section {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .profile-info, .profile-form {
            background-color: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            flex: 1;
            min-width: 300px;
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
            border-radius: 8px;
            border: none;
            background-color: #00b894;
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }

        .profile-form button:hover { background-color: #019f7f; }

        .status-message {
            margin-bottom: 20px;
            font-size: 16px;
            color: #2d3436;
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
            <li><a href="sync.php">Backup</a></li>
            <li><a href="profile.php" class="active">Profile</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>My Profile</h2>

        <?php if($statusMessage): ?>
            <div class="status-message"><?php echo htmlspecialchars($statusMessage); ?></div>
        <?php endif; ?>

        <div class="profile-section">

            <!-- Profile Info -->
            <div class="profile-info">
                <img src="uploads/<?php echo $userPhoto; ?>" alt="Profile Picture" class="profile-img">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($userName); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($userEmail); ?></p>
                <p><strong>Mobile:</strong> <?php echo htmlspecialchars($userMobile); ?></p>
                <p><strong>Gender:</strong> <?php echo ucfirst($userGender); ?></p>

                <!-- Upload Photo -->
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="profile_photo" required>
                    <button type="submit" name="update_photo">Change Photo</button>
                </form>
            </div>

            <!-- Edit Profile & Change Password -->
            <div class="profile-form">
                <h3>Edit Profile</h3>
                <form method="post">
                    <input type="text" name="name" value="<?php echo htmlspecialchars($userName); ?>" placeholder="Full Name" required>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($userEmail); ?>" placeholder="Email" required>
                    <input type="text" name="mobile" value="<?php echo htmlspecialchars($userMobile); ?>" placeholder="Mobile" required>
                    <select name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male" <?php if($userGender=="male") echo "selected"; ?>>Male</option>
                        <option value="female" <?php if($userGender=="female") echo "selected"; ?>>Female</option>
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

</body>
</html>
