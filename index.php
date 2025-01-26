<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // Insert data into the database
    $sql = "INSERT INTO students (fullName, email, password, age, dob, phone, gender, fullTime, interests, address) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssssss', $fullName, $email, $password, $age, $dob, $phone, $gender, $fullTime, $interests, $address);
    if (mysqli_stmt_execute($stmt)) {
        // Data successfully inserted, now display the submitted data
        echo "<h3>Registration Details</h3>";
        echo "<p><strong>Full Name:</strong> $fullName</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Password:</strong> (hidden for security)</p>";
        echo "<p><strong>Age:</strong> $age</p>";
        echo "<p><strong>Date of Birth:</strong> $dob</p>";
        echo "<p><strong>Phone Number:</strong> $phone</p>";
        echo "<p><strong>Gender:</strong> $gender</p>";
        echo "<p><strong>Full-Time Student:</strong> $fullTime</p>";
        echo "<p><strong>Interests:</strong> " . implode(", ", explode(',', $interests)) . "</p>";
        echo "<p><strong>Address:</strong> $address</p>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration and CGPA Calculator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: rgba(76, 69, 69, 0.36); 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            flex-direction: column;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea,
        .form-group button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus,
        .form-group button:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-group button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .form-group button:active {
            transform: translateY(2px);
        }
        .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        width: 100%;
        max-width: 400px;
        padding: 10px;
        font-size: 14px;
        color: #555;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

        .form-group.checkbox-group,
        .form-group.radio-group {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .form-group.checkbox-group label,
        .form-group.radio-group label {
            margin-left: 5px;
        }

        .form-group .checkbox-group input,
        .form-group .radio-group input {
            width: auto;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            h2 {
                font-size: 22px;
            }

            .form-group label {
                font-size: 12px;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                font-size: 14px;
            }

            .form-group button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <!-- Student Registration Form -->
    <div class="container">
        <h2>Student Registration Form</h2>
        <form action="/includes/formhandler.inc.php" method="post" enctype="multipart/form-data">
            <!-- Full Name Input -->
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter a password" required>
            </div>

            <!-- Age Input -->
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" min="1" max="100" required>
            </div>

            <!-- Date of Birth -->
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <!-- Phone Input -->
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" placeholder="123-456-7890" required>
            </div>

            <!-- Gender Select -->
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select your gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    
                </select>
            </div>
             <!-- City Select -->
           
<div class="form-group">
    <label for="city" class="form-label">City:</label>
    <select id="city" name="city" class="form-control" required>
        <option value="">Select your city</option>
        <option value="Dhaka">Dhaka</option>
        <option value="Chittagong">Chittagong</option>
        <option value="Rajshahi">Rajshahi</option>
        <option value="Khulna">Khulna</option>
        <option value="Sylhet">Sylhet</option>
        <option value="Barisal">Barisal</option>
        <option value="Rangpur">Rangpur</option>
        <option value="Mymensingh">Mymensingh</option>
    </select>
</div>


            <!-- Full-Time Student Radio Buttons -->
            <div class="form-group radio-group">
                <label>Are you a full-time student?</label>
                <input type="radio" id="fullTimeYes" name="fullTime" value="yes" required>
                <label for="fullTimeYes">Yes</label>
                <input type="radio" id="fullTimeNo" name="fullTime" value="no">
                <label for="fullTimeNo">No</label>
            </div>

            <!-- Interests Checkboxes -->
            <div class="form-group checkbox-group">
                <label>Select your interests:</label>
                <input type="checkbox" id="interest1" name="interests[]" value="sports">
                <label for="interest1">Sports</label>
                <input type="checkbox" id="interest2" name="interests[]" value="music">
                <label for="interest2">Music</label>
                <input type="checkbox" id="interest3" name="interests[]" value="art">
                <label for="interest3">Art</label>
            </div>

            <!-- Address Textarea -->
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" placeholder="Enter your address"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>

    <!-- CGPA Calculator Form -->
    <div class="container">
        <h2>CGPA Calculator</h2>
        <form action="calculate_cgpa.php" method="POST">
            <div class="form-group">
                <label for="cseBasic">CSE Basic Marks:</label>
                <input type="number" id="cseBasic" name="cseBasic" required />
            </div>

            <div class="form-group">
                <label for="cseBasicLab">CSE Basic Lab Marks:</label>
                <input type="number" id="cseBasicLab" name="cseBasicLab" required />
            </div>

            <div class="form-group">
                <label for="chemistryLab">Chemistry Lab Marks:</label>
                <input type="number" id="chemistryLab" name="chemistryLab" required />
            </div>

            <div class="form-group">
                <label for="chemistry">Chemistry Marks:</label>
                <input type="number" id="chemistry" name="chemistry" required />
            </div>

            <div class="form-group">
                <label for="english">English Marks:</label>
                <input type="number" id="english" name="english" required />
            </div>

            <div class="form-group">
                <label for="englishLab">English Lab Marks:</label>
                <input type="number" id="englishLab" name="englishLab" required />
            </div>

            <div class="form-group">
                <label for="history">History Marks:</label>
                <input type="number" id="history" name="history" required />
            </div>

            <div class="form-group">
                <label for="math">Math Marks:</label>
                <input type="number" id="math" name="math" required />
            </div>

            <div class="form-group">
                <label for="physics">Physics Marks:</label>
                <input type="number" id="physics" name="physics" required />
            </div>

            <div class="form-group">
                <label for="physicsLab">Physics Lab Marks:</label>
                <input type="number" id="physicsLab" name="physicsLab" required />
            </div>

            <div class="form-group">
                <button type="submit">Calculate CGPA</button>
            </div>
        </form>
    </div>

</body>
</html>
