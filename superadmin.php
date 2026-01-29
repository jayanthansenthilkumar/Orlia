<?php
session_start();
include('db.php');
if (!isset($_SESSION['username'])) {
    header("Location: coordinator.php");
    exit();
}

// Session Security
if (!isset($_SESSION['last_regen'])) {
    session_regenerate_id(true);
    $_SESSION['last_regen'] = time();
} elseif (time() - $_SESSION['last_regen'] > 300) {
    session_regenerate_id(true);
    $_SESSION['last_regen'] = time();
}
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: coordinator.php");
    exit();
}
$_SESSION['last_activity'] = time();

$userid = $_SESSION['username'];

$sql1 = "SELECT * FROM events";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM groupevents";
$result2 = mysqli_query($conn, $sql2);
$count1 = mysqli_num_rows($result1);
$count2 = mysqli_num_rows($result2);
$totalParticipants = $count2 + $count1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard - Orlia</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Orlia Super Admin</title>
    <link rel="stylesheet" href="assets/styles/admin.css">
    <style>
        @media (max-width: 992px) {
            #menuToggle {
                display: block !important;
            }
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">
                    <i class="ri-google-fill"></i> Orlia Admin
                </div>
            </div>
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="ri-dashboard-line"></i>
                            <span>Overview</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admins.php" class="nav-link">
                            <i class="ri-admin-line"></i>
                            <span>Manage Admins</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="events.php" class="nav-link">
                            <i class="ri-calendar-event-line"></i>
                            <span>Events</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="navbar">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <button class="icon-btn" id="menuToggle" style="display: none;">
                        <i class="ri-menu-line"></i>
                    </button>
                    <div class="page-title">Super Admin Dashboard</div>
                </div>
                <div class="nav-actions">
                    <div class="theme-switch-wrapper" style="position: static; margin-right: 15px;">
                        <div class="theme-switch" id="theme-toggle" title="Toggle Theme"
                            style="background: var(--bg-hover); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-primary);">
                            <i class="ri-moon-line"></i>
                        </div>
                    </div>
                    <button class="icon-btn">
                        <i class="ri-notification-3-line"></i>
                        <span class="badge">5</span>
                    </button>
                    <div class="profile-dropdown">
                        <div class="profile-trigger" id="profileTrigger">
                            <div class="avatar" style="background: var(--google-red);">
                                <?php echo strtoupper(substr($userid, 0, 1)); ?>
                            </div>
                            <span class="d-none d-md-block"><?php echo $userid; ?></span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="logout.php" class="dropdown-item">
                                <i class="ri-logout-box-r-line"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <div class="grid-container">
                    <!-- Welcome Card -->
                    <div class="card card--welcome"
                        style="grid-column: 1 / -1; background: linear-gradient(135deg, var(--google-red), #b93221);">
                        <h2 class="card-value">System Overview 🚀</h2>
                        <div style="font-size: 1.25rem; margin-top: 8px; opacity: 0.9;">Welcome back,
                            <?php echo $userid; ?>
                        </div>
                        <p>Monitor system health, manage administrators, and oversee all event registrations.</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="card">
                        <div class="card-title">Total Admins</div>
                        <div class="card-value">29</div>
                        <div style="margin-top: 10px; color: var(--text-secondary); font-size: 0.9rem;">
                            <i class="ri-shield-user-fill" style="margin-right: 5px; color: var(--google-blue);"></i>
                            Active coordinators
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-title">Total Users</div>
                        <div class="card-value"><?php echo $totalParticipants; ?></div>
                        <div
                            style="margin-top: 10px; color: var(--google-green); font-size: 0.9rem; display: flex; align-items: center; gap: 5px;">
                            <i class="ri-group-fill"></i> Across all events
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-title">Total Events</div>
                        <div class="card-value">27</div>
                        <div
                            style="margin-top: 10px; color: var(--google-yellow); font-size: 0.9rem; display: flex; align-items: center; gap: 5px;">
                            <i class="ri-calendar-check-fill"></i> Scheduled
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="assets/script/script.js"></script>
    <script>
        const profileTrigger = document.getElementById('profileTrigger');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });

            document.addEventListener('click', (e) => {
                if (window.innerWidth <= 992 && !sidebar.contains(e.target) && !menuToggle.contains(e.target) && sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                }
            });
        }

        profileTrigger.addEventListener('click', (e) => { e.stopPropagation(); dropdownMenu.classList.toggle('show'); });
        document.addEventListener('click', (e) => { if (!profileTrigger.contains(e.target)) dropdownMenu.classList.remove('show'); });
    </script>
</body>

</html>