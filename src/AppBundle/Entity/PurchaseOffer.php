<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 22.11.2017
 * Time: 14:30
 */

namespace AppBundle\Entity;


use AppBundle\Model\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="purchase_offer")
 * @ORM\HasLifecycleCallbacks()
 */
class PurchaseOffer extends AbstractEntity
{


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Auction", inversedBy="purchaseOfferCollection")
     * @ORM\JoinColumn(name="auction_id", referencedColumnName="id")
     */
    private $auction;
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="purchaseOfferCollection")
     * @ORM\JoinTable(name="users_purchase_offers")
     */
    private $userCollection;


    /**
     * @return Auction $auction
     */
    public function getAuction()
    {
        return $this->auction;
    }

    /**
     * @param Auction $auction
     */
    public function setAuction(Auction $auction)
    {
        $this->auction = $auction;
    }

    /**
     * @return ArrayCollection
     */
    public function getUserCollection()
    {
        return $this->userCollection;
    }

    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        // TODO: implement method add
    }


    /**
     * ORM\PrePersist()
     */
    function prePersistAction()
    {
        $this->updatedAt = new \DateTime('now');
    }


}