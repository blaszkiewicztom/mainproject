<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 20.10.2017
 * Time: 14:04
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository
{
    public function findAllMessagesForUser($userId){

        $em = $this->getEntityManager();

        $array = $em->createQueryBuilder()
            ->select('s.id AS sender', 'u.id AS recipient','s.email AS sender_email','u.email AS recipient_email', 'm.content', 'm.createdAt' )
            ->from('AppBundle:Message', 'm')
            ->innerJoin('m.sender','s')
            ->innerJoin('m.user','u')
            ->Where('m.sender = ?1 OR m.user = ?1')
            ->orderBy('m.id','DESC')
            ->setParameter('1', $userId)
            ->getQuery()
            ->execute();
        if($array == null){return false;}
        return $array;
    }
}