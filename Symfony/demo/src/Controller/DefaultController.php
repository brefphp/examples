<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController
{
    #[Route('/')]
    public function hello(): Response
    {
        return new Response(
            'Hello world!'
        );
    }
}
