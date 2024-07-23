<?php

namespace Mastermind;

require_once 'LoginDB.php';
session_start();

class LoginContr extends LoginDB
{
    private string $user_pwd;
    private string $user_email;

    public function __construct(string $user_pwd, string $user_email)
    {
        parent::__construct($user_email, $user_pwd); // Call the parent constructor

        $this->user_pwd = htmlspecialchars($user_pwd);
        $this->user_email = htmlspecialchars($user_email);
    }

    public function loginUser(): void
    {
        $errors = [];

        if ($this->emptyInput()) {
            $errors[] = "Empty input!";
        }

        if (!$this->validEmail()) {
            $errors[] = "Invalid email!";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: ../index.php?action=login&status=error");
            exit();
        }

        // Attempt to verify the user
        try {
            if ($this->verifyUser($this->user_email, $this->user_pwd)) {
                // If verification succeeds, start a session and redirect to dashboard
                $_SESSION["user_email"] = $this->user_email;
                header("Location: ../dashboard.php");
            } else {
                // If verification fails, redirect with an error
                $_SESSION['errors'] = ["Invalid login credentials!"];
                header("Location: ../index.php?action=login&status=error");
            }
        } catch (\Exception $e) {
            // Handle any exceptions during verification
            $_SESSION['errors'] = [$e->getMessage()];
            header("Location: ../index.php?action=login&status=error");
        }

        exit();
    }

    private function emptyInput(): bool
    {
        return empty($this->user_pwd) || empty($this->user_email);
    }

    private function validEmail(): bool
    {
        return filter_var($this->user_email, FILTER_VALIDATE_EMAIL) !== false;
    }
}
