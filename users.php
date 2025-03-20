<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orlia Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/admin.css">
</head>
<body>
    <aside class="sidebar">
        <h2><i class="ri-theatre-line"></i> Orlia</h2>
        <ul class="sidebar-nav">
            <li><a href="dashboard.php"><i class="ri-mic-2-line"></i> Dashboard</a></li>
            <li><a href="#" class="active"><i class="ri-group-2-line"></i> Participants</a></li>
        </ul>
    </aside>
    
    <div class="main-content">
        <header class="navbar">
            <h1>Event Participants</h1>
            <div class="nav-right">
                <div class="notification">
                    <i class="ri-music-2-line"></i>
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

        <main class="dashboard-grid">
            <div class="table-container">
                <table id="usersTable" class="display">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Register Number</th>
                            <th>Phone Number</th>
                            <th>Year & Department</th>
                            <th>Event Name</th>
                            <th>Event Day</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>2021CSE001</td>
                            <td>+91 9876543210</td>
                            <td>3rd Year CSE</td>
                            <td>Web Design</td>
                            <td>Day 1</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>2021ECE045</td>
                            <td>+91 9876543211</td>
                            <td>2nd Year ECE</td>
                            <td>Coding Challenge</td>
                            <td>Day 2</td>
                        </tr>
                        <tr>
                            <td>Alex Johnson</td>
                            <td>2021IT102</td>
                            <td>+91 9876543212</td>
                            <td>4th Year IT</td>
                            <td>Project Expo</td>
                            <td>Day 1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                pageLength: 10,
                responsive: true,
                order: [[0, 'asc']],
                language: {
                    search: "🔍 Search participants:",
                    lengthMenu: "Display _MENU_ participants per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ participants",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next →",
                        previous: "← Previous"
                    }
                },
                dom: '<"top"lf>rt<"bottom"ip><"clear">'
            });
        });
        
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
