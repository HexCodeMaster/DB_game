<?php
namespace Mastermind;
require_once 'Db.php';
class Game extends Db
{
    private Board $board;
    private int $attempts = 0;
    private array $guesses = [];
    private int $maxAttempts = 10;
    public array $userScores =[];
    public function __construct()
    {
        $this->board = new Board();
        // reset Pins
        Pin::$availablePins = [];
        // pinnen aanmaken
        foreach(Pin::$colors as $color) {
            new Pin($color);
        }
    }

    public function setBoard(int $amount): void
    {
        for($i = 0; $i < $amount; $i++) {
            $this->board->addPin(Pin::$availablePins[rand(0, count(Pin::$availablePins) - 1)]);
        }
        $this->maxAttempts = ceil(($amount * count(Pin::$colors)) / 2);
    }

    public function getBoard(): Board
    {
        return $this->board;
    }

    public function addGuess(array $pinColors): void
    {
        // Guess aanmaken
        $guess = new Guess($pinColors);

        // guess vergelijken met board
        $result = $this->board->compareGuess($guess);
        $guess->setResult($result);

        $this->guesses[] = $guess;
        $this->attempts++;
    }

    public function getGuesses(): array
    {
        return $this->guesses;
    }

    public function isWinner(): bool
    {
        return $this->board->isSolved() || $this->attempts >= $this->maxAttempts;
    }

    public function isGameOver(): bool
    {
        return $this->board->isSolved() || $this->attempts >= $this->maxAttempts;
    }

    public function getAttempts(): int
    {
        return $this->attempts;
    }

    public function updateGameScore(string $username, string $user_id, int $game_score): void
    {
        // Prepare SQL statement to insert the new score
        $stmt = $this->connect()->prepare("INSERT INTO user_scores (user_id, username, game_score) VALUES (:user_id, :username, :game_score)");

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':game_score', $game_score, \PDO::PARAM_INT);

        // Execute the statement
        $stmt->execute();
    }
    public function scoreBored(): array
    {
        try {
            $stmt = $this->connect()->prepare("SELECT  user_id, username, game_score FROM user_scores");
            $stmt->execute();
            $userScores = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            error_log(print_r($userScores, true)); // Add this line to debug the fetched data
            return $userScores;
        } catch (\PDOException $e) {
            // Handle exception and log the error
            error_log('Query error: ' . $e->getMessage());
            return [];
        }
    }


}
