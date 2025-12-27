<?php
session_start(); 
require_once 'admin/includes/db_connect.php'; 

$feedback_message = "";
$feedback_message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message_content = trim($_POST['message'] ?? '');

    if (empty($full_name) || empty($email) || empty($message_content)) {
        $feedback_message = "Please fill in all required fields (Name, Email, Message).";
        $feedback_message_type = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $feedback_message = "Please enter a valid email address.";
        $feedback_message_type = "error";
    } else {
        $stmt = $conn->prepare("INSERT INTO feedback (full_name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $full_name, $email, $subject, $message_content);

        if ($stmt->execute()) {
            $feedback_message = "Thank you for your feedback! We will get back to you soon.";
            $feedback_message_type = "success";
            // Clear form fields
            $_POST = array();
        } else {
            $feedback_message = "Error submitting feedback: " . $stmt->error;
            $feedback_message_type = "error";
        }
        $stmt->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/style2.css"> <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1cd537a5c2.js" crossorigin="anonymous"></script>
</head>
<body class="admin-body">
    <?php include 'includes/navbar.php'; ?>
    <main class="admin-main-content"> <div class="admin-reservations-container">
            <h1 class="admin-page-title">Contact Us / Send Feedback</h1>

            <?php if ($feedback_message): ?>
                <div class="message-box <?php echo $feedback_message_type; ?>">
                    <?php echo htmlspecialchars($feedback_message); ?>
                </div>
            <?php endif; ?>

            <form action="contact.php" method="POST" class="admin-form">
                <div class="form-group">
                    <label for="full_name">Your Name:</label>
                    <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject (Optional):</label>
                    <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="7" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?> 
</body>
</html>