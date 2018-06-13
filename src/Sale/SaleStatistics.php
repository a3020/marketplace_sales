<?php

namespace A3020\MarketplaceSales\Sale;

use Concrete\Core\Database\Connection\Connection;
use Doctrine\ORM\EntityRepository;

class SaleStatistics
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var EntityRepository
     */
    private $repository;

    public function __construct(Connection $connection, EntityRepository $repository)
    {
        $this->connection = $connection;
        $this->repository = $repository;
    }

    public function getTotalRevenue()
    {
        return (int) $this->connection->fetchColumn("SELECT SUM(amount) FROM MarketplaceSalesSales");
    }

    public function getTotalRevenueYear()
    {
        return (int) $this->connection->fetchColumn("SELECT SUM(amount) FROM MarketplaceSalesSales WHERE YEAR(soldAt) = YEAR(NOW())");
    }

    public function getTotalRevenueMonth()
    {
        return (int) $this->connection->fetchColumn("SELECT SUM(amount) FROM MarketplaceSalesSales WHERE soldAt between (CURDATE() - INTERVAL 1 MONTH ) and CURDATE()");
    }

    public function getTotalSales()
    {
        return (int) $this->connection->fetchColumn("SELECT COUNT(1) FROM MarketplaceSalesSales");
    }
}
