<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please log in first.');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}

// Establish connection to your database
$conn = new mysqli("localhost", "root", "", "scit");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Get input data
$current_password = sanitize_input($_POST['current-password']);
$new_password = sanitize_input($_POST['new-password']);
$confirm_password = sanitize_input($_POST['confirm-password']);

// Get username from session
$username = $_SESSION['username'];

// Check for empty submissions
if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
    echo "<script>alert('All fields are required.');</script>";
    echo "<script>window.location.href = 'change_password.html';</script>";
    exit;
}

// Check if new passwords match
if ($new_password !== $confirm_password) {
    echo "<script>alert('New passwords do not match.');</script>";
    echo "<script>window.location.href = 'change_password.html';</script>";
    exit;
}

// Fetch the current hashed password from the database
$query = "SELECT password FROM user WHERE username = ?";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
    $conn->close();
    exit;
}

// Verify the current password
if (!password_verify($current_password, $hashed_password)) {
    echo "<script>alert('Current password is incorrect.');</script>";
    echo "<script>window.location.href = 'change_password.html';</script>";
    exit;
}

// Hash the new password
$new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Update the password in the database
$update_query = "UPDATE user SET password = ? WHERE username = ?";
if ($stmt = $conn->prepare($update_query)) {
    $stmt->bind_param('ss', $new_hashed_password, $username);
    if ($stmt->execute()) {
        echo "<script>alert('Password changed successfully.');</script>";
        echo "<script>window.location.href = 'profile.php';</script>";
    } else {
        echo "<script>alert('Error updating password: " . $stmt->error . "');</script>";
        echo "<script>window.location.href = 'change_password.html';</script>";
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
?>
