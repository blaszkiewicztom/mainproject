<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 22.11.2017
 * Time: 11:03
 */

namespace AppBundle\Entity;





use AppBundle\Model\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="shipment")
 * @ORM\HasLifecycleCallbacks()
 */
class Shipment extends AbstractEntity
{

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product", mappedBy="shipment")
     */
    private $product;

    function __toString()
    {
        return (string) $this->type;
    }

    /**
     * @ORM\PrePersist()
     */
    function prePersistAction()
    {
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(String $type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }







}