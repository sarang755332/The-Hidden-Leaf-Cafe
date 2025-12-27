<?php
session_start();


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - The Hidden Leaf Cafe</title>
    <link rel="stylesheet" href="../css/style2.css"> <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1cd537a5c2.js" crossorigin="anonymous"></script>
</head>
<body class="admin-body">
    <?php include 'includes/admin_navbar.php'; ?>

    <main class="admin-main-content">
        <div class="admin-dashboard-container">
            <h1 class="admin-page-title">Welcome, <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?>!</h1>
            <p>This is your administration dashboard for The Hidden Leaf Cafe. Here you can manage various aspects of your website.</p>

            <div class="dashboard-links">
                <a href="reservations.php" class="dashboard-card">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>Manage Reservations</h3>
                    <p>View and update customer reservations statuses.</p>
                </a>
                <?php if (isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'manager'): ?>
                <a href="users.php" class="dashboard-card">
                    <i class="fas fa-users-cog"></i>
                    <h3>Manage Admin Users</h3>
                    <p>Add, edit, or delete administrator accounts.</p>
                </a>
                <a href="feedback.php" class="dashboard-card">
                      <i class="fas fa-comments"></i> <h3>View Feedback</h3>
                     <p>Review messages and inquiries from customers.</p>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include 'includes/admin_footer.php'; ?>
</body>
</html>