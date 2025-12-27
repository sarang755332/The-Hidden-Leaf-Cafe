<?php
session_start();
require_once 'includes/db_connect.php'; 


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$message = "";
$message_type = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reservation_id']) && isset($_POST['status'])) {
    $reservation_id = $_POST['reservation_id'];
    $new_status = $_POST['status'];

    
    if (!is_numeric($reservation_id) || !in_array($new_status, ['Approved', 'Declined', 'Pending'])) {
        $message = "Invalid input.";
        $message_type = "error";
    } else {
        $stmt = $conn->prepare("UPDATE reservation SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $reservation_id);
        if ($stmt->execute()) {
            $message = "Reservation ID " . htmlspecialchars($reservation_id) . " status updated to " . htmlspecialchars($new_status) . ".";
            $message_type = "success";
        } else {
            $message = "Error updating status: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();
    }
    
    $_SESSION['reservation_message'] = $message;
    $_SESSION['reservation_message_type'] = $message_type;
    header("Location: reservations.php"); 
    exit();
}


if (isset($_SESSION['reservation_message'])) {
    $message = $_SESSION['reservation_message'];
    $message_type = $_SESSION['reservation_message_type'];
    unset($_SESSION['reservation_message']);
    unset($_SESSION['reservation_message_type']);
}


// Fetch reservations from the database
$reservations = [];
$sql = "SELECT id, full_name, email, phone_number, reservation_date, reservation_time, number_of_guests, special_requests, status, created_at FROM reservation ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations - The Hidden Leaf Cafe</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1cd537a5c2.js" crossorigin="anonymous"></script>
</head>
<body class="admin-body">
    <?php include 'includes/admin_navbar.php'; ?>

    <main class="admin-main-content">
        <div class="admin-reservations-container">
            <h1 class="admin-page-title">All Reservations</h1>

            <?php if ($message): ?>
                <div class="message-box <?php echo $message_type; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <?php if (empty($reservations)): ?>
                <p class="no-reservations">No reservations found.</p>
            <?php else: ?>
                <div class="reservation-table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Guests</th>
                                <th>Requests</th>
                                <th>Status</th>
                                <th>Submitted At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($reservation['id']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['email']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['phone_number']); ?></td>
                                    <!-- FIX: Added 'echo' here -->
                                    <td><?php echo htmlspecialchars($reservation['reservation_date']); ?></td>
                                    <!-- FIX: Added 'echo' here -->
                                    <td><?php echo htmlspecialchars(date("h:i A", strtotime($reservation['reservation_time']))); ?></td>
                                    <!-- FIX: Added 'echo' here -->
                                    <td><?php echo htmlspecialchars($reservation['number_of_guests']); ?></td>
                                    <!-- FIX: Added 'echo' here -->
                                    <td><?php echo htmlspecialchars($reservation['special_requests']); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo strtolower(htmlspecialchars($reservation['status'])); ?>">
                                            <?php echo htmlspecialchars($reservation['status']); ?>
                                        </span>
                                    </td>
                                    <!-- FIX: Added 'echo' here -->
                                    <td><?php echo htmlspecialchars($reservation['created_at']); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <form action="reservations.php" method="POST" style="display:inline-block;">
                                                <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
                                                <input type="hidden" name="status" value="Approved">
                                                <button type="submit" class="action-btn approve-btn" title="Approve"><i class="fas fa-check-circle"></i></button>
                                            </form>
                                            <form action="reservations.php" method="POST" style="display:inline-block;">
                                                <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
                                                <input type="hidden" name="status" value="Declined">
                                                <button type="submit" class="action-btn decline-btn" title="Decline"><i class="fas fa-times-circle"></i></button>
                                            </form>
                                            <?php if ($reservation['status'] !== 'Pending'): ?>
                                                <form action="reservations.php" method="POST" style="display:inline-block;">
                                                    <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
                                                    <input type="hidden" name="status" value="Pending">
                                                    <button type="submit" class="action-btn pending-btn" title="Set Pending"><i class="fas fa-hourglass-half"></i></button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'includes/admin_footer.php'; ?>
</body>
</html>