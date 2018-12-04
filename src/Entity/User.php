<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get"={
 *            "access_control"="is_granted('ROLE_USER')",
 *            "swagger_context"={"summary"="Permet de selectionner la liste des utilisateurs"},
 *            "access_control_message"="Only admins and customers can add users."},
 *         "post"={
 *             "access_control"="is_granted('ROLE_USER')",
 *             "swagger_context"={"summary"="Permet de créer un utilisateur"},
 *             "access_control_message"="Only admins and customers can add users.",
 *             "denormalization_context"={"groups"={"postUser"}}
 *         },
 *     },
 *     itemOperations={
 *         "get"={"access_control"="is_granted('ROLE_USER')",
 *                "swagger_context"={"summary"="Permet de selectionner un utilisateur"}
 *          },
 *         "delete"={"access_control"="is_granted('ROLE_USER')",
 *                  "swagger_context"={"summary"="Permet de supprimer un utilisateur"}
 *          }
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"customer": "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"postUser"})
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     * @Assert\Length( min = 2, max = 50)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"postUser"})
     * @Assert\NotBlank(message="Ce champ doit être rempli")
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="users", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
