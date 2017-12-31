<?php
/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 01/12/2017
 * Time: 21:40
 */

namespace AppBundle\Repository;






use AppBundle\Entity\Product;
use AppBundle\Entity\User;
use Doctrine\DBAL\Connection;


class GenericRepository
{
    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function addAwaitingApprovalProduct(Product $product, User $user){


            $qb = $this->conn->createQueryBuilder();
            $qb->insert('awaiting_product')
                ->values(array(
                    'id_product' => '?',
                    'id_user' => '?'
                ))
                ->setParameter(1, $product->getId(), 'integer')
                ->setParameter(2, $user->getId(), 'integer')
                ->execute();

    }

}