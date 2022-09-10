<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchDayRepository")
 */
class MatchDay
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="integer")
   */
  private $number;

  /**
   * @ORM\Column(type="date")
   */
  private $match_date;

  /**
   * @ORM\Column(type="float", nullable=true)
   */
  private $result;

  /**
   * @ORM\Column(type="float", nullable=true)
   */
  private $best_result;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $url;

  /**
   * @ORM\OneToMany(targetEntity="App\Entity\PlayerVote", mappedBy="match_day", orphanRemoval=true)
   */
  private $playerVotes;

  /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", inversedBy="matchDays")
     * @ORM\JoinColumn(nullable=false)
     */
  private $season;

  public function __construct()
  {
    $this->playerVotes = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNumber(): ?int
  {
    return $this->number;
  }

  public function setNumber(int $number): self
  {
    $this->number = $number;

    return $this;
  }

  public function getMatchDate(): ?\DateTimeInterface
  {
    return $this->match_date;
  }

  public function setMatchDate(\DateTimeInterface $match_date): self
  {
    $this->match_date = $match_date;

    return $this;
  }

  public function getResult(): ?float
  {
    return $this->result;
  }

  public function setResult(?float $result): self
  {
    $this->result = $result;

    return $this;
  }

  public function getBestResult(): ?float
  {
    return $this->best_result;
  }

  public function setBestResult(?float $best_result): self
  {
    $this->best_result = $best_result;

    return $this;
  }

  /**
   * @return string
   */
  public function getUrl(): string
  {
    return $this->url;
  }

  /**
   * @param string $url
   */
  public function setUrl(string $url): self
  {
    $this->url = $url;
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
      $playerVote->setMatchDay($this);
      return $this;
    }

    return $this;
  }

  public function removePlayerVote(PlayerVote $playerVote): self
  {
    if ($this->playerVotes->contains($playerVote)) {
      $this->playerVotes->removeElement($playerVote);
      // set the owning side to null (unless already changed)
      if ($playerVote->getMatchDay() === $this) {
        $playerVote->setMatchDay(null);
      }
    }

    return $this;
  }

  /**
   * @param Player $player
   * @return PlayerVote
   */
  public function getVoteFor(Player $player): PlayerVote
  {
    foreach ($this->playerVotes as $playerVote) {
      /* @var \App\Entity\PlayerVote $playerVote */
      if ($playerVote->getPlayer() == $player) {
        return $playerVote;
      }
    }

    return new PlayerVote();
  }

  public function getDifference(): ?float
  {
    return round($this->best_result - $this->result, 2);
  }
}
