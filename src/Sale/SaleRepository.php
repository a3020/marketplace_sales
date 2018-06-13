<?php

namespace A3020\MarketplaceSales\Sale;

use A3020\MarketplaceSales\Entity\Sale;
use Doctrine\ORM\EntityManager;

class SaleRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function store(Sale $entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
