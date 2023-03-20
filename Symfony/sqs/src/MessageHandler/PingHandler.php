<?php

namespace App\MessageHandler;

use App\Message\Ping;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class PingHandler implements MessageHandlerInterface
{
    public function __construct(
        private LoggerInterface $logger,
    ) {}

    public function __invoke(Ping $message)
    {
        $this->logger->alert('Received Ping message with data: '.$message->getData());
    }
}