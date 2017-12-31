<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 22.11.2017
 * Time: 11:46
 */

namespace AppBundle\Model;
use Doctrine\ORM\Mapping as ORM;


abstract class AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;


    abstract function prePersistAction();

    /**
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return \DateTime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

//    /**
//     * @param \DateTime $updatedAt
//     */
//    public function setUpdatedAt(\DateTime$updatedAt)
//    {
//        $this->updatedAt = $updatedAt;
//    }

}