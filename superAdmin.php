<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard - Orlia'26</title>
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
        <?php
        $role = 'super';
        $page = 'dashboard';
        include 'includes/sidebar.php';
        ?>

        <main class="admin-main">
            <header class="admin-header">
                <div class="header-left">
                    <i class="ri-menu-line menu-toggle" id="sidebarToggle"
                        style="display:none; margin-right: 15px;"></i>
                    <div>
                        <span class="section-subtitle">System Overview</span>
                        <h1 class="admin-title">Super Dashboard</h1>
                    </div>
                </div>
                <div class="header-right">
                    <div class="theme-switch" id="theme-toggle">
                        <i class="ri-moon-line"></i>
                    </div>
                    <!-- User Profile -->
                    <div class="user-profile">
                        <div class="user-avatar">
                            <i class="ri-user-3-line"></i>
                        </div>
                        <div class="user-dropdown">
                            <div class="dropdown-header">
                                <h4>Super Admin</h4>
                                <p>root@orlia.com</p>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="ri-user-settings-line"></i> Profile</a></li>
                                <li><a href="#"><i class="ri-settings-4-line"></i> Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="index.php" class="text-danger"><i class="ri-logout-box-line"></i>
                                        Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <div class="stat-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="ri-admin-line"></i></div>
                    <div class="stat-info">
                        <h3>5</h3>
                        <p>Total Admins</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="ri-user-follow-line"></i></div>
                    <div class="stat-info">
                        <h3>1,254</h3>
                        <p>Total Registrations</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="ri-calendar-2-line"></i></div>
                    <div class="stat-info">
                        <h3>12</h3>
                        <p>Active Events</p>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <h2 class="mb-4">System Activity Log</h2>
                <table id="activityTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10 mins ago</td>
                            <td>Admin1</td>
                            <td>Status Change</td>
                            <td>Closed registration for 'Paper Presentation'</td>
                        </tr>
                        <tr>
                            <td>1 hour ago</td>
                            <td>SuperAdmin</td>
                            <td>Added Admin</td>
                            <td>Created new admin account 'EventLead'</td>
                        </tr>
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
            $('#activityTable').DataTable({
                responsive: true,
                searching: false,
                paging: false,
                info: false
            });
        });
    </script>
</body>

</html>