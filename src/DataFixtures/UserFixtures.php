<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends AbstractFixture implements DependentFixtureInterface
{
    private $username = ['Pierre', 'Paul', 'Jacque', 'Marie', 'Cathie', 'Geroge'];
    private $email = ['testmail@test.fr', '2emetestMail@test.fr', 'dernierTestMail@test.fr'];
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setUsername($this->username[rand(0, 5)])
                ->setEmail($this->email[rand(0, 2)])
                ->setCustomer($this->getReference('custom'.rand(2, 3)));
            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CustomerFixtures::class
        );
    }
}
