<?php


if (isset($_POST['submit'])) {
    // Grabbing and sanitizing data
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $user_pwd = filter_input(INPUT_POST, 'user_pwd', FILTER_SANITIZE_STRING);
    $pwdRepeat = filter_input(INPUT_POST, 'pwdRepeat', FILTER_SANITIZE_STRING);
    $user_email = filter_input(INPUT_POST, 'user_email', FILTER_VALIDATE_EMAIL);


    // Instantiate SignupContr class
    require_once "../src/Db.php";
    require_once "../src/SignupDB.php";
    require_once "../src/SignupContr.php";

    $user = new \Mastermind\SignupContr($user_id, $username, $user_pwd, $user_email, $pwdRepeat);

    // Running error handler and user signup
    $user->signupUser();

    // Redirecting back to the front page or displaying a success message
    header("Location: ../index.php?action=login&successfully register");
    exit();
} else {

    header("Location: ../index.php?action=signup&allfieldsrequired");
    exit();
}
