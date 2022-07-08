<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Departement;

class ReadJoinController extends AbstractController
{
    #[Route('/read_join/{departement}', name: 'app_read_join')]
    public function index(String $departement='', ManagerRegistry $doctrine): Response
    {
        $departements = $this->getDepartement($departement,$doctrine);
        return $this->render('read_join/index.html.twig', [
            'controller_name' => 'ReadJoinController',
            'departements'=> $departements,
            'departementSearch'=>$departement,
        ]);
    }

    private function getDepartement(String $departementName, ManagerRegistry $doctrine)
    {
        $repo = $doctrine->getRepository(Departement::class);
        if ($departementName == '') {
            $departement = $repo->findAll();
        } else {
            $departement = $repo->findByNom($departementName);
        }
        return $departement; 
    }
}
