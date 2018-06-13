<?php

namespace Concrete\Package\MarketplaceSales;

use A3020\MarketplaceSales\Installer\Installer;
use A3020\MarketplaceSales\Installer\Uninstaller;
use A3020\MarketplaceSales\Provider\MarketplaceSalesProvider;
use Concrete\Core\Package\Package;
use Concrete\Core\Support\Facade\Package as PackageFacade;

final class Controller extends Package
{
    protected $pkgHandle = 'marketplace_sales';
    protected $appVersionRequired = '8.0';
    protected $pkgVersion = '0.9.0';
    protected $pkgAutoloaderRegistries = [
        'src' => '\A3020\MarketplaceSales',
    ];

    public function getPackageName()
    {
        return t('Marketplace Sales');
    }

    public function getPackageDescription()
    {
        return t('Keep track of marketplace sales.');
    }

    public function on_start()
    {
        $provider = $this->app->make(MarketplaceSalesProvider::class);
        $provider->register();
    }

    public function install()
    {
        $pkg = parent::install();

        $installer = $this->app->make(Installer::class);
        $installer->install($pkg);
    }

    public function upgrade()
    {
        parent::upgrade();

        /** @see \Concrete\Core\Package\PackageService */
        $pkg = PackageFacade::getByHandle($this->pkgHandle);

        $installer = $this->app->make(Installer::class);
        $installer->install($pkg);
    }

    public function uninstall()
    {
        $uninstaller = $this->app->make(Uninstaller::class);
        $uninstaller->uninstall();

        parent::uninstall();
    }
}
