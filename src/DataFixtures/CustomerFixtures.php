<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class CustomerFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $customer1 = new Customer();
        $customer1->setUsername('admin');
        $customer1->setPassword('admin');
        $customer1->setRoles(["ROLE_ADMIN"]);
        $manager->persist($customer1);

        $customer2 = new Customer();
        $customer2->setUsername('customer1');
        $customer2->setPassword('user');
        $customer2->setRoles(["ROLE_USER"]);

        $manager->persist($customer2);

        $manager->flush();

        $this->addReference('custom1', $customer1);
        $this->addReference('custom2', $customer2);
    }
}
