<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestVueTwigController extends AbstractController
{
    #[Route('/test_vue', name: 'app_test_vue_twig')]
    public function index(): Response
    {
        return $this->render('test_vue_twig/index.html.twig', [
            'controller_name' => 'TestVueTwigController',
            'name' => 'Mouton--Besson',
            'firstName' => 'Nicolas',
        ]);
    }
}
