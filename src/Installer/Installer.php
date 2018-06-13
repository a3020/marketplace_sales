<?php

namespace A3020\MarketplaceSales\Installer;

use Concrete\Core\Config\Repository\Repository;
use Concrete\Core\Database\DatabaseStructureManager;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Single;
use Doctrine\ORM\EntityManager;

class Installer
{
    /** @var Repository */
    private $config;

    /** @var EntityManager */
    private $entityManager;

    public function __construct(Repository $config, EntityManager $entityManager)
    {
        $this->config = $config;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Concrete\Core\Package\Package $pkg
     */
    public function install($pkg)
    {
        $this->refreshEntities();
        $this->dashboardPages($pkg);
    }

    private function dashboardPages($pkg)
    {
        $pages = [
            '/dashboard/marketplace_sales' => t('Marketplace Sales'),
            '/dashboard/marketplace_sales/search' => t('Search'),
        ];

        // Using for loop because additional pages
        // may be added in the future.
        foreach ($pages as $path => $name) {
            /** @var Page $page */
            $page = Page::getByPath($path);
            if ($page && !$page->isError()) {
                continue;
            }

            $singlePage = Single::add($path, $pkg);
            $singlePage->update([
                'cName' => $name,
            ]);
        }
    }

    private function refreshEntities()
    {
        $manager = new DatabaseStructureManager($this->entityManager);
        $manager->refreshEntities();
    }
}
