<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(String $nom = 'Mouton--Besson', String $prenom = 'Nicolas', Int $age = 28): JsonResponse
    {
        return new JsonResponse(
            [
                "nom" => $nom,
                "prenom" => $prenom,
                "age" => $age
            ]
        );
    }
}
