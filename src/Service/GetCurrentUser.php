<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 28/11/2018
 * Time: 18:13
 */

namespace App\Service;


use App\Entity\Customer;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class GetCurrentUser
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {

        $this->tokenStorage = $tokenStorage;
    }

    public function getCurrentUser()
    {
        $currentUser = $this->tokenStorage->getToken()->getUser()->getUserObject();
        return $currentUser;
    }
}