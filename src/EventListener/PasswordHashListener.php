<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 27/11/2018
 * Time: 15:10
 */

namespace App\EventListener;


use App\Entity\Customer;
use App\Service\PasswordHash;
use Doctrine\ORM\Event\LifecycleEventArgs;

class PasswordHashListener
{
    /**
     * @var PasswordHash
     */
    private $passwordHash;

    public function __construct(PasswordHash $passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if (!$entity instanceof Customer) {
            return;
        }
        $password = $this->passwordHash->passwordHash($entity);
        $entity->setPassword($password);
    }

}
