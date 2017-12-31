<?php
/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 26/10/2017
 * Time: 18:11
 */

namespace AppBundle\Services;


use AppBundle\Model\GeneratorInterface;

class HistoryOfMessagesGenerator implements GeneratorInterface
{
    private $recipients;
    private $queryResult;

    public function __construct($recipients, $queryResult){
        $this->recipients = $recipients;
        $this->queryResult = $queryResult;
    }

    public function generate(){

        $finalArray = array();
        foreach ($this->recipients as $recipient){
            $tempArray = array();
            foreach ($this->queryResult as $row){

                if($row['sender'] === $recipient){
                    $tempArray[] = array(
                            'is_for_me' => true,
                            'email' => $row['sender_email'],
                            'content' => $row['content'],
                            'created_at' => $row['createdAt']
                    );
                }
                if($row['recipient'] === $recipient){
                    $tempArray[] = array(
                            'is_for_me' => false,
                            'email' => $row['recipient_email'],
                            'content' => $row['content'],
                            'created_at' => $row['createdAt']
                    );
                }
            }
            // the first taken email is the correct one (doesn't matter who sent message as a first one)
            $email = $tempArray[0]['email'];
            $finalArray[$email] = $tempArray;
        }
        return $finalArray;
    }

}