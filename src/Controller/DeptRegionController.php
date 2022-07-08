<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Region;
use App\Entity\Departement;

class DeptRegionController extends AbstractController
{
    #[Route('/dept_region', name: 'app_dept_region')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $data = $this->getDataFromCSV('/Users/nicolasmouton-besson/Desktop/LDNR/symfony/moduleSymfony/public/assets/files/geo_france.csv');
        $line = $data[0];
        $this->departementCsvToBDD($doctrine, $data);
        return $this->render('dept_region/index.html.twig', [
            'controller_name' => 'DeptRegionController',
            'data'=> explode("\t",$line[0]),
        ]);
    }

    private function regionCsvToBDD(ManagerRegistry $doctrine, $data)
    {
        $repo = $doctrine->getManager();
        foreach ($data as $line) {
            $dataLine = $line[0];
            $newRegion = $this->stringToRegion($dataLine);
            $repo->persist($newRegion);
        }
        $repo->flush();
    }

    private function departementCsvToBDD(ManagerRegistry $doctrine, $data)
    {
        $repo = $doctrine->getManager();
        foreach ($data as $line) {
            $dataLine = $line[0];
            $newDepartement = $this->stringToDepartement($dataLine, $doctrine);
            $repo->persist($newDepartement);
        }
        $repo->flush();
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

    private function stringToRegion(String $data) : Region
    {
        $dataArray = explode("\t", $data);
        $newRegion =  new Region();
        $newRegion->setNom($dataArray[2]);
        return $newRegion;
    }

    public function stringToDepartement(String $data, ManagerRegistry $doctrine) : Departement
    {
        $doc_db = $this->getDoctrine()->getRepository(Region::class);
        $dataArray = explode("\t", $data);
        $region = $doc_db->findOneByNom($dataArray[2]);
        $newDepartement = new Departement();
        $newDepartement->setNom($dataArray[0])
                        ->setCode((int)$dataArray[1])
                        ->setRegion($region);
        return $newDepartement;
    }
}
