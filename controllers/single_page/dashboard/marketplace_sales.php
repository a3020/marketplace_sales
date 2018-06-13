<?php

namespace Concrete\Package\MarketplaceSales\Controller\SinglePage\Dashboard;

use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Routing\Redirect;

final class MarketplaceSales extends DashboardPageController
{
    public function view()
    {
        return Redirect::to('/dashboard/marketplace_sales/search');
    }
}
