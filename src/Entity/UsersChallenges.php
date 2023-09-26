<?php

namespace App\Entity;

use App\Repository\UsersChallengesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersChallengesRepository::class)]
class UsersChallenges
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'usersChallenges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idUser = null;

    #[ORM\ManyToOne(inversedBy: 'usersChallenges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Challenges $idChallenge = null;

    #[ORM\Column]
    private ?int $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdChallenge(): ?Challenges
    {
        return $this->idChallenge;
    }

    public function setIdChallenge(?Challenges $idChallenge): static
    {
        $this->idChallenge = $idChallenge;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }
}
