<?php

namespace App\Domain;

class Beer
{
    public function __construct(
    ){
    }

    public function id(): string
    {
        return $this->id;
    }
    public function name(): string
    {
        return $this->name;
    }
    public function descripcion(): string
    {
        return $this->descripcion;
    }
}