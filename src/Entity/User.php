<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"get", "postUser"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"get", "postUser"})
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"get"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get"})
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
