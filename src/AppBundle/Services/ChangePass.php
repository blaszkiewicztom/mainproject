<?php
/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 08/10/2017
 * Time: 13:03
 */

namespace AppBundle\Services;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;


class ChangePass
{
    /**
     * @SecurityAssert\UserPassword(message="Podane hasło jest niezgodne z obecnym")
     */
    private $oldPassword;
    private $newPassword;

    /**
     * @return mixed
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * @param mixed $oldPassword
     */
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;
    }

    /**
     * @return mixed
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @param mixed $newPassword
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;
    }


}