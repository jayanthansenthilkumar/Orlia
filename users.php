<?php
session_start();
include('db.php');
// Session Security
if (!isset($_SESSION['last_regen'])) {
    session_regenerate_id(true);
    $_SESSION['last_regen'] = time();
} elseif (time() - $_SESSION['last_regen'] > 300) {
    session_regenerate_id(true);
    $_SESSION['last_regen'] = time();
}
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: coordinator.php");
    exit();
}
$_SESSION['last_activity'] = time();

if (!isset($_SESSION['username'])) {
    header("Location: coordinator.php");
    exit();
}
$userid = $_SESSION['username'];
$groupEvents = [
    'Divideconquer',
    'Firelesscooking',
    'Trailertime',
    'Iplauction',
    'Lyricalhunt',
    'Dumpcharades',
    'Groupdance',
    'Rangoli',
    'Sherlockholmes',
    'Freefire',
    'Treasurehunt',
    'Artfromwaste',
    'Twindance',
    'Mime',
    'Vegetablefruitart',
];

if (in_array($userid, $groupEvents)) {
    $sql1 = "SELECT * FROM groupevents WHERE events='$userid'";
} else {
    $sql1 = "SELECT * FROM events WHERE events='$userid'";
}
$result1 = mysqli_query($conn, $sql1);

// Helper function for data export
function getEventData($conn, $userid, $groupEvents)
{
    if (in_array($userid, $groupEvents)) {
        $sql = "SELECT * FROM groupevents WHERE events='$userid' ORDER BY id";
        $result = mysqli_query($conn, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['tmembername']) {
                $members = json_decode($row['tmembername'], true);
                $membersList = array();
                foreach ($members as $member) {
                    $membersList[] = $member['name'] . ' / ' . $member['roll'];
                }
                $row['Team_Members'] = implode(', ', $membersList);
            }
            $row['phoneno'] = sprintf('%s', $row['phoneno']);
            $data[] = $row;
        }
    } else {
        $sql = "SELECT * FROM events WHERE events='$userid' ORDER BY id";
        $result = mysqli_query($conn, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $row['phoneno'] = sprintf('%s', $row['phoneno']);
            $data[] = $row;
        }
    }
    return $data;
}
$eventData = getEventData($conn, $userid, $groupEvents);
echo "<script>const eventData = " . json_encode($eventData) . ";</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants - Orlia</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/styles/admin.css">
    <style>
        div.dataTables_wrapper div.dataTables_filter input {
            border: 1px solid var(--border-subtle);
            border-radius: 4px;
            padding: 6px 12px;
        }

        @media (max-width: 992px) {
            #menuToggle {
                display: block !important;
            }
        }
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
                        <a href="dashboard.php" class="nav-link">
                            <i class="ri-dashboard-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="users.php" class="nav-link active">
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
                    <div class="page-title">Event Participants</div>
                </div>
                <div class="nav-actions">
                    <div class="theme-switch-wrapper" style="position: static; margin-right: 15px;">
                        <div class="theme-switch" id="theme-toggle" title="Toggle Theme"
                            style="background: var(--bg-hover); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-primary);">
                            <i class="ri-moon-line"></i>
                        </div>
                    </div>
                    <div class="profile-dropdown">
                        <div class="profile-trigger" id="profileTrigger">
                            <div class="avatar">
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
                    <div
                        style="padding: 20px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-subtle);">
                        <h3 class="card-title" style="margin: 0; font-size: 1.1rem; color: var(--text-primary);">
                            <?php echo $userid; ?> Participants List
                        </h3>
                        <button id="downloadExcel" class="btn btn-primary">
                            <i class="ri-file-excel-2-fill"></i> Download Report
                        </button>
                    </div>

                    <?php if (!in_array($userid, $groupEvents)) { ?>
                        <table id="usersTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Reg. Number</th>
                                    <th>Phone</th>
                                    <th>Dept</th>
                                    <th>Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $s = 1;
                                while ($row = mysqli_fetch_array($result1)) { ?>
                                    <tr>
                                        <td><?php echo $s++; ?></td>
                                        <td>
                                            <div style="font-weight: 500;"><?php echo $row['name']; ?></div>
                                            <div style="font-size: 0.85rem; color: var(--text-secondary);">
                                                <?php echo $row['mail']; ?></div>
                                        </td>
                                        <td><span
                                                style="font-family: monospace; background: var(--bg-hover); padding: 2px 6px; border-radius: 4px;"><?php echo $row['regno']; ?></span>
                                        </td>
                                        <td><?php echo $row['phoneno']; ?></td>
                                        <td><span class="badge"
                                                style="background: var(--bg-active); color: var(--google-blue); border: none; font-size: 0.8rem; position: relative; top: 0; right: 0; min-width: auto; height: auto; padding: 4px 8px;"><?php echo $row['dept']; ?></span>
                                        </td>
                                        <td><?php echo $row['year']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <table id="usersTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Team Name</th>
                                    <th>Leader</th>
                                    <th>Phone</th>
                                    <th>Members</th>
                                    <th>Dept</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $s = 1;
                                while ($row = mysqli_fetch_array($result1)) { ?>
                                    <tr>
                                        <td><?php echo $s++; ?></td>
                                        <td>
                                            <div style="font-weight: 500;"><?php echo $row['teamname']; ?></div>
                                            <div style="font-size: 0.85rem; color: var(--text-secondary);">
                                                <?php echo $row['temail']; ?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $row['teamleadname']; ?></div>
                                            <div
                                                style="font-family: monospace; font-size: 0.8rem; color: var(--text-secondary);">
                                                <?php echo $row['tregno']; ?></div>
                                        </td>
                                        <td><?php echo $row['phoneno']; ?></td>
                                        <td>
                                            <div style="max-height: 100px; overflow-y: auto;">
                                                <?php
                                                $teamMembers = json_decode($row['tmembername'], true);
                                                if (!empty($teamMembers)) {
                                                    echo '<ul style="padding-left: 15px; font-size: 0.85rem; margin: 0;">';
                                                    foreach ($teamMembers as $member) {
                                                        echo "<li>" . $member['name'] . " <span style='color: var(--text-secondary)'>(" . $member['roll'] . ")</span></li>";
                                                    }
                                                    echo '</ul>';
                                                } else {
                                                    echo "<span style='color: var(--text-hint);'>No members</span>";
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td><span class="badge"
                                                style="background: var(--bg-active); color: var(--google-blue); border: none; font-size: 0.8rem; position: relative; top: 0; right: 0; min-width: auto; height: auto; padding: 4px 8px;"><?php echo $row['dept']; ?></span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>

    <script src="assets/script/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        // Profile Dropdown
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

        $(document).ready(function () {
            $('#usersTable').DataTable({
                pageLength: 10,
                responsive: true,
                language: { search: "", searchPlaceholder: "Search participants..." },
                dom: '<"p-4"f>rt<"p-4"ip>'
            });

            // Excel Download (Preserved logic)
            $('#downloadExcel').click(function () {
                if (!eventData || eventData.length === 0) {
                    Swal.fire({ title: 'Info', text: 'No data to download', icon: 'info' });
                    return;
                }
                try {
                    let ws = XLSX.utils.json_to_sheet(eventData);
                    let wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, "Participants");
                    XLSX.writeFile(wb, "<?php echo $userid ?>_Participants.xlsx");
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Download failed.', 'error');
                }
            });
        });
    </script>
</body>

</html>