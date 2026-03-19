<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Coach
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length:255)]
    private ?string $name = null;

    #[ORM\Column(length:255, nullable:true)]
    private ?string $email = null;

    #[ORM\ManyToOne(targetEntity: Esport::class)]
    private ?Esport $team = null;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getTeam(): ?Esport
    {
        return $this->team;
    }

    public function setTeam(?Esport $team): self
    {
        $this->team = $team;
        return $this;
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }
}