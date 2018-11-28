<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('testuser')
            ->setEmail('dfbvdwfbv@fdvwdbfdw.fr')
            ->setCustomer($this->getReference('custom2'));

        $manager->persist($user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CustomerFixtures::class
        );
    }
}
