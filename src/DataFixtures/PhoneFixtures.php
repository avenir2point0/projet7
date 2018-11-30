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
        $phone->setDas(99);
        $phone->setDescription('Cet Iphone est comme les autres, il est trop cher.');
        $manager->persist($phone);

        $phone1 = new Phone();
        $phone1->setModel('Galaxy 10');
        $phone1->setBrand('Samsung');
        $phone1->setWeight(890);
        $phone1->setDas(80);
        $phone1->setDescription('Le dernier Samsung, bonnes notes générales.');
        $manager->persist($phone1);

        $phone2 = new Phone();
        $phone2->setModel('XS');
        $phone2->setBrand('Apple');
        $phone2->setWeight(999);
        $phone2->setDas(50);
        $phone2->setDescription('Cet Iphone est une horreur sur le prix.');
        $manager->persist($phone2);

        $phone3 = new Phone();
        $phone3->setModel('LITE');
        $phone3->setBrand('Honor');
        $phone3->setWeight(666);
        $phone3->setDas(101);
        $phone3->setDescription('Cet Iphone est comme les autres, il est trop cher.');
        $manager->persist($phone3);

        $phone4 = new Phone();
        $phone4->setModel('P20');
        $phone4->setBrand('Huawei');
        $phone4->setWeight(790);
        $phone4->setDas(73);
        $phone4->setDescription('Un concentré de technologie pour les photos.');
        $manager->persist($phone4);

        $manager->flush();
    }
}
