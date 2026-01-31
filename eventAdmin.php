<?php
include 'includes/auth.php';
checkUserAccess();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Admin Dashboard - Orlia'26</title>
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
        $role = 'event';
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
                        <span class="section-subtitle">Event Overview</span>
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
                                <h4>Event Admin</h4>
                                <p>event@orlia.com</p>
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
            include 'db.php';
            $eventKey = $_SESSION['userid']; // Assuming userid is the event key

            // 1. Get Totals
            $solo_query = "SELECT * FROM soloevents WHERE events='$eventKey'";
            $group_query = "SELECT * FROM groupevents WHERE events='$eventKey'";
            
            $solo_run = mysqli_query($conn, $solo_query);
            $group_run = mysqli_query($conn, $group_query);

            $solo_count = mysqli_num_rows($solo_run);
            $group_count = mysqli_num_rows($group_run);
            $total_reg = $solo_count + $group_count;

            // Optional: Calculate 'paid/verified' if columns exist. default to 0 for now as schema is unsure.
            $verified_count = 0; 
            $pending_count = $total_reg; 

            // 2. Fetch Recent (Merge and sort by ID desc is tricky without UNION, so we just take last 5 of each or standard)
            // Simpler: Just show recent 5 from solo for now, or mix.
            $recent_rows = [];
            while($row = mysqli_fetch_assoc($solo_run)) {
                $row['type'] = 'Solo';
                $recent_rows[] = $row;
            }
            while($row = mysqli_fetch_assoc($group_run)) {
                $row['type'] = 'Group';
                $row['name'] = $row['teamname']; // Normalize name
                $row['regno'] = $row['tregno']; // Normalize roll
                $recent_rows[] = $row;
            }
            // Sort by ID descending (simulated timestamp)
            usort($recent_rows, function($a, $b) {
                return $b['id'] - $a['id'];
            });
            $recent_rows = array_slice($recent_rows, 0, 5);
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
                <!-- Placeholder stats until schema confirmed -->
                <div class="stat-card">
                    <div class="stat-icon"><i class="ri-check-double-line"></i></div>
                    <div class="stat-info">
                        <h3><?= $solo_count ?></h3>
                        <p>Solo Participants</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="ri-group-line"></i></div>
                    <div class="stat-info">
                        <h3><?= $group_count ?></h3>
                        <p>Group Teams</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity / Registrations -->
            <div class="table-container">
                <h2 class="mb-4">Recent Registrations</h2>
                <table id="eventRecentTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name / Team</th>
                            <th>Roll No</th>
                            <th>Year</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($recent_rows as $row): ?>
                        <tr>
                            <td>#<?= ($row['type'] == 'Solo' ? 'S' : 'G') . $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['regno'] . ($row['type'] == 'Group' ? ' (Lead)' : '') ?></td>
                            <td><?= $row['year'] ?></td>
                            <td><span class="status-badge status-active"><?= $row['type'] ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($recent_rows)): ?>
                        <tr><td colspan="5" style="text-align:center;">No registrations yet.</td></tr>
                        <?php endif; ?>
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
            $('#eventRecentTable').DataTable({
                responsive: true,
                paging: false,
                info: false,
                searching: false
            });
        });
    </script>
</body>

</html>