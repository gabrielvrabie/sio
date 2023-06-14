<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/first', name: 'first', methods: ['GET'])]
class FirstAction
{
    public function __invoke(Request $request): Response
    {
        return new Response('Hello world! (from PHP 8.0)');
    }
}
