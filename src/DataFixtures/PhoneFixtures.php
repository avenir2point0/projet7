<?php

namespace App\DataFixtures;

use App\Entity\Phone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PhoneFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $phone = new Phone();
            $phone->setModel('Model de telephone'.$i);
            $phone->setBrand('Marque'.$i);
            $phone->setWeight(rand(700, 999));
            $phone->setDas(rand(1, 5));
            $phone->setDescription('Ceci est la description de téléphone, et il est génial de voir un avis.');
            $manager->persist($phone);
        }

        $manager->flush();
    }
}
