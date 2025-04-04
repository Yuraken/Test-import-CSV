<?php

namespace App\Service;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;

class CsvImporter
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function import(string $csvFile)
    {
        //Allocation de plus de mémoire pour traiter un gros fichier CSV
        ini_set('memory_limit', '1G');
       
        $reader = Reader::createFromPath($csvFile, 'r');
        $reader->setHeaderOffset(0); // Skip de l'index du fichier CSV
        $records = $reader->getRecords(); 
        $counter = 0; 

        foreach ($records as $record) {
           //Récupération des infos de la ligne du CSV et insertion via les setter de l'entité Customer
            $customer = new Customer();
            $customer->setCustomerId($record['Customer Id']);
            $customer->setFirstName($record['First Name']);
            $customer->setLastName($record['Last Name']);
            $customer->setCompany($record['Company']);
            $customer->setCity($record['City']);
            $customer->setCountry($record['Country']);
            $customer->setPhoneOne($record['Phone 1']);
            $customer->setPhoneTwo($record['Phone 2']);
            $customer->setEmail($record['Email']);
            $customer->setSubscriptionDate($record['Subscription Date']);
            $customer->setWebsite($record['Website']);

            $this->entityManager->persist($customer);

            $counter++;

            // Sauvegarder en base de données toutes les 500 lignes sauvegardées puis un clear de l'entité pour éviter la surcharge de mémoire
            if ($counter == 500) {
                $this->entityManager->flush();
                $this->entityManager->clear();
                $counter = 0;
            }
        }

        

        // Sauvegarder en base de données des dernières lignes si le dernier batch n'a pas atteint les 500 lignes
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}