<?php
session_start(); 


$reservation_status = $_SESSION['reservation_status'] ?? null;
$reservation_message = $_SESSION['reservation_message'] ?? null;
unset($_SESSION['reservation_status']);
unset($_SESSION['reservation_message']);


$form_data = $_SESSION['form_data'] ?? [];



$alert_message = $_SESSION['alert_message'] ?? null;
$alert_type = $_SESSION['alert_type'] ?? null; 
unset($_SESSION['alert_message']);
unset($_SESSION['alert_type']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Reservation</title>
    <link rel="stylesheet" href="css/style2.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    </head>
<body>

    <?php include 'includes/navbar.php'; ?> 

    <main class="reservation-page-content">
        <section class="reservation-hero">
            <div class="hero-overlay">
                <h1>Reserve Your Table</h1>
                <p>Experience the cozy ambiance and delightful flavors of The Hidden Leaf Cafe.</p>
            </div>
        </section>

        <section class="reservation-form-section">
            <div class="form-card">
                <h2 class="form-heading">Book Your Spot</h2>
                <p class="form-description">Fill out the form below to secure your table. We look forward to seeing you!</p>
                
                <?php if ($reservation_message):?>
                    <div class="message-box <?php echo $reservation_status; ?>">
                        <?php echo $reservation_message; ?>
                    </div>
                <?php endif; ?>

                <form action="process_reservation.php" method="POST" class="reservation-form">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter Your Full Name" required value="<?php echo htmlspecialchars($form_data['name'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="abcd@example.com" required value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="9xxxxxxxx8" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required value="<?php echo htmlspecialchars($form_data['phone'] ?? ''); ?>">
                    </div>

                    <div class="form-group-flex">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" id="date" name="date" required min="<?php echo date('Y-m-d'); ?>" value="<?php echo htmlspecialchars($form_data['date'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" id="time" name="time" required min="09:00" max="21:00" value="<?php echo htmlspecialchars($form_data['time'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="guests">Number of Guests</label>
                        <input type="number" id="guests" name="guests" placeholder="e.g., 2" min="1" max="10" required value="<?php echo htmlspecialchars($form_data['guests'] ?? ''); ?>">
                        <small>For parties larger than 10, please call us directly.</small>
                    </div>

                    <div class="form-group">
                        <label for="requests">Special Requests (Optional)</label>
                        <textarea id="requests" name="requests" rows="4" placeholder="Allergies, specific seating, high chair needed, etc."><?php echo htmlspecialchars($form_data['requests'] ?? ''); ?></textarea>
                    </div>

                    <button type="submit" class="submit-btn">Confirm Reservation</button>
                    <p class="check-status-text">Already made a reservation? <a href="check_status.php" class="check-status-link">Check Status Here</a></p>
                
                </form>
            </div>
        </section>
    </main>
    
    <a id="top"></a> 
    <?php include 'includes/footer.php'; ?> 

    <?php if ($alert_message): ?>
        <script>
           
            document.addEventListener('DOMContentLoaded', function() {
                alert("<?php echo htmlspecialchars($alert_message, ENT_QUOTES, 'UTF-8'); ?>");
            });
        </script>
    <?php endif; ?>

</body>
</html>