<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orlia Super Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/admin.css">
</head>
<body>
    <aside class="sidebar">
        <h2>Orlia</h2>
        <ul class="sidebar-nav">
            <li><a href="#" class="active"><i class="ri-dashboard-line"></i> Super Dashboard</a></li>
            <li><a href="admins.php"><i class="ri-admin-line"></i> Manage Admins</a></li>
            <li><a href="users.php"><i class="ri-group-2-line"></i> All Users</a></li>
            <li><a href="events.php"><i class="ri-calendar-event-line"></i> Events</a></li>
            <li><a href="settings.php"><i class="ri-settings-4-line"></i> System Settings</a></li>
        </ul>
    </aside>
    
    <div class="main-content">
        <header class="navbar">
            <h1>Orlia'25</h1>
            <div class="nav-right">
                <div class="notification">
                    <i class="ri-notification-3-line"></i>
                    <span class="badge">5</span>
                </div>
                <div class="profile-dropdown">
                    <div class="profile">
                        <i class="ri-shield-user-line"></i>
                        <span>Super Admin</span>
                    </div>
                    <div class="dropdown-menu">
                        <a href="#"><i class="ri-shield-user-line"></i> Super Profile</a>
                        <a href="#"><i class="ri-lock-password-line"></i> Security</a>
                        <a href="#"><i class="ri-settings-3-line"></i> System Config</a>
                        <a href="#"><i class="ri-logout-box-r-line"></i> Logout</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="welcome-card">
            <h2>System Overview 🚀</h2>
            <p>Monitor and manage all aspects of the Orlia platform from this central control panel.</p>
            <a href="#" class="btn">System Health</a>
        </div>

        <main class="dashboard-grid">
            <div class="card">
                <div class="card-icon">
                    <i class="ri-admin-line"></i>
                </div>
                <div>
                    <h2>Total Admins</h2>
                    <p class="stats">12</p>
                </div>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="ri-team-line"></i>
                </div>
                <div>
                    <h2>Total Users</h2>
                    <p class="stats">1,234</p>
                </div>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="ri-calendar-event-line"></i>
                </div>
                <div>
                    <h2>Active Events</h2>
                    <p class="stats">8</p>
                </div>
            </div>
        </main>

        <section class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="action-grid">
                <a href="#" class="action-card">
                    <i class="ri-user-add-line"></i>
                    <span>Add Admin</span>
                </a>
                <a href="#" class="action-card">
                    <i class="ri-calendar-2-line"></i>
                    <span>Create Event</span>
                </a>
                <a href="#" class="action-card">
                    <i class="ri-backup-line"></i>
                    <span>Backup System</span>
                </a>
                <a href="#" class="action-card">
                    <i class="ri-file-chart-line"></i>
                    <span>Analytics</span>
                </a>
            </div>
        </section>
    </div>
    <script>
        document.querySelector('.profile').addEventListener('click', function() {
            document.querySelector('.dropdown-menu').classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.profile-dropdown')) {
                document.querySelector('.dropdown-menu').classList.remove('show');
            }
        });
    </script>
</body>
</html>