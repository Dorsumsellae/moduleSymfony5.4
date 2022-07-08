<?php

namespace App\Controller;

use App\Entity\Ville;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadTablesController extends AbstractController
{
    #[Route('/read_tables', name: 'app_read_tables')]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('read_tables/index.html.twig', [
            'controller_name' => 'ReadTablesController',
            'villes' => $this->getVilles($doctrine),
        ]);
    }


    private function getVilles(ManagerRegistry $doctrine)
    {

        $repo = $doctrine->getRepository(Ville::class);
        $villes = $repo->findAll();
        return $villes;
    }
}
