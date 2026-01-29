<?php
session_start();
include('db.php');
if (!isset($_SESSION['username'])) {
    header("Location: coordinator.php");
    exit();
}

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

$userid = $_SESSION['username'];
$sql1 = "SELECT * FROM events";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM groupevents";
$result2 = mysqli_query($conn, $sql2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events - Orlia</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <style>
        .event-tabs {
            display: flex;
            gap: 24px;
            border-bottom: 1px solid var(--border-subtle);
            margin-bottom: 24px;
        }

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

        .tab-button:hover {
            color: var(--google-blue);
        }

        .tab-button.active {
            color: var(--google-blue);
            border-bottom-color: var(--google-blue);
        }

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
                        <a href="superadmin.php" class="nav-link">
                            <i class="ri-dashboard-line"></i>
                            <span>Super Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admins.php" class="nav-link">
                            <i class="ri-admin-line"></i>
                            <span>Manage Admins</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="events.php" class="nav-link active">
                            <i class="ri-calendar-event-line"></i>
                            <span>Events</span>
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
                    <div class="page-title">Global Event List</div>
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
                            <div class="avatar" style="background: var(--google-red);">
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
                            <button class="tab-button" data-target="controlPanel">Event Control</button>
                        </nav>
                    </div>

                    <div style="padding: 0 24px 24px 24px;">
                        <div id="soloTableDiv">
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
                                    <?php $s = 1;
                                    while ($row = mysqli_fetch_array($result1)) { ?>
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

                        <div id="groupTableDiv" style="display: none;">
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
                                    <?php $s = 1;
                                    while ($row = mysqli_fetch_array($result2)) { ?>
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
                                                    } else {
                                                        echo "<span style='color: var(--text-hint);'>No members</span>";
                                                    }
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

                        <div id="controlPanelDiv" style="display: none;">
                            <table class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Event Name</th>
                                        <th>Current Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $status_sql = "SELECT * FROM event_status";
                                    $status_result = mysqli_query($conn, $status_sql);
                                    while ($status_row = mysqli_fetch_array($status_result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $status_row['event_name']; ?></td>
                                            <td>
                                                <span
                                                    class="badge <?php echo $status_row['status'] == 'open' ? 'bg-success' : 'bg-danger'; ?>">
                                                    <?php echo strtoupper($status_row['status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary toggle-status-btn"
                                                    data-id="<?php echo $status_row['id']; ?>"
                                                    data-status="<?php echo $status_row['status']; ?>">
                                                    <?php echo $status_row['status'] == 'open' ? 'Stop Registration' : 'Start Registration'; ?>
                                                </button>
                                            </td>
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

    <script src="assets/script/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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

        $(document).ready(function () {
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

            $('.tab-button').click(function () {
                var targetTable = $(this).data('target');
                $('.tab-button').removeClass('active');
                $(this).addClass('active');
                $('#soloTableDiv, #groupTableDiv, #controlPanelDiv').hide();

                if (targetTable === 'soloTable') {
                    $('#soloTableDiv').show();
                    soloTable.columns.adjust();
                } else if (targetTable === 'groupTable') {
                    $('#groupTableDiv').show();
                    groupTable.columns.adjust();
                } else {
                    $('#controlPanelDiv').show();
                }
            });

            // Toggle Status Interaction
            $('.toggle-status-btn').click(function () {
                var btn = $(this);
                var id = btn.data('id');
                var currentStatus = btn.data('status');
                var newStatus = currentStatus === 'open' ? 'closed' : 'open';
                var actionText = newStatus === 'open' ? 'Start' : 'Stop';

                if (confirm('Are you sure you want to ' + actionText + ' registrations for this event?')) {
                    $.ajax({
                        url: 'backend.php',
                        type: 'POST',
                        data: {
                            toggle_event_status: true,
                            event_id: id,
                            new_status: newStatus
                        },
                        success: function (response) {
                            if (response.status === 200) {
                                alert(response.message);
                                location.reload();
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function () {
                            alert('An error occurred while processing your request.');
                        }
                    });
                }
            });
        });
        });
    </script>
</body>

</html>