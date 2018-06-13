<?php

namespace A3020\MarketplaceSales\Provider;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\Routing\RouterInterface;
use Doctrine\ORM\EntityManager;

final class MarketplaceSalesProvider implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * Registers the services provided by this provider.
     */
    public function register()
    {
        $this->bindings();
        $this->registerRoutes();
    }

    private function registerRoutes()
    {
        $this->router->registerMultiple([
            '/ccm/system/marketplace_sales/sales' => [
                '\A3020\MarketplaceSales\Ajax\Sales::view',
            ],
        ]);
    }

    private function bindings()
    {
        $this->app->when(\A3020\MarketplaceSales\Sale\SaleRepository::class)
            ->needs(\Doctrine\ORM\EntityRepository::class)
            ->give(function(){
                return $this->app->make(EntityManager::class)
                    ->getRepository(\A3020\MarketplaceSales\Entity\Sale::class);
            });

        $this->app->when(\A3020\MarketplaceSales\Sale\SaleStatistics::class)
            ->needs(\Doctrine\ORM\EntityRepository::class)
            ->give(function(){
                return $this->app->make(EntityManager::class)
                    ->getRepository(\A3020\MarketplaceSales\Entity\Sale::class);
            });
    }
}
