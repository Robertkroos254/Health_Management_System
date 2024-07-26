<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scit";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Array of required fields
    $required_fields = [
        'date', 'time', 'admissions', 'deaths', 'referrals', 'operations', 'deliveries',
        'well_adults', 'well_children', 'sick_children', 'doctor', 'co', 'nursing_officer',
        'lab_technician', 'anesthetist', 'pharmacist', 'driver', 'radiographer', 'cashier',
        'nhif_officer', 'watchman', 'total_well', 'total_patients', 'grand_total'
    ];

    // Check for empty required fields
    $errors = [];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
        }
    }

    if (empty($errors)) {
        // Sanitize and prepare data for insertion
        $date = sanitize_input($_POST['date']);
        $time = sanitize_input($_POST['time']);
        $admissions = sanitize_input($_POST['admissions']);
        $deaths = sanitize_input($_POST['deaths']);
        $referrals = sanitize_input($_POST['referrals']);
        $operations = sanitize_input($_POST['operations']);
        $deliveries = sanitize_input($_POST['deliveries']);
        $well_adults = sanitize_input($_POST['well_adults']);
        $well_children = sanitize_input($_POST['well_children']);
        $sick_children = sanitize_input($_POST['sick_children']);
        $doctor = sanitize_input($_POST['doctor']);
        $co = sanitize_input($_POST['co']);
        $nursing_officer = sanitize_input($_POST['nursing_officer']);
        $lab_technician = sanitize_input($_POST['lab_technician']);
        $anesthetist = sanitize_input($_POST['anesthetist']);
        $pharmacist = sanitize_input($_POST['pharmacist']);
        $driver = sanitize_input($_POST['driver']);
        $radiographer = sanitize_input($_POST['radiographer']);
        $cashier = sanitize_input($_POST['cashier']);
        $nhif_officer = sanitize_input($_POST['nhif_officer']);
        $watchman = sanitize_input($_POST['watchman']);
        $total_well = sanitize_input($_POST['total_well']);
        $total_patients = sanitize_input($_POST['total_patients']);
        $grand_total = sanitize_input($_POST['grand_total']);
        
        // Optional fields
        $additional_1 = sanitize_input($_POST['additional_1']);
        $additional_2 = sanitize_input($_POST['additional_2']);
        $additional_3 = sanitize_input($_POST['additional_3']);
        $additional_4 = sanitize_input($_POST['additional_4']);

        // Prepare SQL statement
        $sql = "INSERT INTO nbu (date, time, admissions, deaths, referrals, operations, deliveries, 
                well_adults, well_children, sick_children, doctor, co, nursing_officer, lab_technician, 
                anesthetist, pharmacist, driver, radiographer, cashier, nhif_officer, watchman, 
                total_well, total_patients, grand_total, additional_1, additional_2, additional_3, additional_4) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiiiiiiiisssssssssssiiissss", $date, $time, $admissions, $deaths, $referrals, 
                          $operations, $deliveries, $well_adults, $well_children, $sick_children, $doctor, 
                          $co, $nursing_officer, $lab_technician, $anesthetist, $pharmacist, $driver, 
                          $radiographer, $cashier, $nhif_officer, $watchman, $total_well, $total_patients, 
                          $grand_total, $additional_1, $additional_2, $additional_3, $additional_4);

        if ($stmt->execute()) {
            echo "<script>alert('Report Submitted successfully.');</script>";
            echo "<script>window.location.href = 'home.html';</script>";
        } else {
            echo "<script>alert('Report Submission Failed: " . $sql . "');</script>";
            // echo "<script>alert('Report Submission Failed: " . $stmt->error . "');</script>";
            // echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

$conn->close();
?>