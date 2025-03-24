<?php

session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: coordinator.php");
    exit();
}
$userid = $_SESSION['username'];
$sql = "SELECT * FROM login WHERE role IN (0, 1)";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orlia Super Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
    table.dataTable {
        width: 100%;
        margin: 30px 0;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .dataTables_wrapper {
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
    }

    table.dataTable thead th {
        padding: 15px 10px;
        background: #134e4a;
        /* Changed to match navbar color */
        color: white;
        /* Changed to white for better contrast */
        font-weight: 600;
        border-bottom: 2px solid #134e4a;
        /* Darker shade for border */
    }

    table.dataTable tbody td {
        padding: 12px 10px;
        border-bottom: 1px solid #eee;
    }

    table.dataTable tbody tr:hover {
        background-color: #f5f5f5;
    }
    </style>
</head>

<body>
    <aside class="sidebar">
        <h2>Orlia</h2>
        <ul class="sidebar-nav">
            <li><a href="superadmin.php"><i class="ri-dashboard-line"></i> Super Dashboard</a></li>
            <li><a href="admins.php" class="active"><i class="ri-admin-line"></i> Manage Admins</a></li>
            <li><a href="events.php"><i class="ri-calendar-event-line"></i> Events</a></li>
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
                        <span><?php echo $userid ?></span>
                    </div>
                    <div class="dropdown-menu">

                        <a href="logout.php"><i class="ri-logout-box-r-line"></i> Logout</a>
                    </div>
                </div>
            </div>
        </header>
        <table id="usersTable" class="display">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>userid</th>
                    <th>password</th>
                    

                </tr>
            </thead>
            <tbody>
                <?php
                $s = 1;
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                <tr>
                    <td><?php echo $s ?></td>
                    <td><?php echo $row['userid'] ?></td>
                    <td><?php echo $row['password'] ?></td>

                </tr>
                <?php
                    $s++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            pageLength: 10,
            responsive: true,
            order: [
                [0, 'asc']
            ],
            language: {
                search: "🔍 Search admins:",
                lengthMenu: "Display _MENU_ admins per page",
                info: "Showing _START_ to _END_ of _TOTAL_ admins",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next →",
                    previous: "← Previous"
                }
            }
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