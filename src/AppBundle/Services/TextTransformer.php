<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 13.09.2017
 * Time: 11:24
 */

namespace AppBundle\Services;


class TextTransformer
{

    private $dependency;

    function __construct($dependency)
    {
        $this->dependency = $dependency;
    }

    public function toUpper($str){
        $str = $this->dependency
            ->someActionOnDependency($str);
        return strtoupper($str);
    }

}