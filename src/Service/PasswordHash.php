<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 27/11/2018
 * Time: 15:08
 */

namespace App\Service;


use App\Entity\Customer;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordHash
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function passwordHash(Customer $customer)
    {
        $password = $this->passwordEncoder->encodePassword($customer, $customer->getPassword());
        return $password;
    }

}