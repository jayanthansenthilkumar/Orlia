<?php
include 'includes/auth.php';
checkUserAccess();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Participants - Orlia'26</title>
    <link rel="icon" href="assets/images/agastya.png" type="image/png">
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
</head>

<body>
    <div class="admin-body">
        <!-- Sidebar -->
        <?php
        $role = 'event';
        $page = 'participants';
        include 'includes/sidebar.php';
        ?>

        <main class="admin-main">
            <header class="admin-header">
                <div class="header-left">
                    <div>
                        <span class="section-subtitle">Management</span>
                        <h1 class="admin-title">Participants</h1>
                    </div>
                </div>
                <div class="header-right">
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
                                <li><a href="index.php" class="text-danger"><i class="ri-logout-box-line"></i>
                                        Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <?php
            include 'db.php';
            $eventKey = $_SESSION['userid'];

            // Fetch Event Name
            $event_name_query = "SELECT event_name FROM events WHERE event_key='$eventKey'";
            $event_name_run = mysqli_query($conn, $event_name_query);
            $event_name = "Unknown Event";
            if ($event_name_run && mysqli_num_rows($event_name_run) > 0) {
                $event_row = mysqli_fetch_assoc($event_name_run);
                $event_name = $event_row['event_name'];
            }

            // Fetch Participants
            $rows = [];

            // Solo
            $solo_q = "SELECT * FROM soloevents WHERE events='$eventKey'";
            $solo_r = mysqli_query($conn, $solo_q);
            if ($solo_r) {
                while ($item = mysqli_fetch_assoc($solo_r)) {
                    $rows[] = [
                        'id' => 'S' . $item['id'],
                        'name' => $item['name'],
                        'roll' => $item['regno'],
                        'year' => $item['year'],
                        'dept' => $item['dept'],
                        'contact' => $item['phoneno'],
                        'type' => 'Solo'
                    ];
                }
            }

            // Group
            $group_q = "SELECT * FROM groupevents WHERE events='$eventKey'";
            $group_r = mysqli_query($conn, $group_q);
            if ($group_r) {
                while ($item = mysqli_fetch_assoc($group_r)) {
                    $rows[] = [
                        'id' => 'G' . $item['id'],
                        'name' => $item['teamname'],
                        'roll' => $item['tregno'], // Leader Roll
                        'year' => $item['year'],
                        'dept' => $item['dept'],
                        'contact' => $item['phoneno'], // Leader Contact
                        'type' => 'Group'
                    ];
                }
            }
            ?>

            <!-- Event Title dynamically leads here -->
            <div class="mb-4">
                <h2 style="font-family: 'Space Grotesk'; color: var(--text-main);">Event: <span
                        style="color: var(--primary-main);"><?= htmlspecialchars($event_name) ?></span></h2>
            </div>

            <div class="filters-bar" style="margin-bottom: 20px;">
                <label for="typeFilter" style="font-weight: 500; margin-right: 10px; color: var(--text-main);">Filter by Type:</label>
                <select id="typeFilter" style="padding: 8px 12px; border-radius: 8px; border: 1px solid var(--border-glass); background: var(--bg-surface); color: var(--text-main); font-family: 'Outfit', sans-serif;">
                    <option value="">All Types</option>
                </select>
            </div>

            <div class="table-container">
                <table id="eventTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name / Team</th>
                            <th>Roll Number</th> <!-- Or Leader Roll No -->
                            <th>Dept</th>
                            <th>Year</th>
                            <th>Contact</th> <!-- Or Leader Contact -->
                            <th>Type</th> <!-- Solo/Group -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <td>#<?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['roll'] ?></td>
                                <td><?= $row['dept'] ?></td>
                                <td><?= $row['year'] ?></td>
                                <td><?= $row['contact'] ?></td>
                                <td><span class="status-badge status-active"><?= $row['type'] ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="assets/script/script.js"></script>
    <script>
        $(document).ready(function () {
            var eventTable = $('#eventTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            // Populate Type Filter (Column index 6 is Type: Solo/Group)
            var uniqueTypes = eventTable.column(6).data().unique().sort();
            uniqueTypes.each(function (val) {
                // val contains HTML like <span class="status-badge">Solo</span>, we need text content
                var textVal = $(val).text().trim(); // Or simplistic regex if it's just text.
                // Actually the data() returns the original content including HTML.
                // Let's assume the render or content is simple.
                // Better approach: Use a regex to extract text or just text()
                var div = document.createElement("div");
                div.innerHTML = val;
                var cleanVal = div.textContent || div.innerText || "";

                if (cleanVal) {
                    // Check if option exists to avoid duplicates if HTML varies slightly
                    if ($('#typeFilter option[value="' + cleanVal + '"]').length === 0) {
                        $('#typeFilter').append('<option value="' + cleanVal + '">' + cleanVal + '</option>');
                    }
                }
            });

            $('#typeFilter').on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                eventTable.column(6).search(val ? val : '', true, false).draw();
            });
        });
    </script>
</body>

</html>