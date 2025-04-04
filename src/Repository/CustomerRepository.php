<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Customer>
 */
class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function findAllCustomers()
    {
        //J'ai limité le nombre de résultats à 1000 pour éviter que le navigateur crash avec les 100 000 lignes à afficher
        return $this->createQueryBuilder('c')
            ->setMaxResults(1000)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

}
