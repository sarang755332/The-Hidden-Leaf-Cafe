<?php
session_start();
require_once 'includes/db_connect.php'; // Ensure this path is correct

// Access Control: Only 'manager' role can access this page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['admin_role'] !== 'manager') {
    header("Location: dashboard.php"); // Redirect non-managers to dashboard or login
    exit();
}

$message = "";
$message_type = "";
$edit_user_data = null; // For pre-filling edit form

// Handle Add/Edit User Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];
    $username = trim($_POST['username'] ?? '');
    $role = $_POST['role'] ?? 'staff'; // Default to staff
    $password = $_POST['password'] ?? '';
    $user_id = $_POST['user_id'] ?? null;

    if (empty($username)) {
        $message = "Username cannot be empty.";
        $message_type = "error";
    } else if (!in_array($role, ['manager', 'staff'])) {
        $message = "Invalid role selected.";
        $message_type = "error";
    } else {
        if ($action === 'add') {
            if (empty($password)) {
                $message = "Password cannot be empty for a new user.";
                $message_type = "error";
            } else {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (username, password_hash, role) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $password_hash, $role);
                if ($stmt->execute()) {
                    $message = "User '{$username}' added successfully.";
                    $message_type = "success";
                } else {
                    if ($stmt->errno == 1062) { // Duplicate entry error code for UNIQUE constraint
                        $message = "Username '{$username}' already exists. Please choose a different one.";
                    } else {
                        $message = "Error adding user: " . $stmt->error;
                    }
                    $message_type = "error";
                }
                $stmt->close();
            }
        } elseif ($action === 'edit') {
            if (!is_numeric($user_id)) {
                $message = "Invalid user ID for editing.";
                $message_type = "error";
            } else {
                // If password is provided, hash and update it, otherwise keep old password
                $sql = "UPDATE users SET username = ?, role = ? WHERE id = ?";
                $params = "ssi";
                $bind_values = [$username, $role, $user_id];

                if (!empty($password)) {
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "UPDATE users SET username = ?, password_hash = ?, role = ? WHERE id = ?";
                    $params = "sssi";
                    $bind_values = [$username, $password_hash, $role, $user_id];
                }

                $stmt = $conn->prepare($sql);
                $stmt->bind_param($params, ...$bind_values);

                if ($stmt->execute()) {
                    $message = "User '{$username}' updated successfully.";
                    $message_type = "success";
                    // If the current logged-in admin updated their own role, update session
                    if ($_SESSION['admin_user_id'] == $user_id) {
                        $_SESSION['admin_username'] = $username;
                        $_SESSION['admin_role'] = $role;
                    }
                } else {
                     if ($stmt->errno == 1062) { // Duplicate entry error code for UNIQUE constraint
                        $message = "Username '{$username}' already exists. Please choose a different one.";
                    } else {
                        $message = "Error updating user: " . $stmt->error;
                    }
                    $message_type = "error";
                }
                $stmt->close();
            }
        }
    }
    // Redirect to self to clear POST data and show message
    $_SESSION['user_management_message'] = $message;
    $_SESSION['user_management_message_type'] = $message_type;
    header("Location: users.php");
    exit();
}

// Handle Delete User
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $user_id = $_GET['id'];
    if (!is_numeric($user_id) || $user_id <= 0) {
        $_SESSION['user_management_message'] = "Invalid user ID for deletion.";
        $_SESSION['user_management_message_type'] = "error";
    } else {
        // Prevent deleting the currently logged-in admin
        if ($_SESSION['admin_user_id'] == $user_id) {
            $_SESSION['user_management_message'] = "Cannot delete the currently logged-in administrator.";
            $_SESSION['user_management_message_type'] = "error";
        } else {
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                $_SESSION['user_management_message'] = "User deleted successfully.";
                $_SESSION['user_management_message_type'] = "success";
            } else {
                $_SESSION['user_management_message'] = "Error deleting user: " . $stmt->error;
                $_SESSION['user_management_message_type'] = "error";
            }
            $stmt->close();
        }
    }
    header("Location: users.php");
    exit();
}

// Handle Edit User (populate form)
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT id, username, role FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $edit_user_data = $result->fetch_assoc();
    } else {
        $_SESSION['user_management_message'] = "User not found for editing.";
        $_SESSION['user_management_message_type'] = "error";
        header("Location: users.php");
        exit();
    }
    $stmt->close();
}


// Display messages from session
if (isset($_SESSION['user_management_message'])) {
    $message = $_SESSION['user_management_message'];
    $message_type = $_SESSION['user_management_message_type'];
    unset($_SESSION['user_management_message']);
    unset($_SESSION['user_management_message_type']);
}

// Fetch all users for display
$users = [];
$sql = "SELECT id, username, role, created_at FROM users ORDER BY username ASC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - The Hidden Leaf Cafe</title>
    <link rel="stylesheet" href="../css/style2.css"> <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1cd537a5c2.js" crossorigin="anonymous"></script>
</head>
<body class="admin-body">
    <?php include 'includes/admin_navbar.php'; ?>

    <main class="admin-main-content">
        <div class="admin-user-management-container">
            <h1 class="admin-page-title">User Management</h1>

            <?php if ($message): ?>
                <div class="message-box <?php echo $message_type; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <div class="user-form-section">
                <h2 class="form-heading"><?php echo $edit_user_data ? 'Edit User' : 'Add New User'; ?></h2>
                <form action="users.php" method="POST" class="admin-form">
                    <input type="hidden" name="action" value="<?php echo $edit_user_data ? 'edit' : 'add'; ?>">
                    <?php if ($edit_user_data): ?>
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($edit_user_data['id']); ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($edit_user_data['username'] ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password"><?php echo $edit_user_data ? 'New Password (leave blank to keep current):' : 'Password:'; ?></label>
                        <input type="password" id="password" name="password" <?php echo $edit_user_data ? '' : 'required'; ?>>
                    </div>

                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select id="role" name="role" required>
                            <option value="staff" <?php echo ($edit_user_data && $edit_user_data['role'] === 'staff') ? 'selected' : ''; ?>>Staff</option>
                            <option value="manager" <?php echo ($edit_user_data && $edit_user_data['role'] === 'manager') ? 'selected' : ''; ?>>Manager</option>
                        </select>
                    </div>
                    <button type="submit" class="submit-btn"><?php echo $edit_user_data ? 'Update User' : 'Add User'; ?></button>
                    <?php if ($edit_user_data): ?>
                        <a href="users.php" class="cancel-btn">Cancel Edit</a>
                    <?php endif; ?>
                </form>
            </div>

            <h2 class="table-heading">Existing Users</h2>
            <?php if (empty($users)): ?>
                <div class="no-users-message">
                    <p>No users found. Add your first admin user above!</p>
                </div>
            <?php else: ?>
                <div class="user-table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><span class="role-badge role-<?php echo strtolower(htmlspecialchars($user['role'])); ?>"><?php echo htmlspecialchars(ucfirst($user['role'])); ?></span></td>
                                    <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                                    <td>
                                        <a href="users.php?action=edit&id=<?php echo htmlspecialchars($user['id']); ?>" class="action-btn edit-btn" title="Edit User"><i class="fas fa-edit"></i></a>
                                        <?php if ($_SESSION['admin_user_id'] != $user['id']): // Cannot delete self ?>
                                            <a href="users.php?action=delete&id=<?php echo htmlspecialchars($user['id']); ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this user?');" title="Delete User"><i class="fas fa-trash-alt"></i></a>
                                        <?php endif; ?>
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