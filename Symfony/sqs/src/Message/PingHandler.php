<?php

declare(strict_types=1);

namespace App\Message;

use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class PingHandler implements MessageHandlerInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Ping $message)
    {
        $this->logger->alert('Received Ping message with data: '.$message->getData());
    }
}