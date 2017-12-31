<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 22.11.2017
 * Time: 11:10
 */

namespace AppBundle\Entity;


use AppBundle\Model\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="auction")
 */
class Auction extends AbstractEntity
{
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Product", inversedBy="auction")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="auctionCollection")
     * @ORM\JoinColumn(name="seller_id", referencedColumnName="id")
     */
    private $seller;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PurchaseOffer", mappedBy="auction")
     */
    private $purchaseOfferCollection;
    /**
     * @ORM\Column(type="datetime")
     */
    private $expiresAt;



    public function __construct()
    {
        $this->purchaseOfferCollection = new ArrayCollection();
    }


    function prePersistAction()
    {
        // TODO: Implement prePersistAction() method.
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }


    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }


    /**
     * @return User $seller
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param User $seller
     */
    public function setSeller(User $seller)
    {
        $this->seller = $seller;
    }

    /**
     * @return mixed
     */
    public function getPurchaseOfferCollection()
    {
        return $this->purchaseOfferCollection;
    }

    /**
     * @return \DateTime $expiresAt
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param \DateTime $expiresAt
     */
    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }



}