<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Check if a file was uploaded
if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    // Specify the directory where uploaded files will be stored
    $uploadDir = 'uploads/';

    // Generate a unique filename to prevent overwriting existing files
    $fileName = uniqid() . '_' . basename($_FILES['profile_picture']['name']);

    // Build the full path to the file
    $filePath = $uploadDir . $fileName;

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $filePath)) {
        // Store the file path in the session
        $_SESSION['profile_picture'] = $filePath;
    } else {
        // Handle file upload error
        echo "Error uploading file.";
    }
} else {
    // Handle file upload error
    echo "Error: " . $_FILES['profile_picture']['error'];
}
?>
