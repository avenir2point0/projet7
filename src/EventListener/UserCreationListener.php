<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 28/11/2018
 * Time: 18:06
 */

namespace App\EventListener;


use App\Entity\User;
use App\Service\GetCurrentUser;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UserCreationListener
{

    /**
     * @var GetCurrentUser
     */
    private $currentUser;

    public function __construct(GetCurrentUser $currentUser)
    {

        $this->currentUser = $currentUser;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if (!$entity instanceof User) {
            return;
        }
        $customer = $this->currentUser->getCurrentUser();
        $entity->setCustomer($customer);
    }

}