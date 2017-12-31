<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 23.11.2017
 * Time: 14:08
 */

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $loader = new NativeLoader();
        $objects = $loader->loadFile(__DIR__.'/fixtures.yml')->getObjects();

        foreach($objects as $object){
            $manager->persist($object);
            $manager->flush();
        }

    }


}