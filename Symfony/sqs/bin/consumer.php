<?php declare(strict_types=1);

use Bref\Messenger\Service\BrefWorker;

require dirname(__DIR__) . '/config/bootstrap.php';

lambda(function ($event) {
    $kernel = new \App\Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
    $kernel->boot();

    $worker = $kernel->getContainer()->get(BrefWorker::class);
    $worker->consumeLambdaEvent($event);
});