<?php

session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: coordinator.php");
    exit();
}
$userid = $_SESSION['username'];
<<<<<<< HEAD
$sql="SELECT * FROM login WHERE role = 1 AND role = 0";
=======
$sql = "SELECT * FROM login WHERE role = 1";
>>>>>>> 0523f9df320fef0329513083d4a473511325503a
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
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/admin.css">
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
<<<<<<< HEAD
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>userid</th>
                                <th>password</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>


       
=======
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>User ID</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $s = 1;
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                <tr>
                    <td><?php echo $s; ?></td>
                    <td><?php echo $row['userid']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                </tr>
                <?php
                    $s++;
                }
                ?>
            </tbody>
        </table>
>>>>>>> 0523f9df320fef0329513083d4a473511325503a
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