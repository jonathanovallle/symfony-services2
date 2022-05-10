<?php

namespace App\Application;

class FindBeersQuery
{
    public function __construct(string $food)
    {
        $this->food = $food;
    }

    public function food(): string
    {
        return $this->food;
    }
}