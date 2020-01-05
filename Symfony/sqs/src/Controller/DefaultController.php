<?php

declare(strict_types=1);

namespace App\Controller;

use App\Message\Ping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index()
    {
        $this->dispatchMessage(new Ping('foobar'));

        return new Response('Sent ping... Check the logs.');
    }
}