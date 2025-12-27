<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafe";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log the actual error for debugging, but show a generic message to the user
    error_log("Database connection failed: " . $conn->connect_error);
    $_SESSION['reservation_message'] = 'An internal database error occurred. Please try again later.';
    $_SESSION['reservation_status'] = 'error';
    // No $conn->close() here as connection failed in the first place
    header("Location: reservation.php");
    exit();
}

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and trim input data using null coalescing operator (PHP 7.0+)
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $time = trim($_POST['time'] ?? '');
    $guests = intval($_POST['guests'] ?? 0); // Ensure guests is an integer
    $requests = trim($_POST['requests'] ?? '');

    // Server-side Validation
    $errors = [];
    if (empty($name)) {
        $errors[] = "Full Name is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }
    // Basic phone number validation (10-15 digits)
    if (!preg_match("/^\d{10,15}$/", $phone)) {
        $errors[] = "A valid phone number is required (10-15 digits).";
    }
    if (empty($date) || !strtotime($date)) { // strtotime checks if date is parseable
        $errors[] = "Valid Date is required.";
    }
    if (empty($time) || !strtotime($time)) { // strtotime checks if time is parseable
        $errors[] = "Valid Time is required.";
    }
    if ($guests < 1 || $guests > 10) {
        $errors[] = "Number of guests must be between 1 and 10.";
    }

    // If no validation errors, proceed with database insertion
    if (empty($errors)) {
        // Prepare the SQL statement to prevent SQL injection
        $sql = "INSERT INTO reservation (full_name, email, phone_number, reservation_date, reservation_time, number_of_guests, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            // Log prepare error
            error_log("SQL prepare failed: " . $conn->error);
            $_SESSION['reservation_message'] = 'An internal error occurred during reservation. Please try again.';
            $_SESSION['reservation_status'] = 'error';
            $conn->close(); // Close connection before exiting
            header("Location: reservation.php");
            exit();
        }

        // Bind parameters to the prepared statement
        // 'sssssis' corresponds to string, string, string, string, string, integer, string
        $stmt->bind_param("sssssis", $name, $email, $phone, $date, $time, $guests, $requests);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Set success messages for the user
            $_SESSION['alert_message'] = "Details entered successfully. Please check your reservation status for confirmation.";
            $_SESSION['alert_type'] = 'success';
            $_SESSION['reservation_message'] = 'Your reservation has been successfully placed!';
            $_SESSION['reservation_status'] = 'success';

            // Clear any previously stored form data from session
            unset($_SESSION['form_data']);

            $stmt->close(); // Close the statement
            $conn->close(); // Close the database connection
            header("Location: reservation.php"); // Redirect to reservation page
            exit(); // Terminate script to prevent further execution
        } else {
            // Log execution error
            error_log("SQL execute failed: " . $stmt->error);
            $_SESSION['reservation_message'] = 'Failed to save reservation. Please try again.';
            $_SESSION['reservation_status'] = 'error';

            $stmt->close(); // Close the statement even on failure
            $conn->close(); // Close the database connection
            header("Location: reservation.php"); // Redirect to reservation page
            exit(); // Terminate script
        }

    } else {
        // Validation errors occurred, set messages and redirect
        $_SESSION['reservation_message'] = 'Please correct the following errors: <br>' . implode('<br>', $errors);
        $_SESSION['reservation_status'] = 'error';
        $_SESSION['form_data'] = $_POST; // Keep form data to repopulate

        $conn->close(); // Close connection if validation fails
        header("Location: reservation.php"); // Redirect back to form
        exit(); // Terminate script
    }

} else {
    // If the form was not submitted via POST, redirect them back
    $conn->close(); // Close connection if not a POST request
    header("Location: reservation.php");
    exit(); // Terminate script
}

// The final $conn->close(); line from your original code is now unreachable
// because all valid execution paths above lead to an exit(), so it is removed.
?>