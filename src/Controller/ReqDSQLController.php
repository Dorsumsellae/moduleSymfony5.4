<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReqDSQLController extends AbstractController
{
    #[Route('/req_dsql/{nameField}/{minValue}/{maxValue}/{order}', name: 'app_req_dsql')]
    public function index(String $nameField, Int $minValue, Int $maxValue, String $order='DESC'): Response
    {
        return $this->render('read_tables/index.html.twig', [
            'controller_name' => 'ReqDSQLController',
            'villes'=> $this->Search($nameField, $minValue, $maxValue, $order),
        ]);
    }

    public function Search(String $nameField, Int $minValue, Int $maxValue, String $order='DESC')
    {
        $result = [];
        if ($order == 'ASC' || $order == 'DESC') {
            $query = $this->getDoctrine()->getRepository(\App\Entity\Ville::class)->createQueryBuilder('v')
                ->where('v.' . $nameField . '>' . $minValue)
                ->andWhere('v.' . $nameField . '<' . $maxValue)
                ->orderBy('v.' . $nameField, $order)
                ->getQuery();

            $result = $query->getResult();
        }
        return $result;
    }
}
