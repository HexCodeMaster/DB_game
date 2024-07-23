<?php


namespace Mastermind;

require_once 'Db.php';

class SignupDB extends Db
{

    public function createUser($user_id, $username, $user_pwd, $user_email)
    {
        // First, check if the user already exists
        if (!$this->checkUser($user_id, $user_email)) {
            header("Location: ../index.php?usertaken");
            exit();
        }

        // If the user doesn't exist, proceed to insert the new user
        $stmt = $this->connect()->prepare('INSERT INTO users (user_id, username, user_pwd, user_email, created_at) VALUES (?, ?, ?, ?, NOW())');

        // Hash the password before storing it
        $hashedPwd = password_hash($user_pwd, PASSWORD_DEFAULT);

        // Execute the prepared statement with parameters
        $stmtExecuted = $stmt->execute([$user_id, $username, $hashedPwd, $user_email]);

        // Check if the query was executed successfully
        if (!$stmtExecuted) {
            // If execution fails, redirect and exit
            $stmt = null;
            header("Location: ../index.php?stmtfailed");
            exit();
        }

        // Close the statement
        $stmt = null;

        // Return true to indicate the user was successfully created
        return true;
    }

    public function checkUser($user_id, $user_email)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE user_id = ? OR user_email = ?;');

        // Execute the prepared statement with parameters
        $stmtExecuted = $stmt->execute([$user_id, $user_email]);

        // Check if the query was executed successfully
        if (!$stmtExecuted) {
            // If execution fails, redirect and exit
            $stmt = null;
            header("Location: ../index.php?action=signup&error=stmt failed");
            exit();
        }


        // Check if a matching user is found
        $userExists = $stmt->rowCount() > 0;

        // Close the statement
        $stmt = null;

        // Return false if user found, true otherwise
        return !$userExists;
    }
}
