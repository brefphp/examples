<?php

namespace Bref\SamApp\Handlers;

use Bref\Context\Context;
use Bref\Event\Handler;

class HelloWorldHandler implements Handler
{
    public function handle(mixed $event, Context $context)
    {
        $message = "No message supplied.";

        if(array_key_exists("message", $event)) {
            $message = $event["message"];
        }

        return json_encode([
            "message" => $message
        ]);
    }
}