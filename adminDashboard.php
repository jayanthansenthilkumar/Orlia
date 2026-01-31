<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE userid = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['role'] = $row['role'];
    } else {
        echo "<script>alert('Invalid Username or Password'); window.location.href='login.php';</script>";
        exit();
        // header("Location: login.php?error=invalid");
        // exit();
    }
}

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Orlia'26</title>
    <link rel="icon" href="assets/images/agastya.png" type="image/png">
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="admin-body">
        <!-- Sidebar -->
        <!-- Sidebar -->
        <?php
        $role = 'admin';
        $page = 'dashboard';
        include 'includes/sidebar.php';
        ?>

        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-header">
                <div class="header-left">
                    <i class="ri-menu-line menu-toggle" id="sidebarToggle"
                        style="display:none; margin-right: 15px;"></i>
                    <div>
                        <span class="section-subtitle">Overview</span>
                        <h1 class="admin-title">Dashboard</h1>
                    </div>
                </div>

                <div class="header-right">
                    <!-- Theme Toggle -->
                    <!-- <div class="theme-switch" id="theme-toggle">
                        <i class="ri-moon-line"></i>
                    </div> -->

                    <!-- User Profile -->
                    <div class="user-profile">
                        <div class="user-avatar">
                            <i class="ri-user-3-line"></i>
                        </div>
                        <div class="user-dropdown">
                            <div class="dropdown-header">
                                <h4>Admin User</h4>
                                <p>admin@orlia.com</p>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="ri-user-settings-line"></i> Profile</a></li>
                                <li><a href="#"><i class="ri-settings-4-line"></i> Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php" class="text-danger"><i class="ri-logout-box-line"></i>
                                        Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <?php
            // Fetch Stats
            $solo_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM soloevents"));
            $group_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM groupevents"));
            $total_reg = $solo_count + $group_count;
            ?>

            <!-- Stats Grid -->
            <div class="stat-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="ri-user-follow-line"></i></div>
                    <div class="stat-info">
                        <h3><?= $total_reg ?></h3>
                        <p>Total Registrations</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="ri-user-line"></i></div>
                    <div class="stat-info">
                        <h3><?= $solo_count ?></h3>
                        <p>Solo Participants</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="ri-group-line"></i></div>
                    <div class="stat-info">
                        <h3><?= $group_count ?></h3>
                        <p>Team Participants</p>
                    </div>
                </div>
            </div>

            <!-- Recent Registrations Preview -->
            <div class="table-container">
                <h2 class="mb-4">Recent Registrations (Solo)</h2>
                <table id="recentTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Event Type</th>
                            <th>Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $recent_query = "SELECT * FROM soloevents ORDER BY id DESC LIMIT 5";
                        $recent_run = mysqli_query($conn, $recent_query);
                        while ($row = mysqli_fetch_assoc($recent_run)) {
                            ?>
                            <tr>
                                <td>#S<?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['dept'] ?></td>
                                <td>Solo</td>
                                <td><?= $row['events'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="assets/script/script.js"></script>
    <script>
        $(document).ready(function () {
            $('#recentTable').DataTable({
                responsive: true,
                paging: false,
                info: false,
                searching: false
            });
        });
    </script>
</body>

</html>