<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Fallback if session role isn't set (shouldn't happen due to page checks)
$currentRole = $_SESSION['role'] ?? '';
$page = isset($page) ? $page : '';
?>
<nav class="admin-sidebar">
    <div class="admin-brand">
        <?php
        if ($currentRole == '2')
            echo 'SUPER ADMIN';
        elseif ($currentRole == '1')
            echo 'EVENT ADMIN';
        else
            echo 'ORLIA ADMIN';
        ?>
    </div>
    <ul class="admin-nav">
        <?php if ($currentRole == '2'): // Super Admin ?>
            <li><a href="superAdmin.php" class="<?= $page === 'dashboard' ? 'active' : '' ?>"><i
                        class="ri-dashboard-3-line"></i> Dashboard</a></li>
            <li><a href="manageAdmins.php" class="<?= $page === 'admins' ? 'active' : '' ?>"><i
                        class="ri-shield-user-line"></i> Manage Admins</a></li>
            <li><a href="overallParticipants.php" class="<?= $page === 'participants' ? 'active' : '' ?>"><i
                        class="ri-group-line"></i> Overall Participants</a></li>
            <li><a href="manageEvent.php" class="<?= $page === 'events' ? 'active' : '' ?>"><i
                        class="ri-calendar-check-line"></i> Manage Events</a></li>

        <?php elseif ($currentRole == '1'): // Event Admin ?>
            <li><a href="eventAdmin.php" class="<?= $page === 'dashboard' ? 'active' : '' ?>"><i
                        class="ri-dashboard-line"></i> Dashboard</a></li>
            <li><a href="eventParticipants.php" class="<?= $page === 'participants' ? 'active' : '' ?>"><i
                        class="ri-user-line"></i> Participants</a></li>

        <?php else: // Co-Admin (Role 0) ?>
            <li><a href="adminDashboard.php" class="<?= $page === 'dashboard' ? 'active' : '' ?>"><i
                        class="ri-dashboard-line"></i> Dashboard</a></li>
            <li><a href="manageParticipants.php" class="<?= $page === 'participants' ? 'active' : '' ?>"><i
                        class="ri-user-line"></i> Participants</a></li>
            <li><a href="manageAdmins.php" class="<?= $page === 'admins' ? 'active' : '' ?>"><i
                        class="ri-shield-user-line"></i> Manage Admins</a></li>
        <?php endif; ?>
    </ul>
</nav>