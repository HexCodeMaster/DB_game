<?php
header("Location: ../index.php?action=home");
session_start();

// Check if the user is logged in by verifying if a session variable exists
if(isset($_SESSION['user_id'])) {
    // If the session exists, destroy it to log the user out
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session data from the server

    // Redirect to the login page after logging out
    header("Location:../index.php?action=login");
    // Exit the script to prevent further execution
} else {
    // If the session does not exist, redirect to the login page
    header("Location: ../index.php?action=login");
    // Exit the script to prevent further execution
}
exit();
