<?php

namespace Mastermind;

class Guess
{
    private array $pins = [];
    private array $result = ['correct_position' => 0, 'correct_color' => 0, 'incorrect' => 0];


    public function __construct(array $pinColors)
    {
        $this->pins = $pinColors;
    }

    public function getPins(): array
    {
        return $this->pins;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function getCorrectPosition(): int
    {
        return $this->result['correct_position'];
    }

    public function getCorrectColor(): int
    {
        return $this->result['correct_color'];
    }

    public function getIncorrect(): int
    {
        return $this->result['incorrect'];
    }

    public function setResult(array $result): void
    {
        foreach ($result as $value) {
            switch ($value) {
                case 'correct_position':
                    $this->result['correct_position']++;
                    break;
                case 'correct_color':
                    $this->result['correct_color']++;
                    break;
                case 'incorrect':
                    $this->result['incorrect']++;
                    break;
            }
        }
    }
}