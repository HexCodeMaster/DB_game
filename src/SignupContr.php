<?php
namespace Mastermind;

require_once 'SignupDB.php';
SESSION_START();
class SignupContr
{

    private string $user_id;
    private string $username;
    private string $user_pwd;
    private string $user_email;
    private string $pwdRepeat;

    public function __construct(string $user_id, string $username, string $user_pwd, string $user_email, string $pwdRepeat)
    {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->user_pwd = $user_pwd;
        $this->user_email = $user_email;
        $this->pwdRepeat = $pwdRepeat;
    }

    public function signupUser()
    {
        $errors = [];
        if ($this->emptyInput()) {

            $errors[] = "Empty input!";
            header("Location: ../index.php?action=signup&Empty inputs");
            exit();
        }

        if (!$this->invalidUserId()) {

            $errors[] = "Invalid user ID!";
            header("Location: ../index.php?action=signup&error=invalid userid");
            exit();
        }

        if ($this->userTakenCheck()) {
            $errors[] = "Email_taken!";
            header("Location: ../index.php?action=signup&error=user is taken");
            exit();
        }

        if (!$this->invalidEmail()) {
            $errors[] = "Invalid email!";
            header("Location: ../index.php?action=signup&error=invalidate");
            exit();
        }

        if (!$this->pwdMatch()) {

            $errors[] = "Passwords do not match!";
            header("Location: ../index.php?action=signup&error=password mismatch");
            exit();
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: ../index.php?action=signup");
            exit();
        }
        $signupDB = new SignupDB();
        $signupDB->createUser($this->user_id, $this->username, $this->user_pwd, $this->user_email);
    }

    private function emptyInput(): bool
    {
        return empty($this->user_id) || empty($this->username) || empty($this->user_pwd) || empty($this->user_email) || empty($this->pwdRepeat);
    }

    private function invalidUserId(): bool
    {
        return preg_match("/^[a-zA-Z0-9]*$/", $this->user_id);
    }

    private function invalidEmail(): bool
    {
        return filter_var($this->user_email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function pwdMatch(): bool
    {
        return $this->user_pwd === $this->pwdRepeat;
    }

    private function userTakenCheck(): bool
    {
        $signupDB = new SignupDB();
        return !$signupDB->checkUser($this->user_id, $this->user_email);
    }
}
