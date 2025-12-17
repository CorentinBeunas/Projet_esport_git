<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Esport;
use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Nombre de victoires
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $wins = 0;

    // Nombre de défaites
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $losses = 0;

    // Nombre de matchs nuls
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $draws = 0;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 50)]
    private ?string $role = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $champions = null;

    #[ORM\Column(type: "float", nullable: true)]
    private ?float $winrate = null;

    #[ORM\Column(type: "float", nullable: true)]
    private ?float $kda = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    // Relation avec une équipe
    #[ORM\ManyToOne(targetEntity: Esport::class)]
    private ?Esport $team = null;

    // Relation obligatoire avec User
    #[ORM\OneToOne(inversedBy: "player", cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;


    // ─────── GETTERS / SETTERS ────────────────────────────────

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;
        return $this;
    }

    public function getChampions(): ?string
    {
        return $this->champions;
    }

    public function setChampions(?string $champions): static
    {
        $this->champions = $champions;
        return $this;
    }

    public function getWinrate(): ?float
    {
        return $this->winrate;
    }

    public function setWinrate(?float $winrate): static
    {
        $this->winrate = $winrate;
        return $this;
    }

    public function getKda(): ?float
    {
        return $this->kda;
    }

    public function setKda(?float $kda): static
    {
        $this->kda = $kda;
        return $this;
    }

    public function getWins(): ?int
    {
        return $this->wins;
    }

    public function setWins(int $wins): static
    {
        $this->wins = $wins;
        return $this;
    }

    public function getLosses(): ?int
    {
        return $this->losses;
    }

    public function setLosses(int $losses): static
    {
        $this->losses = $losses;
        return $this;
    }

    public function getDraws(): ?int
    {
        return $this->draws;
    }

    public function setDraws(int $draws): static
    {
        $this->draws = $draws;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getTeam(): ?Esport
    {
        return $this->team;
    }

    public function setTeam(?Esport $team): static
    {
        $this->team = $team;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;
        return $this;
    }
}

