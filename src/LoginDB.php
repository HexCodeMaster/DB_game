<?php

namespace Mastermind;

use PDO;

require_once 'Db.php';

class LoginDB extends Db
{
    /**
     * Verify the user login credentials.
     *
     * @param string $user_email
     * @param string $user_pwd
     * @return bool True if login is successful, otherwise false.
     * @throws \Exception
     */
    public function verifyUser(string $user_email, string $user_pwd): bool
    {
        // Prepare the SQL statement
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE user_email = ?');

        // Execute the statement with the email parameter
        $stmtExecuted = $stmt->execute([$user_email]);

        // Check if the query was executed successfully
        if (!$stmtExecuted) {
            // If execution fails, close the statement and throw an exception
            $stmt = null;
            throw new \Exception("Database error: Unable to execute statement");
        }

        // Fetch the user data from the result set
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify if the user exists and the password matches
        if ($user && password_verify($user_pwd, $user['user_pwd'])) {
            // Start session if not already started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION["user_email"] = $user["user_email"];
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["username"] = $user["username"];

            // Close the statement
            $stmt = null;
            return true;
        }

        // Close the statement
        $stmt = null;
        return false;
    }
}
