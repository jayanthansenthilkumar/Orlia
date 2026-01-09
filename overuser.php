<?php
session_start();
include('db.php');
if (!isset($_SESSION['username'])) {
    header("Location: coordinator.php");
    exit();
}
$userid = $_SESSION['username'];
$sql1 = "SELECT * FROM events";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM groupevents";
$result2 = mysqli_query($conn, $sql2);

function getSoloEventsData($conn) {
    $sql = "SELECT name, regno, mail, phoneno, year, dept, events, day FROM events ORDER BY id";
    $result = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
    return json_encode($data);
}
function getGroupEventsData($conn) {
    $sql = "SELECT teamname, teamleadname, tregno, temail, phoneno, tmembername, year, dept, events, day FROM groupevents ORDER BY id";
    $result = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
    return json_encode($data);
}
echo "<script>const soloEventsData = " . getSoloEventsData($conn) . ";</script>";
echo "<script>const groupEventsData = " . getGroupEventsData($conn) . ";</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants - Orlia</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <style>
        .event-tabs { display: flex; gap: 24px; border-bottom: 1px solid var(--border-subtle); margin-bottom: 24px; }
        .tab-button {
            padding: 12px 16px;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
        }
        .tab-button:hover { color: var(--google-blue); }
        .tab-button.active { color: var(--google-blue); border-bottom-color: var(--google-blue); }
        div.dataTables_wrapper div.dataTables_filter input { border: 1px solid var(--border-subtle); border-radius: 4px; padding: 6px 12px; }
        @media (max-width: 992px) { #menuToggle { display: block !important; } }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">
                    <i class="ri-google-fill"></i> Orlia Admin
                </div>
            </div>
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="overdashboard.php" class="nav-link">
                            <i class="ri-dashboard-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="ri-group-line"></i>
                            <span>Participants</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="navbar">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <button class="icon-btn" id="menuToggle" style="display: none;">
                        <i class="ri-menu-line"></i>
                    </button>
                    <div class="page-title">All Event Participants</div>
                </div>
                <div class="nav-actions">
                    <div class="profile-dropdown">
                        <div class="profile-trigger" id="profileTrigger">
                            <div class="avatar" style="background: var(--google-yellow); color: #333;">
                                <?php echo strtoupper(substr($userid, 0, 1)); ?>
                            </div>
                            <span class="d-none d-md-block"><?php echo $userid; ?></span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="logout.php" class="dropdown-item">
                                <i class="ri-logout-box-r-line"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <div class="card table-card">
                    <div style="padding: 24px 24px 0 24px;">
                        <nav class="event-tabs">
                            <button class="tab-button active" data-target="soloTable">Solo Events</button>
                            <button class="tab-button" data-target="groupTable">Group Events</button>
                        </nav>
                    </div>

                    <div style="padding: 0 24px 24px 24px;">
                        <!-- Solo Events Section -->
                        <div id="soloTableDiv">
                            <div style="display: flex; justify-content: flex-end; margin-bottom: 16px;">
                                <button id="downloadSoloExcel" class="btn btn-outline">
                                    <i class="ri-file-excel-2-line" style="color: #107c41;"></i> Export Solo Data
                                </button>
                            </div>
                            <table id="soloTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Reg. No</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Year</th>
                                        <th>Dept</th>
                                        <th>Event</th>
                                        <th>Day</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $s = 1; while ($row = mysqli_fetch_array($result1)) { ?>
                                        <tr>
                                            <td><?php echo $s++; ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['regno'] ?></td>
                                            <td><?php echo $row['mail'] ?></td>
                                            <td><?php echo $row['phoneno'] ?></td>
                                            <td><?php echo $row['year'] ?></td>
                                            <td><?php echo $row['dept'] ?></td>
                                            <td><?php echo $row['events'] ?></td>
                                            <td><?php echo $row['day'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Group Events Section -->
                        <div id="groupTableDiv" style="display: none;">
                            <div style="display: flex; justify-content: flex-end; margin-bottom: 16px;">
                                <button id="downloadGroupExcel" class="btn btn-outline">
                                    <i class="ri-file-excel-2-line" style="color: #107c41;"></i> Export Group Data
                                </button>
                            </div>
                            <table id="groupTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Team Name</th>
                                        <th>Leader (Name/Reg)</th>
                                        <th>Contact (Email/Ph)</th>
                                        <th>Members</th>
                                        <th>Year</th>
                                        <th>Dept</th>
                                        <th>Event</th>
                                        <th>Day</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $s = 1; while ($row = mysqli_fetch_array($result2)) { ?>
                                        <tr>
                                            <td><?php echo $s++; ?></td>
                                            <td><?php echo $row['teamname'] ?></td>
                                            <td><?php echo $row['teamleadname'] . ' / ' . $row['tregno'] ?></td>
                                            <td><?php echo $row['temail'] . ' / ' . $row['phoneno'] ?></td>
                                            <td>
                                                <div style="max-height: 100px; overflow-y: auto;">
                                                <?php
                                                $teamMembers = json_decode($row['tmembername'], true);
                                                if (!empty($teamMembers)) {
                                                    echo '<ul style="padding-left: 15px; margin: 0; font-size: 0.85rem;">';
                                                    foreach ($teamMembers as $member) {
                                                        echo "<li>" . $member['name'] . " (" . $member['roll'] . ")</li>";
                                                    }
                                                    echo '</ul>';
                                                } else { echo "<span style='color: #999;'>No members</span>"; }
                                                ?>
                                                </div>
                                            </td>
                                            <td><?php echo $row['year'] ?></td>
                                            <td><?php echo $row['dept'] ?></td>
                                            <td><?php echo $row['events'] ?></td>
                                            <td><?php echo $row['day'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        const profileTrigger = document.getElementById('profileTrigger');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });

            document.addEventListener('click', (e) => {
                if (window.innerWidth <= 992 && !sidebar.contains(e.target) && !menuToggle.contains(e.target) && sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                }
            });
        }

        profileTrigger.addEventListener('click', (e) => { e.stopPropagation(); dropdownMenu.classList.toggle('show'); });
        document.addEventListener('click', (e) => { if (!profileTrigger.contains(e.target)) dropdownMenu.classList.remove('show'); });

        $(document).ready(function() {
            const soloTable = $('#soloTable').DataTable({
                pageLength: 10,
                responsive: true,
                language: { search: "", searchPlaceholder: "Search solo events..." },
                dom: '<"p-4"f>rt<"p-4"ip>'
            });
            const groupTable = $('#groupTable').DataTable({
                pageLength: 10,
                responsive: true,
                language: { search: "", searchPlaceholder: "Search group events..." },
                dom: '<"p-4"f>rt<"p-4"ip>'
            });

            $('.tab-button').click(function() {
                var targetTable = $(this).data('target');
                $('.tab-button').removeClass('active');
                $(this).addClass('active');
                $('#soloTableDiv, #groupTableDiv').hide();
                
                if (targetTable === 'soloTable') {
                    $('#soloTableDiv').show();
                    soloTable.columns.adjust();
                } else {
                    $('#groupTableDiv').show();
                    groupTable.columns.adjust();
                }
            });

            // Excel download handlers - Preserved Logic
            $('#downloadSoloExcel').click(function() {
                let ws = XLSX.utils.json_to_sheet(soloEventsData);
                let wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "Solo Events");
                XLSX.writeFile(wb, "Solo_Events_" + new Date().toISOString().slice(0, 10) + ".xlsx");
            });

            $('#downloadGroupExcel').click(function() {
                const processedData = groupEventsData.map(row => {
                    let teamMembers = '';
                    if (row.tmembername) {
                        const members = JSON.parse(row.tmembername);
                        teamMembers = members.map(m => `${m.name} / ${m.roll}`).join(', ');
                    }
                    return { ...row, tmembername: teamMembers };
                });
                let ws = XLSX.utils.json_to_sheet(processedData);
                let wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "Group Events");
                XLSX.writeFile(wb, "Group_Events_" + new Date().toISOString().slice(0, 10) + ".xlsx");
            });
        });
    </script>
</body>
</html>