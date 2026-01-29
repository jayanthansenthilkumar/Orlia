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
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <div class="theme-switch-wrapper">
        <div class="theme-switch" id="theme-toggle" title="Toggle Theme">
            <i class="ri-moon-line"></i>
        </div>
    </div>
    <div class="registration-container">
        <div class="brand-section">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <h1>Orlia Admin</h1>
            <p>Welcome to the administrative portal of MKCE's premier technical symposium</p>
        </div>
        <div class="form-section">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="registration-form">
                <h2>Login</h2>
                <form id="adminLoginForm" method="POST" action="coordinator.php">
                    <div class="form-group">
                        <input type="text" id="userid" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="submit-btn">
                        <i class="ri-login-circle-line"></i> Login Access
                    </button>

                    <div class="event-footer">
                        <div class="event-location" style="opacity: 0;"></div> <!-- Spacer -->
                        <a href="index.html" class="event-btn">
                            <i class="ri-arrow-left-line"></i> Back to Home
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/script/script.js"></script>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password']; // Note: Password hashing skipped as per requirement
    
        $stmt = $conn->prepare("SELECT role FROM login WHERE userid = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Security: Regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            $_SESSION['last_regen'] = time();
            $_SESSION['last_activity'] = time();

            if ($_SESSION['role'] == 1) {
                header("Location: dashboard.php");
            } else if ($_SESSION['role'] == 2) {
                header("Location: superadmin.php");
            } else {
                header("Location: overdashboard.php");
            }
            exit();
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: 'Invalid Username or Password. Please try again.',
                    confirmButtonColor: '#d33',
                    background: '#1e1e1e', // Dark mode match
                    color: '#ffffff'
                }).then(() => {
                    window.location.href='coordinator.php';
                });
            </script>";
        }
    }
    ?>
</body>

</html>