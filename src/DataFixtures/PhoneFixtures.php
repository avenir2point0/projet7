<?php

namespace App\DataFixtures;

use App\Entity\Phone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PhoneFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $phone = new Phone();
        $phone->setModel('X');
        $phone->setBrand('Apple');
        $phone->setWeight(850);
        $phone->setDas('99');
        $phone->setDescription('Cet Iphone est comme les autres est trop cher.');
        $manager->persist($phone);

        $manager->flush();
    }
}
