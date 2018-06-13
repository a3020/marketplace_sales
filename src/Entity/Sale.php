<?php

namespace A3020\MarketplaceSales\Entity;

use DateTime;
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
     * @ORM\Column(type="integer", options={"unsigned":true}, nullable=false)
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
     * @ORM\Column(type="string", nullable=false)
     */
    protected $username;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true}, nullable=false)
     */
    protected $userId;

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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param int $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = (int) $orderNumber;
    }

    /**
     * @return string
     */
    public function getPkgHandle()
    {
        return $this->pkgHandle;
    }

    /**
     * @param string $pkgHandle
     */
    public function setPkgHandle($pkgHandle)
    {
        $this->pkgHandle = $pkgHandle;
    }

    /**
     * @return string
     */
    public function getPkgName()
    {
        return $this->pkgName;
    }

    /**
     * @param string $pkgName
     */
    public function setPkgName($pkgName)
    {
        $this->pkgName = $pkgName;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = (int) $userId;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = (float) $amount;
    }

    /**
     * @return DateTime
     */
    public function getSoldAt()
    {
        return $this->soldAt;
    }

    /**
     * @param DateTime $soldAt
     */
    public function setSoldAt($soldAt)
    {
        $this->soldAt = $soldAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
