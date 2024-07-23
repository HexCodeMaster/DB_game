<?php

namespace Mastermind;

class Board
{
    private array $pins = [];
    private bool $isSolved = false;

    private array $guesses = [];

    public function addPin(Pin $pin): void
    {
        $this->pins[] = $pin;
    }

    public function getPins(): array
    {
        return $this->pins;
    }

    public function compareGuess(Guess $guess): array
    {
        $result = [];

        // Vergelijk elke pin in de guess met de overeenkomstige pin in het geheime patroon
        for ($i = 0; $i < count($this->pins); $i++) {
            $secretPin = $this->pins[$i];
            $guessPin = $guess->getPins()[$i];

            if ($secretPin->getColor() === $guessPin) {
                // Pin is correct geplaatst
                $result[] = 'correct_position';
            } elseif (in_array($guessPin, $this->getPinColors())) {
                // Pin is aanwezig, maar niet op de juiste positie
                $result[] = 'correct_color';
            } else {
                // Pin is niet aanwezig in het geheime patroon
                $result[] = 'incorrect';
            }
        }

        $this->isSolved = $this->getPinColors() === $guess->getPins();

        return $result;
    }

    private function getPinColors(): array
    {
        return array_map(function (Pin $pin) {
            return $pin->getColor();
        }, $this->pins);
    }

    public function isSolved(): bool
    {
        return $this->isSolved;
    }


}