<?php

namespace App\Controller;

use App\Entity\MatchDay;
use App\Entity\Player;
use App\Entity\PlayerVote;
use App\Service\MatchDayScraperInterface;
use App\Service\MatchDayCalculator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  /**
   * @Route("/", name="home")
   */
  public function index(EntityManagerInterface $em)
  {
    $player_repo = $em->getRepository(Player::class);
    $gk   = $player_repo->findByRole('P');
    $def  = $player_repo->findByRole('D');
    $mid  = $player_repo->findByRole('C');
    $att  = $player_repo->findByRole('A');
    $player_list = \array_merge($gk, $def, $mid, $att);

    $matchday_repo  = $em->getRepository(MatchDay::class);
    $match_day_list = $matchday_repo->findAll();

    return $this->render('home/index.html.twig', [
      'controller_name' => 'HomeController',
      'squad_name'      => $this->getParameter('squad_name'),
      'player_list'     => $player_list,
      'match_day_list'  => $match_day_list,
    ]);
  }

  /** 
   * @Route("/scrape", name="scrape")
   */
  public function scrape(EntityManagerInterface $em, MatchDayScraperInterface $scraper, MatchDayCalculator $calculator)
  {
    // match day info
    $matchday_repo  = $em->getRepository(MatchDay::class);
    $match_day = $matchday_repo->findOneById(1);

    $scraper->scrape($match_day);
    $calculator->calculateResults($match_day);

    return $this->render('match_day/index.html.twig',
  [      'controller_name' => 'HomeController',
  ]);
  }
}
