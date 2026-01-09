<?php
session_start();
include('db.php');  
// Session Security: Prevent Session Fixation and enforce Timeout
if (!isset($_SESSION['last_regen'])) {
    session_regenerate_id(true);
    $_SESSION['last_regen'] = time();
} elseif (time() - $_SESSION['last_regen'] > 300) { // Regenerate every 5 mins
    session_regenerate_id(true);
    $_SESSION['last_regen'] = time();
}

// Session Timeout (30 minutes)
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
$sql = "SELECT * FROM login WHERE role IN (0, 1)";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins - Orlia</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/styles/admin.css">
    <style>
        /* Bootstrap Overlay Fixes for Google Theme */
        div.dataTables_wrapper div.dataTables_filter input { border: 1px solid var(--border-subtle); border-radius: 4px; padding: 6px 12px; }
        /* Mobile Toggle Visibility handled via JS/admin.css */
        @media (max-width: 992px) {
            #menuToggle { display: block !important; }
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
                        <a href="admins.php" class="nav-link active">
                            <i class="ri-admin-line"></i>
                            <span>Manage Admins</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="events.php" class="nav-link">
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
                    <div class="page-title">Admin Management</div>
                </div>
                <div class="nav-actions">
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
                    <div style="padding: 20px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-subtle);">
                        <h3 class="card-title" style="margin: 0; font-size: 1.1rem; color: var(--text-primary);">Admins List</h3>
                        <div style="display: flex; gap: 10px;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addmodal">
                                <i class="ri-add-line"></i> Add New User
                            </button>
                            <button id="downloadExcel" class="btn btn-outline" style="border: 1px solid var(--border-subtle);">
                                <i class="ri-file-excel-2-line"></i> Export
                            </button>
                        </div>
                    </div>
                    
                    <table id="usersTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>User ID</th>
                                <th>Password</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $s = 1;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $s ?></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <div class="avatar" style="width: 28px; height: 28px; font-size: 0.8rem; background: var(--bg-body); color: var(--text-secondary);">
                                                <?php echo strtoupper(substr($row['userid'], 0, 1)); ?>
                                            </div>
                                            <?php echo $row['userid'] ?>
                                        </div>
                                    </td>
                                    <td><span style="font-family: monospace; background: var(--bg-hover); padding: 2px 6px; border-radius: 4px;"><?php echo $row['password'] ?></span></td>
                                    <td>
                                        <div class="action-btns">
                                            <button type="button" class="btn btn-sm btn-warning btnedit" value="<?php echo $row['id']; ?>">
                                                <i class="ri-edit-line"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger btndelete" value="<?php echo $row['id']; ?>">
                                                <i class="ri-delete-bin-line"></i> Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $s++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="Adduser">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">User ID</label>
                            <input type="text" name="userid" class="form-control" placeholder="Enter username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" name="password" class="form-control" placeholder="Enter password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-control" required>
                                <option value="0">Admin</option>
                                <option value="1">Super Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="Editusers" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="Editnewuser">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" required>
                        <div class="mb-3">
                            <label class="form-label">User ID</label>
                            <input type="text" id="Userid" name="userid" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" id="Password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" id="Role" name="role" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        // Profile Dropdown Logic
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
            $('#usersTable').DataTable({
                pageLength: 10,
                responsive: true,
                language: { search: "", searchPlaceholder: "Search users..." },
                dom: '<"p-4"f>rt<"p-4"ip>'
            });

            // Ajax Handlers (Same as original, preserved for functionality)
            $(document).on('submit', '#Adduser', function(e) {
                e.preventDefault();
                var Formdata = new FormData(this);
                Formdata.append("Addadmins", true);
                $.ajax({
                    url: "backend.php", method: "POST", data: Formdata, processData: false, contentType: false,
                    success: function(response) {
                        try {
                            var res = typeof response === 'object' ? response : jQuery.parseJSON(response);
                        } catch(e) { console.error("JSON Error", e); return; }
                        
                        if (res.status == 200) { 
                             Swal.fire({
                                title: 'Success!',
                                text: res.message,
                                icon: 'success'
                            }).then(() => { location.reload(); });
                        } else { 
                            Swal.fire('Error!', res.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong', 'error');
                    }
                });
            });

            $(document).on('click', '.btndelete', function(e) {
                e.preventDefault();
                var id = $(this).val();
                
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
                            url: "backend.php", method: "POST", data: { 'delete_user': true, 'userid': id },
                            success: function(response) { location.reload(); }
                        });
                    }
                });
            });

            $(document).on('click', '.btnedit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST", url: "backend.php", data: { 'edit_user': true, 'user_id': $(this).val() },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {
                            $('#id').val(res.data.id);
                            $('#Userid').val(res.data.userid);
                            $('#Password').val(res.data.password);
                            $('#Role').val(res.data.role);
                            $('#Editusers').modal('show');
                        }
                    }
                });
            });

            $(document).on('submit', '#Editnewuser', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append("save_edituser", true);
                $.ajax({
                    type: "POST", url: "backend.php", data: formData, processData: false, contentType: false,
                    success: function(response) { 
                        Swal.fire({
                            title: 'Updated!',
                            text: 'User details updated successfully.',
                            icon: 'success'
                        }).then(() => { location.reload(); });
                    }
                });
            });

            $('#downloadExcel').click(function() {
                let table = document.getElementById("usersTable");
                let wb = XLSX.utils.table_to_book(table, {sheet: "Sheet1"});
                XLSX.writeFile(wb, "Admins_List.xlsx");
            });
        });
    </script>
</body>
</html>