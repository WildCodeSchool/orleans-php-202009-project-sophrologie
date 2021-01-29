<?php

namespace App\Entity;

use App\Repository\TestimonyRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TestimonyRepository::class)
 */
class Testimony
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Length(max="100")
     */
    private ?string $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max="255")
     */
    private ?string $description;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private ?DateTimeInterface $date;

    /**
     * @ORM\Column(type="string", length=75)
     * @Assert\NotBlank
     * @Assert\Length(max="75")
     */
    private ?string $firtsname;

    /**
     * @ORM\Column(type="string", length=75, nullable=true)
     * @Assert\Length(max="75")
     */
    private ?string $lastname;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Positive
     */
    private ?int $age;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFirtsname(): ?string
    {
        return $this->firtsname;
    }

    public function setFirtsname(string $firtsname): self
    {
        $this->firtsname = $firtsname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }
}
