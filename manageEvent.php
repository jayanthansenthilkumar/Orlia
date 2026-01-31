<?php
include 'includes/auth.php';
checkUserAccess();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - Orlia'26</title>
    <link rel="icon" href="assets/images/agastya.png" type="image/png">
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="admin-body">
        <!-- Sidebar -->
        <?php
        $role = 'super';
        $page = 'events';
        include 'includes/sidebar.php';
        ?>

        <main class="admin-main">
            <header class="admin-header">
                <div class="header-left">
                    <div>
                        <span class="section-subtitle">Control</span>
                        <h1 class="admin-title">Manage Events</h1>
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

            <div class="table-container">
                <table id="eventsTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event Name</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Day</th>
                            <th>Registration Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db.php';
                        $query = "SELECT * FROM events";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $checked = $row['status'] == 1 ? 'checked' : '';
                            ?>
                            <tr>
                                <td>#EV
                                    <?= $row['id'] ?>
                                </td>
                                <td data-key="<?= $row['event_key'] ?>">
                                    <?= $row['event_name'] ?>
                                </td>
                                <td>
                                    <?= $row['event_category'] ?>
                                </td>
                                <td>
                                    <?= $row['event_type'] ?>
                                </td>
                                <td>
                                    <?= ucfirst($row['day']) ?>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="event-status-toggle" data-id="<?= $row['id'] ?>"
                                            <?= $checked ?>>
                                        <span class="slider"></span>
                                    </label>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="assets/script/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#eventsTable').DataTable({
                responsive: true
            });

            // Edit Event Click
            $(document).on('click', '.btn-edit', function () {
                const row = $(this).closest('tr');
                const eventId = row.find('.event-status-toggle').data('id');
                const eventName = row.find('td:eq(1)').text().trim();
                const eventCategory = row.find('td:eq(2)').text().trim();
                const eventType = row.find('td:eq(3)').text().trim();
                const eventDay = row.find('td:eq(4)').text().trim();

                Swal.fire({
                    title: `Edit ${eventName}`,
                    html: `
                        <input id="swal-evname" class="swal2-input" placeholder="Event Name" value="${eventName}">
                        <select id="swal-category" class="swal2-input">
                            <option value="Technical" ${eventCategory === 'Technical' ? 'selected' : ''}>Technical</option>
                            <option value="Non-Technical" ${eventCategory === 'Non-Technical' ? 'selected' : ''}>Non-Technical</option>
                        </select>
                        <select id="swal-type" class="swal2-input">
                            <option value="Solo" ${eventType === 'Solo' ? 'selected' : ''}>Solo</option>
                            <option value="Group" ${eventType === 'Group' ? 'selected' : ''}>Group</option>
                            <option value="Both" ${eventType === 'Both' ? 'selected' : ''}>Both</option>
                        </select>
                         <select id="swal-day" class="swal2-input">
                            <option value="day1" ${eventDay === 'day1' ? 'selected' : ''}>Day 1</option>
                            <option value="day2" ${eventDay === 'day2' ? 'selected' : ''}>Day 2</option>
                        </select>
                    `,
                    confirmButtonText: 'Update Event',
                    confirmButtonColor: '#134e4a',
                    showCancelButton: true,
                    preConfirm: () => {
                        return {
                            name: document.getElementById('swal-evname').value,
                            category: document.getElementById('swal-category').value,
                            type: document.getElementById('swal-type').value,
                            day: document.getElementById('swal-day').value
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'backend.php',
                            type: 'POST',
                            data: {
                                update_event_details: true,
                                id: eventId,
                                name: result.value.name,
                                category: result.value.category,
                                type: result.value.type,
                                day: result.value.day
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.status == 200) {
                                    Swal.fire('Updated!', response.message, 'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                }
                            },
                            error: function () {
                                Swal.fire('Error', 'Failed to communicate with server', 'error');
                            }
                        });
                    }
                });
            });

            // Toggle Switch Change
            $(document).on('change', '.event-status-toggle', function () {
                const isChecked = $(this).is(':checked');
                const row = $(this).closest('tr');
                const eventName = row.find('td:eq(1)').text();
                const eventId = $(this).data('id');
                const newStatus = isChecked ? 1 : 0;

                const statusText = isChecked ? 'Open' : 'Closed';

                $.ajax({
                    url: 'backend.php',
                    type: 'POST',
                    data: {
                        update_event_status: true,
                        id: eventId,
                        status: newStatus
                    },
                    success: function (response) {
                        try {
                            var res;
                            if (typeof response === 'string') {
                                try {
                                    res = JSON.parse(response);
                                } catch (e) { console.log(response); }
                            } else {
                                res = response;
                            }

                            if (res && res.status == 200) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
                                });

                                Toast.fire({
                                    icon: 'success',
                                    title: `${eventName}: ${statusText}`
                                });
                            } else {
                                Swal.fire('Error', res ? res.message : 'Unknown error', 'error');
                                // Revert switch
                                $(this).prop('checked', !isChecked);
                            }
                        } catch (e) {
                            console.error(e);
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Connection failed', 'error');
                        $(this).prop('checked', !isChecked);
                    }
                });
            });
        });
    </script>
</body>

</html>