<?php

namespace Mastermind;

class Pin
{
    private $color;
    public static $colors = ['red', 'green', 'blue', 'yellow', 'orange', 'purple'];
    public static $availablePins = [];

    public function __construct($color)
    {
        $this->color = $color;
        self::$availablePins[] = $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function showPin(): string
    {
        $value = 25;
        $length = 50;
        $radius = 20;

        return "<svg width=\"$length\" height=\"$length\">
                <circle cx=\"$value\" cy=\"$value\" r=\"$radius\"
                style=\"fill:{$this->getColor()};stroke-width:10;stroke:rgb(0,0,0)\" />
            </svg>";
    }
}