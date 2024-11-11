<?php
// Start session
session_start();

// Check if user is logged in by checking session variable
if (!isset($_SESSION['user_email'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit(); // Exit to ensure no further code runs
}

// Get the user email from session
$user_email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            position: relative;
        }

        /* User info style */
        .user-info {
            position: absolute;
            top: 250px;
            left: 220px;
            font-size: 25px;
            color: #333;
            font-weight: bold;
        }

        /* Logout button position at the top right */
        .logout {
            position: absolute;
            top: 250px;
            right: 250px;
            color: white;
            background-color: #dc3545;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        /* Container for the two boxes with shadow */
        .container {
            position: absolute;
            top: 300px; /* Distance from the top of the page */
            left: 220px; /* Distance from the left of the page */
            width: 80%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            padding-top: 50px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Shadow for the whole container */
            border-radius: 10px; /* Optional: for rounded corners */
            background-color: #fff; /* Set background color for the container */
        }

        .box {
            width: 48%;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<!-- Welcome message at the top left -->
<div class="user-info">
    Welcome to the system: <?php echo $user_email; ?>
</div>

<!-- Logout Button -->
<a href="logout.php" class="logout">Logout</a>

<!-- Container to hold both sections (Register a Student and Add a Subject) -->
<div class="container">
    <!-- Register a Student Section (Left) -->
    <div class="box">
        <h2>Register a Student</h2>
        <p>This section allows you to register a new student in the system. Click the button below to proceed with the registration process.</p>
        <a href="add_subject.php" class="button">Add Subject</a>
    </div>

    <!-- Add a Subject Section (Right) -->
    <div class="box">
        <h2>Add a Subject</h2>
        <p>This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
        <a href="register.php" class="button">Register</a>
    </div>
</div>

</body>
</html>
