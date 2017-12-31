<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 22.11.2017
 * Time: 11:34
 */

namespace AppBundle\Entity;


use AppBundle\Model\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 * @ORM\HasLifecycleCallbacks()
 */
class Category extends AbstractEntity
{

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product", mappedBy="category")
     */
    private $product;

    function __toString(){
        return (string) $this->name;
    }

    /**
     * @ORM\PrePersist()
     */
    function prePersistAction()
    {
        $this->updatedAt = new \DateTime('now');
    }

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





}