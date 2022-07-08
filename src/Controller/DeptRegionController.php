<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use App\Entity\Region;

class DeptRegionController extends AbstractController
{
    #[Route('/dept_region', name: 'app_dept_region')]
    public function index(): Response
    {
        return $this->render('dept_region/index.html.twig', [
            'controller_name' => 'DeptRegionController',
            'data'=>$this->getDataFromCSV('/Users/nicolasmouton-besson/Desktop/LDNR/symfony/moduleSymfony/public/assets/files/geo_france.csv'),
        ]);
    }

    private function getDataFromCSV(String $csvPath)
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        try {
            $result = $serializer->decode(file_get_contents($csvPath), 'csv', [
                CsvEncoder::DELIMITER_KEY => ';',
                CsvEncoder::NO_HEADERS_KEY => true,
            ]);
        } catch (Exception $e) {
           $result = 'Exception reçue : '.  $e->getMessage(). "\n";
        }
        return $result;
    }

    private function stringToRegion(String $data)
    {
        $dataArray = explode('\t', $data);
        return new Region()->set
    }
}
