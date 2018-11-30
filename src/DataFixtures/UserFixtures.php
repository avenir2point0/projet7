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
        $user->setUsername('Pierre')
            ->setEmail('pierre@testfai.fr')
            ->setCustomer($this->getReference('custom2'));
        $manager->persist($user);

        $user1 = new User();
        $user1->setUsername('Paul')
            ->setEmail('paul@testfai.fr')
            ->setCustomer($this->getReference('custom2'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('Jacques')
            ->setEmail('jacques@testfai.fr')
            ->setCustomer($this->getReference('custom3'));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('Jean-Pierre')
            ->setEmail('jp@testfai.fr')
            ->setCustomer($this->getReference('custom3'));
        $manager->persist($user3);

        $user4 = new User();
        $user4->setUsername('Jean-Jean')
            ->setEmail('jj@testfai.fr')
            ->setCustomer($this->getReference('custom3'));
        $manager->persist($user4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CustomerFixtures::class
        );
    }
}
