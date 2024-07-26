<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Set parameters
    $full_name = sanitize_input($_POST['full_name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $user_type = sanitize_input($_POST['user_type']);
    $username = sanitize_input($_POST['username']);
    $new_password = sanitize_input($_POST['new_password']);
    $confirm_password = sanitize_input($_POST['confirm_password']);
    $two_factor = isset($_POST['two_factor']) ? 1 : 0;
    $login_alerts = isset($_POST['login_alerts']) ? 1 : 0;

    // Check for empty submissions
    if (empty($full_name) || empty($email) || empty($phone) || empty($user_type) || empty($username) || empty($new_password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required.');</script>";
        echo "<script>window.location.href = 'home.php';</script>";
        exit;
    }

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
        echo "<script>window.location.href = 'home.php';</script>";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Check if the user already exists
    $checkQuery = "SELECT * FROM user WHERE full_name = ? OR email = ? OR phone = ?";
    if ($stmt = $conn->prepare($checkQuery)) {
        $stmt->bind_param('sss', $full_name, $email, $phone);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User already exists
            $stmt->close();
            echo "<script>alert('Credentials already used.');</script>";
            echo "<script>window.location.href = 'home.php';</script>";
            exit;
        }
        $stmt->close();
    }

    // Determine role based on user_type
    $role = ($user_type == 'admin') ? 'admin' : 'user';

    // Prepare the insertion query
    $insertQuery = "INSERT INTO user (full_name, email, phone, user_type, username, password, two_factor_auth, login_alerts, role)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($insertQuery)) {
        // Bind parameters
        $stmt->bind_param('sssssssis', $full_name, $email, $phone, $user_type, $username, $hashed_password, $two_factor, $login_alerts, $role);

        // Execute the insert statement
        if ($stmt->execute()) {
            echo "<script>alert('User Added Successfully');</script>";
            echo "<script>window.location.href = 'home.php';</script>";
        } else {
            echo "<script>alert('User Adding Failed: " . $stmt->error . "');</script>";
            echo "<script>window.location.href = 'home.php';</script>";
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
