<?php

namespace A3020\MarketplaceSales\Installer;

use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Logging\Logger;
use Exception;

class Uninstaller
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Connection $connection, Logger $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
    }

    public function uninstall()
    {
        try {
            $this->connection->executeQuery("DROP TABLE IF EXISTS MarketplaceSalesSales");
        } catch (Exception $e) {
            $this->logger-addDebug($e->getMessage());
        }
    }
}
