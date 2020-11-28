<?php

namespace App\Service;

use App\Entity\MatchDay;
use App\Entity\Player;
use App\Entity\PlayerVote;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


class MatchDayCalculator implements LoggerAwareInterface
{
    private $em;
    private $logger;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getSelectedPlayerOrderByLowerVotes($match_day): Collection
    {
        $q = $this->em->createQuery("SELECT pv FROM App\Entity\PlayerVote pv WHERE pv.match_day = :match_day and pv.selected = 1 ORDER BY pv.vote ASC");
        $q->setParameter('match_day', $match_day);
        $result = $q->getResult();
        $selected = new ArrayCollection($result);

        return $selected;
    }

    public function getNotSelectedPlayerOrderByHigherVotes($match_day): Collection
    {
        $q = $this->em->createQuery("SELECT pv FROM App\Entity\PlayerVote pv WHERE pv.match_day = :match_day and pv.selected = 0 ORDER BY pv.vote DESC");
        $q->setParameter('match_day', $match_day);
        $result = $q->getResult();
        
        $not_selected = new ArrayCollection($result);

        return $not_selected;
    }

    public function calculateResults(MatchDay $match_day)
    {
      $selected = $this->getSelectedPlayerOrderByLowerVotes($match_day);
      $not_selected =  $this->getNotSelectedPlayerOrderByHigherVotes($match_day);
      $best = array();
      $match_day_result = 0;
      $match_day_best_result = 0;
  
      // search for a player with a better vote not selected, on the same role
      foreach ($selected as $s) {
        $this->logger->debug("selected: $s");
        $match_day_result += $s->getVote();
        $best_candidate = $s;
        $candidate_key = false;
        foreach ($not_selected as $key => $ns) {
          if ($ns->getPlayer()->getRole() == $s->getPlayer()->getRole()) {
            if ($ns->getVote() > $best_candidate->getVote()) {
              $best_candidate = $ns;
              $candidate_key = $key;
            }
          }
        }
        $best[] = $best_candidate;
        if ($candidate_key !== false) $not_selected->remove($candidate_key);
        $this->logger->debug("best: $best_candidate");
      }
  
      $this->logger->debug("best formation");
      foreach ($best as $b) {
        $this->logger->debug($b);
        $match_day_best_result += $b->getVote();
        $b->setBest(true);
      }
      $this->logger->debug("result: $match_day_result");
      $this->logger->debug("best result: $match_day_best_result");

      $match_day->setResult($match_day_result);
      $match_day->setBestResult($match_day_best_result);
  
      $this->em->flush();
    }
}