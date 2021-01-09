<?php

namespace App\Entity;

use App\Repository\PricesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PricesRepository::class)
 */
class Prices
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max="255", maxMessage="Le nom ne doit pas dépasser {{ value }} caractère.")
     */
    private ?string $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private ?int $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
