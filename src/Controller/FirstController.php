<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }

    #[Route('/bonjour', name: 'test_mano')]
    public function Bonjour(): Response
    {
        return new Response("<h1>Bonjour à toutes et à tous !</h1>");
    }
}
