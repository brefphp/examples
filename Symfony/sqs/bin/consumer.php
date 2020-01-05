<?php declare(strict_types=1);

use Bref\Messenger\Sqs\SqsConsumer;

require dirname(__DIR__) . '/config/bootstrap.php';

lambda(function ($event) {
    $kernel = new \App\Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
    $kernel->boot();

    $sqsConsumer = $kernel->getContainer()->get(SqsConsumer::class);
    $sqsConsumer->consumeLambdaEvent($event);
});