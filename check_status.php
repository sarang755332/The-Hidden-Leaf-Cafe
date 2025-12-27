<?php
session_start(); 


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafe";

$reservations_found = []; 
$message = "";            
$message_type = "";       

// Check if a mobile number was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile_number = trim($_POST['mobile_number'] ?? '');

    // Basic validation
    if (empty($mobile_number)) {
        $message = "Please enter your mobile number.";
        $message_type = "error";
    } elseif (!preg_match("/^[0-9]{10,15}$/", $mobile_number)) { 
        $message = "Please enter a valid mobile number (10-15 digits).";
        $message_type = "error";
    } else {
        
        $conn = new mysqli($servername, $username, $password, $dbname);

    
        if ($conn->connect_error) {
            $message = "Database connection failed. Please try again later.";
            $message_type = "error";
            error_log("Check Status DB Error: " . $conn->connect_error); 
        } else {
            
            $sql = "SELECT id, full_name, email, phone_number, reservation_date, reservation_time, number_of_guests, special_requests, status, created_at
                    FROM reservation
                    WHERE phone_number = ?
                    ORDER BY reservation_date DESC, reservation_time DESC"; 

            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                $message = "An error occurred while preparing the query. Please try again.";
                $message_type = "error";
                error_log("Check Status Prepare Error: " . $conn->error);
            } else {
                $stmt->bind_param("s", $mobile_number); 

                if ($stmt->execute()) {
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $reservations_found[] = $row;
                        }
                        $message = "Here are your reservation details:";
                        $message_type = "success";
                    } else {
                        $message = "No reservations found for this mobile number. Please double-check the number or make a new reservation.";
                        $message_type = "info";
                    }
                } else {
                    $message = "An error occurred while fetching data. Please try again.";
                    $message_type = "error";
                    error_log("Check Status Execute Error: " . $stmt->error);
                }
                $stmt->close();
            }
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Reservation Status - The Hidden Leaf Cafe</title>
    <link rel="stylesheet" href="css/style2.css"> <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    </head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main class="check-status-page-content">
        <section class="status-hero">
            <div class="hero-overlay">
                <h1>Check Reservation Status</h1>
                <p>Enter your mobile number to view your reservation details and status.</p>
            </div>
        </section>

        <section class="status-form-section">
            <div class="form-card">
                <h2 class="form-heading">Find Your Reservation</h2>

                <?php if ($message): ?>
                    <div class="message-box <?php echo $message_type; ?>">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <form action="check_status.php" method="POST" class="status-form">
                    <div class="form-group">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="tel" id="mobile_number" name="mobile_number"
                               placeholder="e.g., 9xxxxxxxxx" pattern="[0-9]{10,15}"
                               title="Please enter a 10-15 digit phone number" required
                               value="<?php echo htmlspecialchars($_POST['mobile_number'] ?? ''); ?>">
                    </div>
                    <button type="submit" class="submit-btn">Check Status</button>
                    <p class="check-status-text">Want to reserve a Table? <a href="reservation.php" class="check-status-link">Reserve Now</a></p>
                
                </form>

                <?php if (!empty($reservations_found)): ?>
                    <div class="reservation-results">
                        <h3>Your Reservations:</h3>
                        <?php foreach ($reservations_found as $res): ?>
                            <div class="reservation-card">
                                <h4>Reservation ID: #<?php echo htmlspecialchars($res['id']); ?></h4>
                                <p><strong>Name:</strong> <?php echo htmlspecialchars($res['full_name']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($res['email']); ?></p>
                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($res['phone_number']); ?></p>
                                <p><strong>Date:</strong> <?php echo htmlspecialchars($res['reservation_date']); ?></p>
                                <p><strong>Time:</strong> <?php echo htmlspecialchars($res['reservation_time']); ?></p>
                                <p><strong>Guests:</strong> <?php echo htmlspecialchars($res['number_of_guests']); ?></p>
                                <p><strong>Requests:</strong> <?php echo !empty($res['special_requests']) ? htmlspecialchars($res['special_requests']) : 'N/A'; ?></p>
                                <p><strong>Status:</strong> <span class="status-<?php echo strtolower(htmlspecialchars($res['status'])); ?>"><?php echo htmlspecialchars(ucfirst($res['status'])); ?></span></p>
                                <p class="submitted-at">Submitted On: <?php echo htmlspecialchars($res['created_at']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <a id="top"></a>
    <?php include 'includes/footer.php'; ?>

</body>
</html>