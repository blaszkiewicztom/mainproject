<?php
/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 01/12/2017
 * Time: 21:05
 */

namespace AppBundle\Services;




use AppBundle\Entity\Product;
use AppBundle\Entity\User;
use AppBundle\Repository\GenericRepository;

class AwatingApproval
{

    private $genericRepository;
    private $entity;
    private $user;

    public function __construct(GenericRepository $genericRepository)
    {
        $this->genericRepository = $genericRepository;
    }

    public function setEntity($entity){

        $this->entity = $entity;
        return $this;

    }
    public function setUser(User $user){

        $this->user = $user;
        return $this;

    }
    public function addProduct(){

        if(!$this->entity instanceof Product ){
            throw new \Exception('Entity is not a Product object. Use setEntity() method ');
        }
        $this->genericRepository->addAwaitingApprovalProduct($this->entity, $this->user);
    }


}