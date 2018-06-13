<?php

namespace A3020\MarketplaceSales\Provider;

use Concrete\Core\Foundation\Service\Provider;
use Doctrine\ORM\EntityManager;

final class MarketplaceSalesProvider extends Provider
{
    /**
     * Registers the services provided by this provider.
     */
    public function register()
    {
        $this->bindings();
    }

    private function bindings()
    {
        $this->app->when(\A3020\MarketplaceSales\Sale\SaleRepository::class)
            ->needs(\Doctrine\ORM\EntityRepository::class)
            ->give(function(){
                return $this->app->make(EntityManager::class)
                    ->getRepository(\A3020\MarketplaceSales\Entity\Sale::class);
            });
    }
}
