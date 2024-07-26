<?php

// login.php (example)
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "scit");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user credentials from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Check the database for the user's credentials
$sql = "SELECT * FROM user WHERE username = ? AND new_password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    
    // User found, fetch role and other details
    $user = $result->fetch_assoc();
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_type'] = $user['user_type'];

    // Check if the user is an admin or a regular user
    if ($user['user_type'] == 'admin') {
        echo "<script>alert('Admin Login Successful'); window.location.href='home.php';</script>";
    } else {
        echo "<script>alert('User Login Successful'); window.location.href='home.php';</script>";
    }
} else {
    echo "<script>alert('Login Failed: Invalid username or password'); window.location.href='index.html';</script>";
}

$conn->close();
?>
