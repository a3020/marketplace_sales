<?php

namespace A3020\MarketplaceSales\Ajax;

use A3020\Gdpr\BlockType\Scanner;
use A3020\Gdpr\BlockType\Usage;
use A3020\Gdpr\Controller\AjaxController;
use A3020\Gdpr\Entity\BlockScanStatus;
use A3020\Gdpr\Scan\Block\StatusRepository;
use A3020\MarketplaceSales\Sale\SaleRepository;
use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Http\Response;
use Concrete\Core\Http\ResponseFactory;
use Concrete\Core\Support\Facade\Url;
use Concrete\Core\View\View;
use Exception;

class Sales extends AjaxController
{
    public function view()
    {
        $json['data'] = $this->getRecords();

        return $this->app->make(ResponseFactory::class)->json($json);
    }

    /**
     * Return a list of pages with blocks that might contain user data
     *
     * @return array
     */
    private function getRecords()
    {
        $records = [];

        /** @var SaleRepository $saleRepository */
        $saleRepository = $this->app->make(SaleRepository::class);

        foreach ($saleRepository->get() as $sale) {
            $records[] = [
                'order_number' => $sale->getOrderNumber(),
                'package_handle' => $sale->getPkgHandle(),
                'package_name' => $sale->getPkgName(),
                'username' => $sale->getUsername(),
                'user_id' => $sale->getId(),
                'sold_at' => $sale->getSoldAt()->format('Y-m-d'),
                'amount' => $sale->getAmount(),
            ];
        }

        return $records;
    }
}
