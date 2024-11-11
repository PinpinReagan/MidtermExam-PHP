<?php
// Function to validate email
function validateEmail($email) {
    global $emailError;
    if (empty($email)) {
        $emailError = "• Email is required.";
        return false;
    } elseif (strpos($email, '@') === false) {
        $emailError = "• Invalid email.";
        return false;
    }
    return true;
}

// Function to validate password
function validatePassword($password) {
    global $passwordError;
    if (empty($password)) {
        $passwordError = "• Password is required.";
        return false;
    }
    return true;
}

// Function to check if user exists in predefined users array
function authenticateUser($email, $password, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            return true; // User found
        }
    }
    return false; // User not found
}
?>
