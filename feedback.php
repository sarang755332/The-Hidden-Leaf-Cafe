<?php
session_start();
require_once 'includes/db_connect.php'; 

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$message = "";
$message_type = "";

// Handle Mark as Read/Unread
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'mark_read_toggle' && isset($_POST['feedback_id'])) {
    $feedback_id = $_POST['feedback_id'];
    $current_status = $_POST['current_status']; 
    $new_status = ($current_status == '1') ? 0 : 1; 

    if (!is_numeric($feedback_id)) {
        $message = "Invalid feedback ID.";
        $message_type = "error";
    } else {
        $stmt = $conn->prepare("UPDATE feedback SET is_read = ? WHERE id = ?");
        $stmt->bind_param("ii", $new_status, $feedback_id);
        if ($stmt->execute()) {
            $status_text = ($new_status == 1) ? 'read' : 'unread';
            $message = "Feedback ID " . htmlspecialchars($feedback_id) . " marked as {$status_text}.";
            $message_type = "success";
        } else {
            $message = "Error updating feedback status: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();
    }
    $_SESSION['feedback_message'] = $message;
    $_SESSION['feedback_message_type'] = $message_type;
    header("Location: feedback.php"); 
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $feedback_id = $_GET['id'];
    if (!is_numeric($feedback_id) || $feedback_id <= 0) {
        $_SESSION['feedback_message'] = "Invalid feedback ID for deletion.";
        $_SESSION['feedback_message_type'] = "error";
    } else {
        $stmt = $conn->prepare("DELETE FROM feedback WHERE id = ?");
        $stmt->bind_param("i", $feedback_id);
        if ($stmt->execute()) {
            $_SESSION['feedback_message'] = "Feedback deleted successfully.";
            $_SESSION['feedback_message_type'] = "success";
        } else {
            $_SESSION['feedback_message'] = "Error deleting feedback: " . $stmt->error;
            $_SESSION['feedback_message_type'] = "error";
        }
        $stmt->close();
    }
    header("Location: feedback.php"); 
    exit();
}


if (isset($_SESSION['feedback_message'])) {
    $message = $_SESSION['feedback_message'];
    $message_type = $_SESSION['feedback_message_type'];
    unset($_SESSION['feedback_message']);
    unset($_SESSION['feedback_message_type']);
}


$feedback = [];
$sql = "SELECT id, full_name, email, subject, message, submitted_at, is_read FROM feedback ORDER BY submitted_at DESC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedback[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback - The Hidden Leaf Cafe</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/YOUR_ACTUAL_FONT_AWESOME_KIT_CODE.js" crossorigin="anonymous"></script>
</head>
<body class="admin-body">
    <?php include 'includes/admin_navbar.php'; ?>

    <main class="admin-main-content">
        <div class="admin-reservations-container"> <h1 class="admin-page-title">Customer Feedback</h1>

            <?php if ($message): ?>
                <div class="message-box <?php echo $message_type; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <?php if (empty($feedback)): ?>
                <p class="no-reservations">No customer feedback found.</p>
            <?php else: ?>
                <div class="reservation-table-wrapper"> <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Submitted At</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($feedback as $msg): ?>
                                <tr class="<?php echo $msg['is_read'] ? 'read-message' : 'unread-message'; ?>">
                                    <td><?php echo htmlspecialchars($msg['id']); ?></td>
                                    <td><?php echo htmlspecialchars($msg['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($msg['email']); ?></td>
                                    <td><?php echo htmlspecialchars($msg['subject'] ?? 'N/A'); ?></td>
                                    <td class="message-preview"><?php echo htmlspecialchars(substr($msg['message'], 0, 100)) . (strlen($msg['message']) > 100 ? '...' : ''); ?></td>
                                    <td><?php echo htmlspecialchars($msg['submitted_at']); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo $msg['is_read'] ? 'approved' : 'pending'; ?>">
                                            <?php echo $msg['is_read'] ? 'Read' : 'Unread'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button type="button" class="action-btn <?php echo $msg['is_read'] ? 'pending-btn' : 'approve-btn'; ?>"
                                                    onclick="document.getElementById('form_read_<?php echo $msg['id']; ?>').submit();"
                                                    title="<?php echo $msg['is_read'] ? 'Mark as Unread' : 'Mark as Read'; ?>">
                                                <i class="fas <?php echo $msg['is_read'] ? 'fa-eye-slash' : 'fa-eye'; ?>"></i>
                                            </button>
                                            <form id="form_read_<?php echo $msg['id']; ?>" action="feedback.php" method="POST" style="display:none;">
                                                <input type="hidden" name="action" value="mark_read_toggle">
                                                <input type="hidden" name="feedback_id" value="<?php echo htmlspecialchars($msg['id']); ?>">
                                                <input type="hidden" name="current_status" value="<?php echo htmlspecialchars($msg['is_read']); ?>">
                                            </form>

                                            <a href="feedback.php?action=delete&id=<?php echo htmlspecialchars($msg['id']); ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this feedback?');" title="Delete Feedback"><i class="fas fa-trash-alt"></i></a>
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