<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get"={
 *            "access_control"="is_granted('ROLE_ADMIN')",
 *            "swagger_context"={"summary"="Permet de selectionner la liste des clients"},
 *            "access_control_message"="Only admins can see customers.",
 *            "normalization_context"={"groups"={"getCustomer"}}},
 *         "post"={
 *             "access_control"="is_granted('ROLE_ADMIN')",
 *             "swagger_context"={"summary"="Permet de créer un client"},
 *             "access_control_message"="Only admins can create customers.",
 *             "denormalization_context"={"groups"={"postCustomer"}}
 *         },
 *     },
 *     itemOperations={
 *         "get"={"access_control"="is_granted('ROLE_ADMIN')",
 *                "access_control_message"="Only admins can select customers.",
 *                "swagger_context"={"summary"="Permet de selectionner un client par son id"},
 *                "normalization_context"={"groups"={"getCustomer"}}
 *          },
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"getCustomer"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Groups({"postCustomer", "getCustomer", "getUser"})
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     * @Assert\Length( min = 2, max = 50)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"postCustomer", "getCustomer"})
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     * @Assert\Length( min = 2, max = 50)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="customer", cascade={"persist", "remove"})
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {

    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {

    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCustomer($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCustomer() === $this) {
                $user->setCustomer(null);
            }
        }

        return $this;
    }

    public function getUserObject()
    {
        return $this;
    }
}
