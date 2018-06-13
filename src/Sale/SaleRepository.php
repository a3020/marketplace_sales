<?php

namespace A3020\MarketplaceSales\Sale;

use A3020\MarketplaceSales\Entity\Sale;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class SaleRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    
    /**
     * @var EntityRepository
     */
    private $repository;

    public function __construct(EntityManager $entityManager, EntityRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function store(Sale $entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    /**
     * @return Sale[]
     */
    public function get()
    {
        return $this->repository->findAll();
    }
}
