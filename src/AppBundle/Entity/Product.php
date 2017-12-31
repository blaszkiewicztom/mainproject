<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 21.11.2017
 * Time: 15:49
 */

namespace AppBundle\Entity;


use AppBundle\Model\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 * @ORM\Table(name="product")
 * @ORM\HasLifecycleCallbacks()
 */
class Product extends AbstractEntity
{

    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Auction", mappedBy="product")
     */
    private $auction;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="product")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="product")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    /**
     * @ORM\Column(type="string")
     */
    private $content;
    /**
     * @ORM\Column(type="float")
     */
    private $minPrice;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\WhoPaysOption", inversedBy="product")
     * @ORM\JoinColumn(name="who_pays_id", referencedColumnName="id")
     */
    private $whoPays;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Shipment", inversedBy="product")
     * @ORM\JoinColumn(name="shipment_id", referencedColumnName="id")
     */
    private $shipment;
    /**
     * @ORM\Column(type="string", length=15)
     */
    private $status;
    /**
     * @ORM\Column(type="smallint")
     */
    private $expiresAfter;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\AwaitingApprovalProduct", mappedBy="product")
     */
    private $awaitingApproval;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ArchiveProduct", mappedBy="product")
     */
    private $archiveProduct;


    /**
     * @return string $name
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
     * @return Auction
     */
    public function getAuction()
    {
        return $this->auction;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return float $minPrice
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * @param float $minPrice
     */
    public function setMinPrice(float $minPrice)
    {
        $this->minPrice = $minPrice;
    }

    /**
     * @return Shipment $shipment
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * @param Shipment $shipment
     */
    public function setShipment(Shipment $shipment)
    {
        $this->shipment = $shipment;
    }



    /**
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return WhoPaysOption $whoPays
     */
    public function getWhoPays()
    {
        return $this->whoPays;
    }

    /**
     * @param WhoPaysOption $whoPays
     */
    public function setWhoPays(WhoPaysOption $whoPays)
    {
        $this->whoPays = $whoPays;
    }


    /**
     * @return string $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return integer $expiresAt
     */
    public function getExpiresAfter()
    {
        return $this->expiresAfter;
    }

    /**
     * @param integer $expiresAt
     */
    public function setExpiresAfter(int $expiresAfter)
    {
        $this->expiresAfter = $expiresAfter;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }




    /**
     * @ORM\PrePersist()
     */
    public function prePersistAction()
    {

        $this->updatedAt = new \DateTime('now');
    }

}