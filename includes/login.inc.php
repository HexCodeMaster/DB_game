<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['submit'])) {
        // Grabbing and sanitizing data
        $user_email = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL);
        $user_pwd = filter_input(INPUT_POST, 'user_pwd', FILTER_SANITIZE_STRING);

        // Check if all fields are provided
        if (empty($user_email) || empty($user_pwd)) {
            header("Location: ../index.php?action=login&error=allfieldsrequired");
            exit();
        }

        // Instantiate LoginDB class
        require_once "../src/LoginDB.php";

        $loginDB = new \Mastermind\LoginDB();

        // Attempt user authentication
        try {
            if ($loginDB->verifyUser($user_email, $user_pwd)) {
                // If authentication succeeds, redirect to a success page
                header("Location: ../index.php?action=home");
                exit();
            } else {
                // If authentication fails, redirect back to login page with error message
                header("Location: ../login.php?action=login&error=loginfailed");
                exit();
            }
        } catch (\Exception $e) {
            // If an error occurs, redirect back to login page with error message
            header("Location: ../login.php?action=login&error=databaseerror");
            exit();
        }
    }
}

// Redirect if form submission is invalid
header("Location: ../login.php?action=login&error=invalidsubmission");
exit();
