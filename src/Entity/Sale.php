<?php

namespace A3020\MarketplaceSales\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *   name="MarketplaceSalesSales",
 * )
 */
class Sale
{
    /**
     * @ORM\Id @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $orderNumber;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $pkgHandle;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $pkgName;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2, nullable=false)
     */
    protected $amount = 0;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $soldAt;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }
}
