<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orlia Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/admin.css">
</head>
<body>
    <aside class="sidebar">
        <h2>Orlia</h2>
        <ul class="sidebar-nav">
            <li><a href="#" class="active"><i class="ri-mic-2-line"></i> Dashboard</a></li>
            <li><a href="users.php"><i class="ri-group-2-line"></i> Participants</a></li>
        </ul>
    </aside>
    
    <div class="main-content">
        <header class="navbar">
            <h1>Orlia'25</h1>
            <div class="nav-right">
                <div class="notification">
                    <i class="ri-notification-3-line"></i>
                </div>
                <div class="profile-dropdown">
                    <div class="profile">
                        <i class="ri-user-3-line"></i>
                        <span>Admin</span>
                    </div>
                    <div class="dropdown-menu">
                        <a href="#"><i class="ri-user-line"></i> My Profile</a>
                        <a href="#"><i class="ri-settings-3-line"></i> Settings</a>
                        <a href="#"><i class="ri-logout-box-r-line"></i> Logout</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="welcome-card">
            <h2>Welcome back, Admin! 👋</h2>
            <p>Track your team's progress and manage your projects from one central dashboard.</p>
            <a href="#" class="btn">View Reports</a>
        </div>

        <main class="dashboard-grid">
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
                    <i class="ri-git-branch-line"></i>
                </div>
                <div>
                    <h2>Active Projects</h2>
                    <p class="stats">23</p>
                </div>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="ri-pie-chart-2-line"></i>
                </div>
                <div>
                    <h2>Completion Rate</h2>
                    <p class="stats">87%</p>
                </div>
            </div>
        </main>
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
