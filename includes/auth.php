<?php
function checkUserAccess($isPublic = false)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // If public page and NOT logged in, just return (allow access)
    if ($isPublic && !isset($_SESSION['userid'])) {
        return;
    }
    // If protected page and NOT logged in, redirect to login
    // Or if logged in but on public page, check if allowed
    if (!isset($_SESSION['userid'])) {
        header('Location: login.php');
        exit();
    }

    // Check session timeout (1 hour = 3600 seconds)
    if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > 3600)) {
        // Session has expired
        session_unset();
        session_destroy();
        header('Location: login.php?timeout=1');
        exit();
    }

    // Get current page and user info
    $current_page = basename($_SERVER['PHP_SELF']);
    $user_role = $_SESSION['role'];

    // Define allowed pages for each role
    $allowed_pages = [
        '2' => ['superAdmin.php', 'manageAdmins.php', 'overallParticipants.php', 'manageEvent.php', 'logout.php'], // Super Admin
        '1' => ['eventAdmin.php', 'eventParticipants.php', 'logout.php'], // Event Admin
        '0' => ['adminDashboard.php', 'manageParticipants.php', 'manageAdmins.php', 'logout.php'] // Co-Admin
    ];

    // Determine Dashboard for redirect (optional, now we destroy session)
    $dashboards = [
        '2' => 'superAdmin.php',
        '1' => 'eventAdmin.php',
        '0' => 'adminDashboard.php'
    ];

    // Check access rights
    if (array_key_exists($user_role, $allowed_pages)) {
        if (!in_array($current_page, $allowed_pages[$user_role])) {
            // Unauthorized page for this role -> DESTROY SESSION
            session_unset();
            session_destroy();
            // Redirect to public home or login
            header("Location: index.php");
            exit();
        }
    } else {
        // Invalid role
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit();
    }

    // Verify sessionStorage data exists (Frontend Check)
    echo "<script>
        if (!sessionStorage.getItem('userData')) {
            // Optional: You might want to unset session via ajax or just redirect
            // window.location.href = 'logout.php'; 
        }
    </script>";
}
?>