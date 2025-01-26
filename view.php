<?php
// Start a session to check if form submission was successful
session_start();

// Check if the data is available in session (set in formhandler.inc.php)
if (!isset($_SESSION['submittedData'])) {
    echo "No data found. Please submit the form first.";
    exit;
}

// Get the submitted data from session
$submittedData = $_SESSION['submittedData'];

// Clear session data after use
unset($_SESSION['submittedData']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            width: 80%;
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            font-size: 18px;
            margin-bottom: 12px;
        }
        .details strong {
            color: #007BFF;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button-container a {
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 12px 20px;
            border-radius: 4px;
            font-size: 16px;
        }
        .button-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Registration Successful</h1>

        <div class="details">
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($submittedData['fullName']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($submittedData['email']); ?></p>
            <p><strong>Password:</strong> <?php echo htmlspecialchars($submittedData['password']); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($submittedData['age']); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($submittedData['dob']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($submittedData['phone']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($submittedData['gender']); ?></p>
            <p><strong>Full-Time Student:</strong> <?php echo htmlspecialchars($submittedData['fullTime']); ?></p>
            <p><strong>Interests:</strong> <?php echo htmlspecialchars($submittedData['interests']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($submittedData['address']); ?></p>
            <p><strong>City:</strong> <?php echo htmlspecialchars($submittedData['city']); ?></p>

        </div>

        <div class="button-container">
            <a href="index.php">Go Back to Registration Form</a>
        </div>
    </div>

</body>
</html>
