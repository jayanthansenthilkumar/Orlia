<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins - Orlia'26</title>
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] != '2') {
            header("Location: index.php");
            exit();
        }

        $role = 'super';
        $page = 'admins';
        include 'includes/sidebar.php';
        ?>

        <main class="admin-main">
            <header class="admin-header">
                <div class="header-left">
                    <div>
                        <span class="section-subtitle">Security</span>
                        <h1 class="admin-title">Manage Admins</h1>
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
                                <li><a href="logout.php" class="text-danger"><i class="ri-logout-box-line"></i>
                                        Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <div class="mb-4 text-right" style="text-align: right; margin-bottom: 20px;">
                <button class="hero-btn" style="padding: 10px 24px; font-size: 0.9rem;">
                    <i class="ri-add-line"></i> Add New Admin
                </button>
            </div>

            <div class="table-container">
                <table id="adminsTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db.php';
                        $query = "SELECT * FROM users";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                <tr>
                                    <td>#AD<?= $row['id'] ?></td>
                                    <td><?= $row['userid'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['role'] == '2') {
                                            echo "Super Admin";
                                        } elseif ($row['role'] == '1') {
                                            echo "Event Admin";
                                        } else {
                                            echo "Co-Admin";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button class="action-btn btn-edit" data-id="<?= $row['id'] ?>"><i
                                                class="ri-pencil-line"></i></button>
                                        <button class="action-btn btn-delete" data-id="<?= $row['id'] ?>"><i
                                                class="ri-delete-bin-line"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="assets/script/script.js"></script>
    <script>
        $(document).ready(function () {
            $('#adminsTable').DataTable({
                responsive: true
            });

            const swalStyles = `
                <style>
                    .swal-custom-input {
                        width: 80% !important;
                        margin: 10px auto !important;
                        padding: 12px !important;
                        border: 1px solid #ddd !important;
                        border-radius: 8px !important;
                        font-family: 'Outfit', sans-serif !important;
                        font-size: 1rem !important;
                        display: block !important;
                    }
                    .swal-custom-select {
                        width: 80% !important;
                        margin: 10px auto !important;
                        padding: 12px !important;
                        border: 1px solid #ddd !important;
                        border-radius: 8px !important;
                        font-family: 'Outfit', sans-serif !important;
                        font-size: 1rem !important;
                        background: white !important;
                        display: block !important;
                    }
                    .swal-custom-label {
                        text-align: left !important;
                        width: 80% !important;
                        margin: 0 auto 5px !important;
                        display: block !important;
                        font-weight: 500 !important;
                        color: #555 !important;
                    }
                </style>
            `;
            $('head').append(swalStyles);

            // Add Admin Button Click
            $('.hero-btn').click(function () {
                Swal.fire({
                    title: 'Add New Admin',
                    html: `
                        <div style="text-align: left; margin-bottom: 5px; width: 80%; margin: 0 auto;">
                            <label class="swal-custom-label">Username</label>
                            <input id="swal-userid" class="swal-custom-input" placeholder="Enter Username">
                            
                            <label class="swal-custom-label">Password</label>
                            <input id="swal-password" type="password" class="swal-custom-input" placeholder="Enter Password">
                            
                            <label class="swal-custom-label">Role</label>
                            <select id="swal-role" class="swal-custom-select">
                                <option value="0">Co-Admin</option>
                                <option value="1">Event Admin</option>
                                <option value="2">Super Admin</option>
                            </select>
                        </div>
                    `,
                    confirmButtonText: 'Add Admin',
                    confirmButtonColor: '#134e4a',
                    showCancelButton: true,
                    focusConfirm: false,
                    preConfirm: () => {
                        const userid = document.getElementById('swal-userid').value;
                        const password = document.getElementById('swal-password').value;
                        const role = document.getElementById('swal-role').value;
                        if (!userid || !password) {
                            Swal.showValidationMessage('Please enter username and password');
                        }
                        return { userid: userid, password: password, role: role };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: 'backend.php',
                            data: {
                                Addadmins: true,
                                userid: result.value.userid,
                                password: result.value.password,
                                role: result.value.role
                            },
                            success: function (response) {
                                try {
                                    var res = JSON.parse(response);
                                    if (res.status == 200) {
                                        Swal.fire('Success', res.message, 'success').then(() => location.reload());
                                    } else {
                                        Swal.fire('Error', res.message, 'error');
                                    }
                                } catch (e) {
                                    Swal.fire('Error', 'Invalid response from server', 'error');
                                }
                            }
                        });
                    }
                });
            });

            // Delete Admin Click
            $(document).on('click', '.btn-delete', function () {
                const id = $(this).data('id');
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
                        $.ajax({
                            type: 'POST',
                            url: 'backend.php',
                            data: { delete_user: true, userid: id },
                            success: function (response) {
                                try {
                                    var res = JSON.parse(response);
                                    if (res.status == 200) {
                                        Swal.fire('Deleted!', res.message, 'success').then(() => location.reload());
                                    } else {
                                        Swal.fire('Error', res.message, 'error');
                                    }
                                } catch (e) {
                                    Swal.fire('Error', 'Invalid server response', 'error');
                                }
                            }
                        });
                    }
                });
            });

            // Edit Admin Click
            $(document).on('click', '.btn-edit', function () {
                const id = $(this).data('id');
                // Fetch user data first
                $.ajax({
                    type: 'POST',
                    url: 'backend.php',
                    data: { edit_user: true, user_id: id },
                    success: function (response) {
                        try {
                            const res = JSON.parse(response);
                            if (res.status == 200) {
                                const data = res.data;
                                Swal.fire({
                                    title: 'Edit Admin',
                                    html: `
                                        <div style="text-align: left; margin-bottom: 5px; width: 80%; margin: 0 auto;">
                                            <input type="hidden" id="edit-id" value="${data.id}">
                                            
                                            <label class="swal-custom-label">Username</label>
                                            <input id="edit-userid" class="swal-custom-input" value="${data.userid}" placeholder="Username">
                                            
                                            <label class="swal-custom-label">Password</label>
                                            <input id="edit-password" type="text" class="swal-custom-input" value="${data.password}" placeholder="Password">
                                            
                                            <label class="swal-custom-label">Role</label>
                                            <select id="edit-role" class="swal-custom-select">
                                                <option value="0" ${data.role == 0 ? 'selected' : ''}>Co-Admin</option>
                                                <option value="1" ${data.role == 1 ? 'selected' : ''}>Event Admin</option>
                                                <option value="2" ${data.role == 2 ? 'selected' : ''}>Super Admin</option>
                                            </select>
                                        </div>
                                    `,
                                    confirmButtonText: 'Update Details',
                                    confirmButtonColor: '#134e4a',
                                    showCancelButton: true,
                                    preConfirm: () => {
                                        return {
                                            id: document.getElementById('edit-id').value,
                                            userid: document.getElementById('edit-userid').value,
                                            password: document.getElementById('edit-password').value,
                                            role: document.getElementById('edit-role').value
                                        };
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            type: 'POST',
                                            url: 'backend.php',
                                            data: {
                                                save_edituser: true,
                                                id: result.value.id,
                                                userid: result.value.userid,
                                                password: result.value.password,
                                                role: result.value.role
                                            },
                                            success: function (saveResp) {
                                                const saveRes = JSON.parse(saveResp);
                                                if (saveRes.status == 200) {
                                                    Swal.fire('Updated!', saveRes.message, 'success').then(() => location.reload());
                                                } else {
                                                    Swal.fire('Error', saveRes.message, 'error');
                                                }
                                            }
                                        });
                                    }
                                });
                            } else {
                                Swal.fire('Error', 'Could not fetch user details', 'error');
                            }
                        } catch (e) {
                            console.error(e);
                            Swal.fire('Error', 'Invalid server response', 'error');
                        }
                    }
                });
            });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>