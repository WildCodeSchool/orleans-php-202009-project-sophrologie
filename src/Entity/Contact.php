<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{


    /**
     * @Assert\Length(max=50, maxMessage="La taille du prénom doit être inférieure à {{ limit }} caractères")
     * @Assert\NotBlank(message="Merci de saisir votre prénom")
     */
    private ?string $firstname;

    /**
     * @Assert\Length(max=50, maxMessage="La taille du nom doit être inférieure à {{ limit }} caractères")
     * @Assert\NotBlank(message="Merci de saisir votre nom")
     */
    private ?string $lastname;

    /**
     * @Assert\Length(max=20, maxMessage="Votre téléphone doit être inférieur à {{ limit }} caractères")
     * @Assert\NotBlank(message="Merci de saisir votre téléphone")
     */
    private ?string $phone;

    /**
     * @Assert\Length(max=100, maxMessage="Votre email doit être inférieur à {{ limit }} caractères")
     * @Assert\Email(message = "L'email '{{ value }}' n'est pas un format d'email valide.")
     * @Assert\NotBlank(message="Merci de saisir votre adresse email")
     */
    private ?string $email;

    /**
     * @Assert\Length(max=255, maxMessage="Le thème {{value}} doit être inférieur à {{ limit }} caractères")
     * @Assert\NotBlank(message="Merci de saisir un thème")
     */
    private ?string $theme;

    /**
     * @Assert\Length(max=1500, maxMessage="Le message doit être inférieur à {{ limit }} caractères")
     * @Assert\NotBlank(message="Merci de saisir un message")
     */
    private ?string $message;
    private ?int $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
