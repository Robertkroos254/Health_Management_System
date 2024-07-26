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

// Get username from session
$username = $_SESSION['username'];

// Fetch user data based on username
$query = "SELECT full_name, email, phone, user_type, username FROM user WHERE username = ?";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($full_name, $email, $phone, $user_type, $username);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* styles.css */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

.profile-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.profile-header {
    text-align: center;
    padding: 20px 0;
}

.profile-header img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
}

.profile-header h1 {
    font-size: 24px;
    margin: 10px 0;
}

.profile-header p {
    font-size: 16px;
    color: #888;
}

.profile-bio {
    margin-top: 20px;
}

    </style>
    <title>User Profile</title>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <img src="./icons/prof.png" alt="Profile Picture">
            <h1><?php echo htmlspecialchars($full_name); ?></h1>
            <p><?php echo htmlspecialchars($user_type); ?></p>
            <div class="contact-info">
                <p>Email: <?php echo htmlspecialchars($email); ?></p>
                <p>Phone: <?php echo htmlspecialchars($phone); ?></p>
            </div>
        </div>
        
    </div>
</body>
</html>
