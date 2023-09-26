<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?int $role = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: UsersChallenges::class)]
    private Collection $usersChallenges;

    public function __construct()
    {
        $this->usersChallenges = new ArrayCollection();
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return Collection<int, UsersChallenges>
     */
    public function getUsersChallenges(): Collection
    {
        return $this->usersChallenges;
    }

    public function addUsersChallenge(UsersChallenges $usersChallenge): static
    {
        if (!$this->usersChallenges->contains($usersChallenge)) {
            $this->usersChallenges->add($usersChallenge);
            $usersChallenge->setIdUser($this);
        }

        return $this;
    }

    public function removeUsersChallenge(UsersChallenges $usersChallenge): static
    {
        if ($this->usersChallenges->removeElement($usersChallenge)) {
            // set the owning side to null (unless already changed)
            if ($usersChallenge->getIdUser() === $this) {
                $usersChallenge->setIdUser(null);
            }
        }

        return $this;
    }
}
