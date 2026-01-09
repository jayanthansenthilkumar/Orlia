<?php
session_start();
include('db.php');
if (!isset($_SESSION['username'])) {
    header("Location: coordinator.php");
    exit();
}
$userid = $_SESSION['username'];
$groupEvents = [
    'Divideconquer', 'Firelesscooking', 'Trailertime', 'Iplauction',
    'Lyricalhunt', 'Dumpcharades', 'Groupdance', 'Rangoli',
    'Sherlockholmes', 'Freefire', 'Treasurehunt', 'Artfromwaste',
    'Twindance', 'Vegetablefruitart',
];

if (in_array($userid, $groupEvents)) {
    $sql1 = "SELECT * FROM groupevents WHERE events='$userid'";
} else {
    $sql1 = "SELECT * FROM events WHERE events='$userid'";
}

$result1 = mysqli_query($conn, $sql1);
$count1 = mysqli_num_rows($result1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orlia Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <style>
        /* Mobile Toggle Visibility handled via JS/admin.css */
        @media (max-width: 992px) {
            #menuToggle { display: block !important; }
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
                            <i class="ri-dashboard-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="users.php" class="nav-link">
                            <i class="ri-group-line"></i>
                            <span>Participants</span>
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
                    <div class="page-title">Dashboard Overview</div>
                </div>
                <div class="nav-actions">
                     <button class="icon-btn">
                        <i class="ri-notification-3-line"></i>
                        <span class="badge">3</span>
                    </button>
                    <div class="profile-dropdown">
                        <div class="profile-trigger" id="profileTrigger">
                            <div class="avatar">
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
                    <div class="card card--welcome" style="grid-column: 1 / -1;">
                        <h2 class="card-value">Welcome back, <?php echo $userid; ?> 👋</h2>
                        <p>Manage your event participants and track registrations in real-time.</p>
                    </div>

                    <!-- Stats Card -->
                    <div class="card">
                        <div class="card-title">Total Participants</div>
                        <div class="card-value"><?php echo $count1; ?></div>
                        <div style="margin-top: 10px; color: var(--google-green); font-size: 0.9rem; display: flex; align-items: center; gap: 5px;">
                            <i class="ri-arrow-up-circle-fill"></i> +12% this week
                        </div>
                    </div>

                    <!-- Example Placeholder Card -->
                    <div class="card">
                        <div class="card-title">Event Status</div>
                        <div class="card-value" style="font-size: 1.5rem;">Active</div>
                        <div style="margin-top: 10px; color: var(--text-secondary); font-size: 0.9rem;">
                            Registration closes in 3 days
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const profileTrigger = document.getElementById('profileTrigger');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', (e) => {
                if (window.innerWidth <= 992 && 
                    !sidebar.contains(e.target) && 
                    !menuToggle.contains(e.target) && 
                    sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                }
            });
        }

        profileTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', (e) => {
            if (!profileTrigger.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    </script>
</body>
</html>
