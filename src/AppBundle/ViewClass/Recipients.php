<?php
/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 26/10/2017
 * Time: 18:36
 */

namespace AppBundle\ViewClass;


class Recipients
{
    private $recipients = array();
    private $messages;

    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    public function setRecipients()
    {
        $tempArray = array();
        foreach ($this->messages as $message) {
            $tempArray[] = $message['recipient'];
            $tempArray[] = $message['sender'];
        }
        $this->recipients = array_unique($tempArray);
    }

    /**
     * @return array
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * @param $ownerId
     * @return void
     */

    public function removeOwnerId($ownerId)
    {
        $array = $this->recipients;
        $key = array_search($ownerId, $array);

        if($key === false) {return null;}

        unset($array[$key]);
        $this->recipients = $array;
    }
}