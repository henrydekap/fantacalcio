<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlayerVote", mappedBy="player", orphanRemoval=true)
     */
    private $playerVotes;

    public function __construct()
    {
        $this->playerVotes = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->role . " " . $this->name;
    }

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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|PlayerVote[]
     */
    public function getPlayerVotes(): Collection
    {
        return $this->playerVotes;
    }

    public function addPlayerVote(PlayerVote $playerVote): self
    {
        if (!$this->playerVotes->contains($playerVote)) {
            $this->playerVotes[] = $playerVote;
            $playerVote->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerVote(PlayerVote $playerVote): self
    {
        if ($this->playerVotes->contains($playerVote)) {
            $this->playerVotes->removeElement($playerVote);
            // set the owning side to null (unless already changed)
            if ($playerVote->getPlayer() === $this) {
                $playerVote->setPlayer(null);
            }
        }

        return $this;
    }

    public function getBestPercentage(): float
    {
        $best_appearance = 0;
        foreach ($this->playerVotes as $pv) {
            if ($pv->getBest()) {
                $best_appearance++;
            }
        }

        return $best_appearance / count($this->playerVotes);
    }
}
