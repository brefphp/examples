<?php

namespace App\Message;

class Ping
{
    public function __construct(
        private string $data,
    ) {}

    public function getData(): string
    {
        return $this->data;
    }
}