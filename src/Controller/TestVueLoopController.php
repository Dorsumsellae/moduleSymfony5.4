<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestVueLoopController extends AbstractController
{
    #[Route('/test_vue_loop', name: 'app_test_vue_loop')]
    public function index(): Response
    {
        return $this->render('test_vue_loop/index.html.twig', [
            'peopleArray' => $this->peopleArray,
        ]);
    }


    private $peopleArray = [
        [
            'name' => 'Mouton--Besson',
            'firstname' => 'Nicolas',
            'age' => 28
        ],
        [
            'name' => 'Duchesne',
            'firstname' => 'Jean',
            'age' => 28
        ],
        [
            'name' => 'Garofalo',
            'firstname' => 'Marion',
            'age' => 27
        ],
        [
            'name' => 'Mouton--Besson',
            'firstname' => 'Margaux',
            'age' => 24
        ],
    ];
}
