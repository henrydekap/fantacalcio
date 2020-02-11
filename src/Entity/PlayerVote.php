<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerVoteRepository")
 */
class PlayerVote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="playerVotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MatchDay", inversedBy="playerVotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $match_day;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vote;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MatchDay", inversedBy="best_votes")
     */
    private $matchDay;

    /**
     * @ORM\Column(type="boolean")
     */
    private $selected;

    /**
     * @ORM\Column(type="boolean")
     */
    private $best;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getMatchDay(): ?MatchDay
    {
        return $this->match_day;
    }

    public function setMatchDay(?MatchDay $match_day): self
    {
        $this->match_day = $match_day;

        return $this;
    }

    public function getVote(): ?float
    {
        return $this->vote;
    }

    public function setVote(?float $vote): self
    {
        $this->vote = $vote;

        return $this;
    }

    public function getSelected(): ?bool
    {
        return $this->selected;
    }

    public function setSelected(bool $selected): self
    {
        $this->selected = $selected;

        return $this;
    }

    public function getBest(): ?bool
    {
        return $this->best;
    }

    public function setBest(bool $best): self
    {
        $this->best = $best;

        return $this;
    }
}
