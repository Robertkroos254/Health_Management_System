<?php
// Database connection parameters
$host = "localhost";
$dbname = "scit";
$username = "root";
$password = "";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check which form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["full-name"])) {
            // Personal Information Update
            $stmt = $pdo->prepare("UPDATE user SET full_name = ?, email = ?, phone = ?, username = ? WHERE id = ?");
            $stmt->execute([
                $_POST["full-name"],
                $_POST["email"],
                $_POST["phone"],
                $_POST["username"],
                $_SESSION["user_id"] // Assuming you have a user session
            ]);
            echo json_encode(["success" => true, "message" => "Personal information updated successfully"]);
        } elseif (isset($_POST["current-password"])) {
            // Password Change
            $stmt = $pdo->prepare("SELECT password FROM user WHERE id = ?");
            $stmt->execute([$_SESSION["user_id"]]);
            $user = $stmt->fetch();

            if (password_verify($_POST["current-password"], $user["password"])) {
                if ($_POST["new-password"] === $_POST["confirm-password"]) {
                    $new_password_hash = password_hash($_POST["new-password"], PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("UPDATE user SET password = ? WHERE id = ?");
                    $stmt->execute([$new_password_hash, $_SESSION["user_id"]]);
                    echo json_encode(["success" => true, "message" => "Password changed successfully"]);
                } else {
                    echo json_encode(["success" => false, "message" => "New passwords do not match"]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Current password is incorrect"]);
            }
        } elseif (isset($_POST["two-factor-auth"])) {
            // Security Settings Update
            $two_factor_auth = isset($_POST["two-factor-auth"]) ? 1 : 0;
            $login_alerts = isset($_POST["login-alerts"]) ? 1 : 0;
            
            $stmt = $pdo->prepare("UPDATE user SET two_factor_auth = ?, login_alerts = ? WHERE id = ?");
            $stmt->execute([$two_factor_auth, $login_alerts, $_SESSION["user_id"]]);
            echo json_encode(["success" => true, "message" => "Security settings updated successfully"]);
        }
    }
} catch(PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
?>