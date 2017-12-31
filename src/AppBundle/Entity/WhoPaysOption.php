<?php
/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 27/11/2017
 * Time: 20:21
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="who_pays_option")
 */
class WhoPaysOption
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=15)
     */
    private $option;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product", mappedBy="whoPays")
     */
    private $product;

    public function __toString()
    {
        return (string) $this->option;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param mixed $option
     */
    public function setOption($option)
    {
        $this->option = $option;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }



}