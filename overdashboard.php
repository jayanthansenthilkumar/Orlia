<?php
session_start();
include('db.php');
if (!isset($_SESSION['username'])) {
    header("Location: coordinator.php");
    exit();
}
$userid = $_SESSION['username'];
$sql1 = "SELECT * FROM events" ;
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM groupevents" ;
$result2 = mysqli_query($conn, $sql2);
$count1 = mysqli_num_rows($result1);
$count2 = mysqli_num_rows($result2);
$count2+=$count1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Orlia</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <style>
        @media (max-width: 992px) { #menuToggle { display: block !important; } }
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
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="overuser.php" class="nav-link">
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
                    <div class="page-title">Overall Dashboard</div>
                </div>
                <div class="nav-actions">
                    <div class="profile-dropdown">
                        <div class="profile-trigger" id="profileTrigger">
                            <div class="avatar" style="background: var(--google-yellow); color: #333;">
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
                    <div class="card card--welcome" style="grid-column: 1 / -1; background: linear-gradient(135deg, var(--google-yellow), #f9ab00);">
                        <h2 class="card-value" style="color: #202124;">Overview Central ⚡</h2>
                        <div style="font-size: 1.25rem; margin-top: 8px; opacity: 0.9; color: #202124;">Welcome back, <?php echo $userid; ?></div>
                        <p style="color: #3c4043;">Quickly view statistics for all events and registrations.</p>
                    </div>

                    <div class="card">
                        <div class="card-title">Event Registrations</div>
                        <div class="card-value"><?php echo $count2; ?></div>
                        <div style="margin-top: 10px; color: var(--google-blue); font-size: 0.9rem; display: flex; align-items: center; gap: 5px;">
                            <i class="ri-user-add-fill"></i> Total Participants
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-title">Total Events</div>
                        <div class="card-value">26</div> 
                        <div style="margin-top: 10px; color: var(--text-secondary); font-size: 0.9rem;">
                             <i class="ri-calendar-check-line"></i> Active
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
