<?php

namespace App\Entity;

use App\Repository\ProjetEsportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetEsportRepository::class)]
class ProjetEsport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $Projet_Esport = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getProjetEsport(): ?string
    {
        return $this->Projet_Esport;
    }

    public function setProjetEsport(string $Projet_Esport): static
    {
        $this->Projet_Esport = $Projet_Esport;

        return $this;
    }
}
