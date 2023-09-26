<?php

namespace App\Entity;

use App\Repository\ChallengesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChallengesRepository::class)]
class Challenges
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\Column(length: 255)]
    private ?string $categories = null;

    #[ORM\OneToMany(mappedBy: 'idChallenge', targetEntity: UsersChallenges::class)]
    private Collection $usersChallenges;

    public function __construct()
    {
        $this->usersChallenges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getCategories(): ?string
    {
        return $this->categories;
    }

    public function setCategories(string $categories): static
    {
        $this->categories = $categories;

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
            $usersChallenge->setIdChallenge($this);
        }

        return $this;
    }

    public function removeUsersChallenge(UsersChallenges $usersChallenge): static
    {
        if ($this->usersChallenges->removeElement($usersChallenge)) {
            // set the owning side to null (unless already changed)
            if ($usersChallenge->getIdChallenge() === $this) {
                $usersChallenge->setIdChallenge(null);
            }
        }

        return $this;
    }

}
