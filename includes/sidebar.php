<?php
$role = isset($role) ? $role : 'admin';
$page = isset($page) ? $page : '';
?>
<nav class="admin-sidebar">
    <div class="admin-brand">
        <?php
        if ($role === 'super') echo 'SUPER ADMIN';
        elseif ($role === 'event') echo 'EVENT ADMIN';
        else echo 'ORLIA ADMIN';
        ?>
    </div>
    <ul class="admin-nav">
        <?php if ($role === 'super'): ?>
            <li><a href="superAdmin.php" class="<?= $page === 'dashboard' ? 'active' : '' ?>"><i class="ri-dashboard-3-line"></i> Dashboard</a></li>
            <li><a href="manageAdmins.php" class="<?= $page === 'admins' ? 'active' : '' ?>"><i class="ri-shield-user-line"></i> Manage Admins</a></li>
            <li><a href="overallParticipants.php" class="<?= $page === 'participants' ? 'active' : '' ?>"><i class="ri-group-line"></i> Overall Participants</a></li>
            <li><a href="manageEvent.php" class="<?= $page === 'events' ? 'active' : '' ?>"><i class="ri-calendar-check-line"></i> Manage Events</a></li>
        <?php elseif ($role === 'event'): ?>
            <li><a href="eventAdmin.php" class="<?= $page === 'dashboard' ? 'active' : '' ?>"><i class="ri-dashboard-line"></i> Dashboard</a></li>
            <li><a href="eventParticipants.php" class="<?= $page === 'participants' ? 'active' : '' ?>"><i class="ri-user-line"></i> Participants</a></li>
        <?php else: ?>
            <li><a href="adminDashboard.php" class="<?= $page === 'dashboard' ? 'active' : '' ?>"><i class="ri-dashboard-line"></i> Dashboard</a></li>
            <li><a href="manageParticipants.php" class="<?= $page === 'participants' ? 'active' : '' ?>"><i class="ri-user-line"></i> Participants</a></li>
            <li><a href="manageEvent.php" class="<?= $page === 'events' ? 'active' : '' ?>"><i class="ri-calendar-check-line"></i> Manage Events</a></li>
        <?php endif; ?>
    </ul>
</nav>
