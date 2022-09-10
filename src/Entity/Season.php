<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=SeasonRepository::class)
 */
class Season
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="season", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=false)
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MatchDay", mappedBy="season", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=false)
     */
    private $matchDays;

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

    /**
     * @return Collection|MatchDay[]
     */
    public function getMatchDays(): Collection
    {
        return $this->matchDays;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }
}
