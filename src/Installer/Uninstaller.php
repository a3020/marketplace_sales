<?php

namespace A3020\MarketplaceSales\Installer;

use Concrete\Core\Database\Connection\Connection;
use Psr\Log\LoggerInterface;
use Exception;

class Uninstaller
{
    /**
     * @var \Concrete\Core\Database\Connection\Connection
     */
    private $connection;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    public function __construct(Connection $connection, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
    }

    public function uninstall()
    {
        try {
            $this->connection->executeQuery("DROP TABLE IF EXISTS MarketplaceSalesSales");
        } catch (Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }
}
