<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Orlia'25</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="assets/styles/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <div class="registration-container">
        <div class="brand-section">
            <h1>Orlia Admin</h1>
            <p>Welcome to the administrative portal of MKCE's premier technical symposium</p>
        </div>
        <div class="form-section">
            <div class="registration-form">
                <h2>Login</h2>
                <form id="adminLoginForm" method="POST" action="coordinator.php">
                    <div class="form-group">
                        <input type="text" id="userid" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="submit-btn" style="justify-content: center;">
                        <i class="ri-login-circle-line" style="margin-right: 8px;"></i> Login Access
                    </button>
                    
                    <div class="event-footer" style="justify-content: center; background: none; border: none; margin-top: 1rem;">
                        <a href="index.html" class="back-link" style="color: var(--primary-dark); text-decoration: none; display: flex; align-items: center; gap: 5px;">
                            <i class="ri-arrow-left-line"></i> Back to Home
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $query = "SELECT * FROM login WHERE userid = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            
            if ($_SESSION['role'] == 1) { header("Location: dashboard.php"); }
            else if ($_SESSION['role'] == 2) { header("Location: superadmin.php"); }
            else { header("Location: overdashboard.php"); }
            exit();
        } else {
            echo "<script>alert('Invalid Username or Password. Please try again.'); window.location.href='coordinator.php';</script>";
        }
    }
    ?>
</body>
</html>