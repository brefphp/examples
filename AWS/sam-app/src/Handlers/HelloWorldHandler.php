<?php

namespace Bref\SamApp\Handlers;

use Bref\Context\Context;
use Bref\Event\Handler;

class HelloWorldHandler implements Handler
{
    public function handle(mixed $event, Context $context)
    {
        return json_encode([
            "message" => "Hello World!"
        ]);
    }
}