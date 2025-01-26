<?php
// Define grading system
$gradingSystem = [
    ['min' => 80, 'max' => 100, 'gradePoint' => 4.0],
    ['min' => 75, 'max' => 79, 'gradePoint' => 3.75],
    ['min' => 70, 'max' => 74, 'gradePoint' => 3.5],
    ['min' => 65, 'max' => 69, 'gradePoint' => 3.25],
    ['min' => 60, 'max' => 64, 'gradePoint' => 3.0],
    ['min' => 55, 'max' => 59, 'gradePoint' => 2.75],
    ['min' => 50, 'max' => 54, 'gradePoint' => 2.5],
    ['min' => 45, 'max' => 49, 'gradePoint' => 2.25],
    ['min' => 40, 'max' => 44, 'gradePoint' => 2.0],
    ['min' => 0, 'max' => 39, 'gradePoint' => 0.0],
];

// Function to get grade point for a given mark
function getGradePoint($mark, $gradingSystem) {
    foreach ($gradingSystem as $grade) {
        if ($mark >= $grade['min'] && $mark <= $grade['max']) {
            return $grade['gradePoint'];
        }
    }
    return 0;
}

// Collect marks from POST data
$marks = [
    $_POST['cseBasic'],
    $_POST['cseBasicLab'],
    $_POST['chemistryLab'],
    $_POST['chemistry'],
    $_POST['english'],
    $_POST['englishLab'],
    $_POST['history'],
    $_POST['math'],
    $_POST['physics'],
    $_POST['physicsLab']
];

// Calculate CGPA
$totalGradePoints = 0;
$subjectCount = count($marks);

foreach ($marks as $mark) {
    $totalGradePoints += getGradePoint($mark, $gradingSystem);
}

$cgpa = $totalGradePoints / $subjectCount;

// Display the result
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGPA Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .result-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
        }
        .result-container h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .result-container p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h1>Your CGPA is : </h1>
        <p><?php echo number_format($cgpa, 2); ?></p>
    </div>
</body>
</html>
