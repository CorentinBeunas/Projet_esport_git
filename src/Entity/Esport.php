<?php

namespace App\Entity;

use App\Repository\EsportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EsportRepository::class)]
class Esport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Nom de l'équipe
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // Taille de l'équipe
    #[ORM\Column]
    private ?int $taille_equipe = null;

    // Liste des membres (texte long)
    #[ORM\Column(type: "text", nullable: true)]
    private ?string $membres = null;

    // Lien vers une page listant les membres
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $membresLink = null;

    // Nom de la compétition
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $competition = null;

    // Palmarès de l’équipe
    #[ORM\Column(type: "text", nullable: true)]
    private ?string $palmares = null;

    // Capitaine de l’équipe
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $capitaine = null;

    // Nom du coach
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coach = null;

    // Nombre de tournois gagnés
    #[ORM\Column(nullable: true)]
    private ?int $tournois_gagnes = null;


    // ------------------- GETTERS & SETTERS -------------------

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

    public function getTailleEquipe(): ?int
    {
        return $this->taille_equipe;
    }

    public function setTailleEquipe(int $taille_equipe): static
    {
        $this->taille_equipe = $taille_equipe;
        return $this;
    }

    public function getMembres(): ?string
    {
        return $this->membres;
    }

    public function setMembres(?string $membres): static
    {
        $this->membres = $membres;
        return $this;
    }

    public function getMembresLink(): ?string
    {
        return $this->membresLink;
    }

    public function setMembresLink(?string $membresLink): static
    {
        $this->membresLink = $membresLink;
        return $this;
    }

    public function getCompetition(): ?string
    {
        return $this->competition;
    }

    public function setCompetition(?string $competition): static
    {
        $this->competition = $competition;
        return $this;
    }

    public function getPalmares(): ?string
    {
        return $this->palmares;
    }

    public function setPalmares(?string $palmares): static
    {
        $this->palmares = $palmares;
        return $this;
    }

    public function getCapitaine(): ?string
    {
        return $this->capitaine;
    }

    public function setCapitaine(?string $capitaine): static
    {
        $this->capitaine = $capitaine;
        return $this;
    }

    public function getCoach(): ?string
    {
        return $this->coach;
    }

    public function setCoach(?string $coach): static
    {
        $this->coach = $coach;
        return $this;
    }

    public function getTournoisGagnes(): ?int
    {
        return $this->tournois_gagnes;
    }

    public function setTournoisGagnes(?int $tournois_gagnes): static
    {
        $this->tournois_gagnes = $tournois_gagnes;
        return $this;
    }
    public function __toString():string
    {
	return $this->name ?? 'Equipe inconnue';
    }
}

