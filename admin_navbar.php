<?php

$is_admin_logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
$admin_role = $_SESSION['admin_role'] ?? 'guest'; 
?>

<header class="admin-header">
    <nav class="admin-navbar">
        <a href="../index.php" class="admin-navbar-brand">Hidden Leaf Cafe</a>
        <ul class="admin-nav-links" id="adminNavLinks">
            <?php if ($is_admin_logged_in): ?>
                <li><a href="dashboard.php" class="admin-nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="reservations.php" class="admin-nav-link"><i class="fas fa-calendar-alt"></i> Reservations</a></li>
    
                <?php if ($admin_role === 'manager'): ?>
                    <li><a href="users.php" class="admin-nav-link"><i class="fas fa-users-cog"></i> User Management</a></li>
                    <li><a href="feedback.php" class="admin-nav-link"><i class="fas fa-comments"></i> Feedback</a></li>
                    <?php endif; ?>
                <li><a href="logout.php" class="admin-nav-link logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <?php else: ?>
                <li><a href="login.php" class="admin-nav-link"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            <?php endif; ?>
        </ul>
        <div class="admin-nav-toggle" id="adminNavToggle">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
</header>

<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        const adminNavToggle = document.getElementById('adminNavToggle');
        const adminNavLinks = document.getElementById('adminNavLinks');

        if (adminNavToggle && adminNavLinks) {
            adminNavToggle.addEventListener('click', function() {
                adminNavLinks.classList.toggle('active');
            });
        }
    });
</script>