<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orlia Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root {
            --primary-light: #5eead4;
            --primary-mid: #14b8a6;
            --primary-dark: #134e4a;
            --bg-light: #f0fdfa;
            --gradient: linear-gradient(145deg, #134e4a, #14b8a6, #5eead4);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: var(--gradient);
            height: 100vh;
            padding: 2rem 1rem;
            color: #fff;
            position: fixed;
        }
        .sidebar h2 {
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 2rem;
            padding: 0.8rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .sidebar h2 i {
            font-size: 1.8rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem;
            border-radius: 6px;
            transition: transform 0.3s;
        }
        
        .sidebar h2:hover i {
            transform: rotate(15deg);
        }
        
        .version-tag {
            font-size: 0.7em;
            opacity: 0.8;
            background: rgba(255, 255, 255, 0.15);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            margin-left: auto;
        }
        
        .sidebar-nav {
            list-style: none;
            margin-top: 2rem;
        }
        .sidebar-nav li {
            margin: 1rem 0;
        }
        .sidebar-nav i {
            width: 25px;
            margin-right: 8px;
        }
        .sidebar-nav a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background 0.3s;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        .sidebar-nav a:hover {
            background: var(--primary-dark);
        }
        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--primary-light);
        }
        .navbar {
            background: #fff;
            padding: 1.2rem 2.5rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(20, 184, 166, 0.1);
        }
        .navbar h1 {
            font-size: 1.5rem;
            color: var(--primary-dark);
            font-weight: 600;
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .nav-right .notification {
            position: relative;
            padding: 0.5rem;
            border-radius: 50%;
            background: var(--bg-light);
        }
        .nav-right .notification::after {
            content: '';
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
        }
        .nav-right .profile {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.5rem 1rem;
            background: var(--bg-light);
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .nav-right .profile:hover {
            background: var(--primary-light);
        }
        .nav-right i {
            color: var(--primary-mid);
            font-size: 1.2rem;
            margin-left: 1rem;
            cursor: pointer;
            transition: color 0.3s;
        }
        .nav-right i:hover {
            color: var(--primary-dark);
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 2rem;
        }
        .card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .card:hover {
            transform: translateY(-5px);
            border: 1px solid var(--primary-light);
            box-shadow: 0 8px 16px rgba(20, 184, 166, 0.1);
        }
        .card-icon {
            background: var(--bg-light);
            padding: 1rem;
            border-radius: 10px;
            font-size: 1.5rem;
            color: var(--primary-mid);
        }
        .stats {
            font-size: 1.8rem;
            color: var(--primary-dark);
            font-weight: 600;
            margin-top: 0.5rem;
        }
        .card h2 {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 500;
        }
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
        }
        .profile-dropdown {
            position: relative;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 120%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 200px;
            padding: 0.5rem;
            display: none;
        }
        
        .dropdown-menu.show {
            display: block;
        }
        
        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            color: var(--primary-dark);
            text-decoration: none;
            transition: background 0.3s;
            border-radius: 6px;
        }
        
        .dropdown-menu a:hover {
            background: var(--bg-light);
        }
        
        .welcome-card {
            background: var(--gradient);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin: 2rem 2rem 0 2rem;
        }
        
        .welcome-card h2 {
            font-size: 1.8rem;
            color: white;
            margin-bottom: 1rem;
        }
        
        .welcome-card p {
            opacity: 0.9;
            margin-bottom: 1.5rem;
        }
        
        .welcome-card .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: white;
            color: var(--primary-dark);
            border-radius: 6px;
            text-decoration: none;
            transition: transform 0.3s;
        }
        
        .welcome-card .btn:hover {
            transform: translateY(-2px);
        }
    </style>
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
