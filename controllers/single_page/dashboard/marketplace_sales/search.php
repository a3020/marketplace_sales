<?php

namespace Concrete\Package\MarketplaceSales\Controller\SinglePage\Dashboard\MarketplaceSales;

use A3020\MarketplaceSales\Entity\Sale;
use A3020\MarketplaceSales\Parser\ParseEmail;
use A3020\MarketplaceSales\Sale\SaleRepository;
use A3020\MarketplaceSales\Sale\SaleStatistics;
use Concrete\Core\Error\UserMessageException;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Routing\Redirect;
use Exception;

final class Search extends DashboardPageController
{
    public function view()
    {
        /** @var SaleRepository $saleRepository */
        $saleRepository = $this->app->make(SaleRepository::class);

        /** @var SaleStatistics $saleStatistics */
        $saleStatistics = $this->app->make(SaleStatistics::class);

        $this->set('sales', $saleRepository->get());
        $this->set('totalRevenue', $saleStatistics->getTotalRevenue());
        $this->set('totalRevenueYear', $saleStatistics->getTotalRevenueYear());
        $this->set('totalRevenueMonth', $saleStatistics->getTotalRevenueMonth());
        $this->set('totalSales', $saleStatistics->getTotalSales());
    }
    
    public function add()
    {
        
    }

    public function parse()
    {
        if (!$this->token->validate('marketplace_sales.add_sale')) {
            throw new UserMessageException('Access denied');
        }

        $dh = $this->app->make('helper/form/date_time');
        $soldAt = $dh->translate('soldAt', null, true);

        /** @var ParseEmail $parser */
        $parser = $this->app->make(ParseEmail::class);

        try {
            $data = $parser->parse($this->post('email'));

            $sale = new Sale();
            $sale->setSoldAt($soldAt);
            $sale->setUserId($data['userId']);
            $sale->setUsername($data['username']);
            $sale->setPkgHandle($data['pkgHandle']);
            $sale->setPkgName($data['pkgName']);
            $sale->setOrderNumber($data['orderNumber']);
            $sale->setAmount($data['amount']);

            /** @var SaleRepository $saleRepository */
            $saleRepository = $this->app->make(SaleRepository::class);
            $saleRepository->store($sale);
        } catch (Exception $e) {
            $this->flash('error', $e->getMessage());

            return $this->add();
        }

        $this->flash('success', t('The sale has been added'));

        return Redirect::to('/dashboard/marketplace_sales/search');
    }
}
