<?php
require_once 'vendor/autoload.php';
ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);

use Mastermind\Db;
use Mastermind\Game;
use Mastermind\Board;
use Mastermind\Pin;
use Mastermind\SignupContr;
use Mastermind\Mysql;
use Mastermind\SignupDB;

session_start();
$user_id = $_SESSION['user_id'] ?? null;

// Database connection
$database = new Db();

// Retrieve session data
$user_id = $_SESSION['user_id'] ?? null;
$username = $_SESSION['username'] ?? null;
$game = $_SESSION['game'] ?? new Game();
$action = $_GET['action'] ?? 'home';

// Initialize Smarty template engine
$template = new Smarty();
$template->setTemplateDir('templates');
$template->clearCompiledTemplate();
$template->clearAllCache();

// Fetch user scores from the database
$userScores = $game->scoreBored();

// Debugging output
error_log(print_r($userScores, true)); // Add this line to debug the assigned data

// Assign the user scores to the template
$template->assign('userScores', $userScores);
//var_dump($userScores); // Add this line to dump the contents of $userScores
// Initialize chosen pins array with black pins

// Check if there are any errors stored in the session
$errors = $_SESSION['errors'] ?? [];

// Function to display error messages
function displayErrors($errors) {
    if (!empty($errors)) {
        echo '<div id="error-box" style="color: red;">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
        // Clear errors from session after displaying them
        unset($_SESSION['errors']);
    }
}

// Main switch-case to handle different actions
switch ($action) {
    case "startGameForm":
        $template->display('startGameForm.tpl');
        break;
    case "home":
        $template->display('index.tpl');
        break;
    case "login":
        displayErrors($errors);
        $template->display('login.tpl');
        break;
    case "logout":
        session_destroy();
        header("Location: index.php");
        exit();
        break;
    case "signup":
        $template->display('signup.tpl');
        break;
    case "forgot":
        $template->display('forgot.tpl');
        break;
    case "form":
        header("Location: src/register.php");
        exit();
        break;
    case "startGame":
        $game = new Game();
        $game->setBoard((int)$_POST['amount']);
        $_SESSION['game'] = $game;
    // No break statement to continue to "showGame"
    case "showGame":
        // Assign game data to the template
        $template->assign('game', $game);
        $template->assign('colors', Pin::$colors);
        $template->assign('pinsToGuess', $game->getBoard()->getPins());

        $chosenPins = [];
        foreach ($game->getBoard()->getPins() as $pin) {
            $chosenPins[] = new Pin('black');
        }
        $template->assign('chosenPins', $chosenPins);

        // Check if the game is won
        if ($game->isWinner()) {
            $template->assign('winner', true);
            $template->assign('attempts', $game->getAttempts());

            // Ensure $user_id and $username are set
            if (isset($user_id) && isset($username)) {
                $new_score = 200; // Assume this value comes from the game logic
                $game->updateGameScore($username, (string)$user_id, $new_score);
            } else {
                // Handle the case where $user_id or $username is not set
                error_log('User ID or username is not set.');
                header("Location: ../index.php?action=error&message=user_not_found");
                exit();
            }
        } else {
            $template->assign('winner', false);
        }

        // Display the game board template
        $template->display('board.tpl');
        break;


    case "addGuess":
        if (!empty($_POST['pin_colors'])) {
            $game->addGuess($_POST['pin_colors']);
        }
        header("Location: index.php?action=showGame");
        exit();
        break;
    default:
        $template->display('index.tpl');
}
// Debugging code
//var_dump($user_id); // This should print the user ID retrieved from the session
//var_dump($username); // This should print the username retrieved from the session
