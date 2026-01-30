<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overall Participants - Orlia'26</title>
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
        $role = 'super';
        $page = 'participants';
        include 'includes/sidebar.php';
        ?>

        <main class="admin-main">
            <header class="admin-header">
                <div class="header-left">
                    <div>
                        <span class="section-subtitle">Data Overview</span>
                        <h1 class="admin-title">Overall Participants</h1>
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

            <!-- Tabs -->
            <div class="admin-tabs">
                <button class="tab-btn active" onclick="openTab('solo')">Solo Events</button>
                <button class="tab-btn" onclick="openTab('group')">Group Events</button>
            </div>

            <!-- Solo Participants Section -->
            <div id="solo" class="tab-content active">
                <h2 class="mb-3" style="font-family: 'Space Grotesk'; color: var(--text-main);">Solo Event Participants
                </h2>
                <div class="table-container">
                    <table id="soloTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Roll No</th>
                                <th>Dept</th>
                                <th>Year</th>
                                <th>Event</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>S-001</td>
                                <td>Alice Tech</td>
                                <td>21IT001</td>
                                <td>IT</td>
                                <td>IV</td>
                                <td>Code Debugging</td>
                                <td>9988776655</td>
                            </tr>
                            <tr>
                                <td>S-002</td>
                                <td>Bob Mech</td>
                                <td>22MECH055</td>
                                <td>Mech</td>
                                <td>III</td>
                                <td>Water Rocketry</td>
                                <td>8877665544</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Group Participants Section -->
            <div id="group" class="tab-content">
                <h2 class="mb-3" style="font-family: 'Space Grotesk'; color: var(--text-main);">Group Event Participants
                </h2>
                <div class="table-container">
                    <table id="groupTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Team ID</th>
                                <th>Team Name</th>
                                <th>Leader Name</th>
                                <th>Leader Roll No</th>
                                <th>Members Count</th>
                                <th>Event</th>
                                <th>Leader Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>G-001</td>
                                <td>Tech Titans</td>
                                <td>Charlie CSE</td>
                                <td>21CSE100</td>
                                <td>4</td>
                                <td>Hackathon</td>
                                <td>7766554433</td>
                            </tr>
                            <tr>
                                <td>G-002</td>
                                <td>Robo Rockers</td>
                                <td>David EEE</td>
                                <td>22EEE030</td>
                                <td>3</td>
                                <td>Robo Wars</td>
                                <td>6655443322</td>
                            </tr>
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

            // Adjust columns on tab switch because hidden tables miscalculate width
            window.openTab = function (tabName) {
                // Hide all tab content
                $('.tab-content').removeClass('active');
                $('.tab-btn').removeClass('active');

                // Show current tab
                $('#' + tabName).addClass('active');

                // Set active button
                // Find button with onclick="openTab('tabName')" - simple approach
                $(`button[onclick="openTab('${tabName}')"]`).addClass('active');

                // Recalculate DataTable dimensions
                if (tabName === 'solo') {
                    soloTable.columns.adjust().responsive.recalc();
                } else {
                    groupTable.columns.adjust().responsive.recalc();
                }
            }
        });
    </script>
</body>

</html>