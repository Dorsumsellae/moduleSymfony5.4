<?php

namespace App\Controller;

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


    public function showRoute($url): Response
    {
        $strg = sprintf("<h3>route corespondant à <samp>%s</samp></h3>\n", htmlspecialchars($url));
        try {
            $params = $this->get('router')->match($url);
            $strg .= sprintf("<pre>%s</pre>", print_r($params, true));
        } catch (\Symfony\Component\Routing\Exception\ResourceNotFoundException $e) {
            $strg = sprintf("<h3>aucune route ne correspond à <samp>%s</samp></h3>\n", htmlspecialchars($url));
            $strg .= sprintf("<p>le message d'erreur :<p><pre>%s</pre>\n", $e);
            $strg .= "<h4>Fin du message</h4>\n";
        }
        return new Response($strg);
    }

    #[Route('/lieux/{pays}/{ville}', name: 'lieux')]
    public function Lieux(String $pays = 'France', String $ville = 'Toulouse'): JsonResponse
    {
        return new JsonResponse([
            'pays' => $pays,
            'ville' => $ville,
        ]);
    }
}
