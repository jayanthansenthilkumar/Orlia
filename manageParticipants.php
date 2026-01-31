<?php
include 'includes/auth.php';
checkUserAccess();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Participants - Orlia'26</title>
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
        $role = 'admin';
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

            <!-- Tabs -->
            <div class="admin-tabs">
                <button class="tab-btn active" onclick="openTab('solo')">Solo Events</button>
                <button class="tab-btn" onclick="openTab('group')">Group Events</button>
            </div>

            <!-- Solo Participants Section -->
            <div id="solo" class="tab-content active">
                <div class="filters-bar" style="margin-bottom: 20px;">
                    <label for="soloEventFilter" style="font-weight: 500; margin-right: 10px; color: var(--text-main);">Filter by Event:</label>
                    <select id="soloEventFilter" style="padding: 8px 12px; border-radius: 8px; border: 1px solid var(--border-glass); background: var(--bg-surface); color: var(--text-main); font-family: 'Outfit', sans-serif;">
                        <option value="">All Events</option>
                    </select>
                </div>
                <div class="table-container">
                    <table id="soloTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Roll Number</th>
                                <th>Dept</th>
                                <th>Year</th>
                                <th>Contact</th>
                                <th>Event</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'db.php';
                            $query = "SELECT * FROM soloevents";
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <tr>
                                        <td>#S<?= $row['id'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['regno'] ?></td>
                                        <td><?= $row['dept'] ?></td>
                                        <td><?= $row['year'] ?></td>
                                        <td>
                                            <div><?= $row['mail'] ?></div>
                                            <small><?= $row['phoneno'] ?></small>
                                        </td>
                                        <td><?= $row['events'] ?></td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Group Participants Section -->
            <div id="group" class="tab-content">
                <div class="filters-bar" style="margin-bottom: 20px;">
                    <label for="groupEventFilter" style="font-weight: 500; margin-right: 10px; color: var(--text-main);">Filter by Event:</label>
                    <select id="groupEventFilter" style="padding: 8px 12px; border-radius: 8px; border: 1px solid var(--border-glass); background: var(--bg-surface); color: var(--text-main); font-family: 'Outfit', sans-serif;">
                        <option value="">All Events</option>
                    </select>
                </div>
                <div class="table-container">
                    <table id="groupTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Team Name</th>
                                <th>Leader Name</th>
                                <th>Leader Roll No</th>
                                <th>Members</th>
                                <th>Event</th>
                                <th>Leader Contact</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM groupevents";
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    // Calculate member count
                                    $members = json_decode($row['tmembername'], true);
                                    $count = is_array($members) ? count($members) : 0;
                                    ?>
                                    <tr>
                                        <td>#G<?= $row['id'] ?></td>
                                        <td><?= $row['teamname'] ?></td>
                                        <td><?= $row['teamleadname'] ?></td>
                                        <td><?= $row['tregno'] ?></td>
                                        <td><?= $count ?></td>
                                        <td><?= $row['events'] ?></td>
                                        <td>
                                            <div><?= $row['temail'] ?></div>
                                            <small><?= $row['phoneno'] ?></small>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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
            // Initialize DataTables with Buttons
            var soloTable = $('#soloTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            var groupTable = $('#groupTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            // --- Populate Event Filters ---

            // Solo Table Filter (Column index 6 is Event)
            var uniqueSoloEvents = soloTable.column(6).data().unique().sort();
            uniqueSoloEvents.each(function (val) {
                if (val) {
                    $('#soloEventFilter').append('<option value="' + val + '">' + val + '</option>');
                }
            });

            // Group Table Filter (Column index 5 is Event)
            var uniqueGroupEvents = groupTable.column(5).data().unique().sort();
            uniqueGroupEvents.each(function (val) {
                if (val) {
                    $('#groupEventFilter').append('<option value="' + val + '">' + val + '</option>');
                }
            });

            // Filter Change Listeners
            $('#soloEventFilter').on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                soloTable.column(6).search(val ? '^' + val + '$' : '', true, false).draw();
            });

            $('#groupEventFilter').on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                groupTable.column(5).search(val ? '^' + val + '$' : '', true, false).draw();
            });


            // Adjust columns on tab switch
            window.openTab = function (tabName) {
                // Hide all tab content
                $('.tab-content').removeClass('active');
                $('.tab-btn').removeClass('active');

                // Show current tab
                $('#' + tabName).addClass('active');

                // Set active button
                $(`button[onclick="openTab('${tabName}')"]`).addClass('active');

                // Recalculate DataTable dimensions
                if (tabName === 'solo') {
                    soloTable.columns.adjust().responsive.recalc();
                } else {
                    groupTable.columns.adjust().responsive.recalc();
                }
            }

            // Delete Participant
            $(document).on('click', '.btn-delete', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Participant has been removed.',
                            'success'
                        );
                    }
                });
            });

            // Edit Participant
            $(document).on('click', '.btn-edit', function () {
                Swal.fire('Info', 'Edit functionality to be implemented', 'info');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>