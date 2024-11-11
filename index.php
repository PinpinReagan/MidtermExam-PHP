<?php
// Start the session to store session variables if needed
session_start();

// Predefined static users
$users = [
    ['email' => 'user1@example.com', 'password' => 'password1'],
    ['email' => 'user2@example.com', 'password' => 'password2'],
    ['email' => 'user3@example.com', 'password' => 'password3'],
    ['email' => 'user4@example.com', 'password' => 'password4'],
    ['email' => 'user5@example.com', 'password' => 'password5']
];

// Initialize error messages
$emailError = '';
$passwordError = '';
$error = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userFound = false;

    // Check if the email is filled
    if (empty($email)) {
        $emailError = "• Email is required.";
    } elseif (strpos($email, '@') === false) {
        // If the email doesn't contain '@', treat it as an invalid email
        $error = "• Invalid email.";
    }

    // Check if password is filled
    if (empty($password)) {
        $passwordError = "• Invalid email.";  // Correctly show missing password message
    }

    // If email is filled but password is empty, show the "Password is required" message
    if (!empty($email) && empty($password)) {
        $error = "• Password is required."; // Show this message if password is missing
    }

    // If no email or password errors, check user login
    if (empty($emailError) && empty($passwordError) && empty($error)) {
        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                $userFound = true;
                // Store the email in the session under 'user_email'
                $_SESSION['user_email'] = $email; // Store session data
                header('Location: dashboard.php'); // Redirect to dashboard after login
                exit; // Make sure to exit to stop further code execution
            }
        }

        // If no matching user found, set generic error message
        if (!$userFound) {
            $error = "• Invalid email or password."; // Both cases fall under this error message
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            flex-direction: column; /* Arrange items in a column */
        }

        .system-error-box {
            width: 350px;
            max-width: 600px;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            font-size: 15px;
            font-weight: bold;
            text-align: left;
            margin-bottom: 20px;
            box-sizing: border-box;
            line-height: 1.5;
            position: relative;
        }

        .system-error-box button.close-btn {
            position: absolute;
            top: 15px;
            right: 10px;
            background: transparent;
            border: none;
            font-size: 18px;
            font-weight: bold;
            color: #721c24;
            cursor: pointer;
        }

        .login-container {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-container h2 {
            margin: 0 0 20px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <!-- Display system error message at the top of the page -->
    <?php if ($emailError || $passwordError || $error): ?>
        <div class="system-error-box">
            <button class="close-btn" onclick="this.parentElement.style.display='none';">X</button>
            SYSTEM ERROR:
            <?php 
            if ($emailError) echo "<br>" . $emailError;
            if ($passwordError) echo "<br>" . $passwordError;
            if ($error) echo "<br>" . $error; // Show the appropriate error message
            ?>
        </div>
    <?php endif; ?>

    <!-- Login container -->
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="email">Email address</label>
                <!-- Changed type="email" to type="text" so it becomes a regular text input -->
                <input type="text" id="email" name="email" placeholder="Enter email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
    </div>

</body>
</html>
