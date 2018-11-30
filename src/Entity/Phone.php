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
 *            "swagger_context"={"summary"="Permet de selectionner la liste des téléhpones"},
 *            "access_control_message"="Only authentified customers can see phones."},
 *         "post"={
 *             "access_control"="is_granted('ROLE_ADMIN')",
 *             "swagger_context"={"summary"="Permet de créer un téléphone"},
 *             "access_control_message"="Only admins can add phones.",
 *             "denormalization_context"={"groups"={"postPhone"}}
 *         },
 *     },
 *     itemOperations={
 *         "get"={"access_control"="is_granted('ROLE_USER')",
 *                "access_control_message"="Only authentified customers can see phones.",
 *                "swagger_context"={"summary"="Permet de selectionner un téléphone par son id"}
 *          },
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PhoneRepository")
 */
class Phone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"postPhone"})
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"postPhone"})
     */
    private $brand;

    /**
     * @ORM\Column(type="text")
     * @Groups({"postPhone"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"postPhone"})
     */
    private $weight;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"postPhone"})
     */
    private $das;

    /**
     * @ORM\Column(type="datetime")
     */
    private $availableAt;

    public function __construct()
    {
        $this->availableAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getDas(): ?int
    {
        return $this->das;
    }

    public function setDas(int $das): self
    {
        $this->das = $das;

        return $this;
    }

    public function getAvailableAt(): ?\DateTimeInterface
    {
        return $this->availableAt;
    }

    public function setAvailableAt(\DateTimeInterface $availableAt): self
    {
        $this->availableAt = $availableAt;

        return $this;
    }
}
