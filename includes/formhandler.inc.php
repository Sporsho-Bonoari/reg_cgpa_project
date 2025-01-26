<?php
// Start session to pass data to view.php
session_start();

// Database connection
include 'dbh.inc.php';

// Collect form data
$fullName = $_POST['fullName'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$age = $_POST['age'] ?? '';
$dob = $_POST['dob'] ?? '';
$phone = $_POST['phone'] ?? '';
$gender = $_POST['gender'] ?? '';
$fullTime = $_POST['fullTime'] ?? '';
$interests = isset($_POST['interests']) ? implode(',', $_POST['interests']) : ''; // Store as a comma-separated string
$address = $_POST['address'] ?? '';
$city = $_POST['city'] ?? '';


// Insert data into the database
$sql = "INSERT INTO students (fullName, email, password, age, dob, phone, gender, fullTime, interests, address, city) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'sssssssssss', $fullName, $email, $password, $age, $dob, $phone, $gender, $fullTime, $interests, $address, $city);


if (mysqli_stmt_execute($stmt)) {
    // Store form data in session
    $_SESSION['submittedData'] = [
        'fullName' => $fullName,
        'email' => $email,
        'password' => $password,
        'age' => $age,
        'dob' => $dob,
        'phone' => $phone,
        'gender' => $gender,
        'fullTime' => $fullTime,
        'interests' => $interests,
        'address' => $address,
        'city'=> $city
    ];
    // Redirect to view.php to display the submitted data
    header("Location: ../view.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
