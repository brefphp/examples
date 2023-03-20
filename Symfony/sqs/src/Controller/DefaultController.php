<?php

namespace App\Controller;

use App\Message\Ping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class DefaultController extends AbstractController
{
    public function index(MessageBusInterface $bus): Response
    {
        $bus->dispatch(new Ping('foobar'));

        return new Response('Sent ping... Check the logs.');
    }
}