<?php
/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 09/12/2017
 * Time: 14:29
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="archive_product")
 */
class ArchiveProduct
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Product", inversedBy="archiveProduct")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="archiveProduct")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $boughtBy;
    /**
     * @ORM\Column(type="datetime")
     */
    private $boughtAt;
    /**
     * @ORM\Column(type="float")
     */
    private $finalPrice;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Product $product
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
     * @return User $boughtBy
     */
    public function getBoughtBy()
    {
        return $this->boughtBy;
    }

    /**
     * @param User $boughtBy
     */
    public function setBoughtBy(User $boughtBy)
    {
        $this->boughtBy = $boughtBy;
    }

    /**
     * @return \DateTime $boughtAt
     */
    public function getBoughtAt()
    {
        return $this->boughtAt;
    }

    /**
     * @param \DateTime $boughtAt
     */
    public function setBoughtAt(\DateTime $boughtAt)
    {
        $this->boughtAt = $boughtAt;
    }

    /**
     * @return float $finalPrice
     */
    public function getFinalPrice()
    {
        return $this->finalPrice;
    }

    /**
     * @param float $finalPrice
     */
    public function setFinalPrice(float $finalPrice)
    {
        $this->finalPrice = $finalPrice;
    }



}