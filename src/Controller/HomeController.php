<?php

namespace App\Controller;

use App\Entity\MatchDay;
use App\Entity\Player;
use App\Entity\PlayerVote;
use App\Entity\Season;
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
    $season_repo = $em->getRepository(Season::class);
    $season_list = $season_repo->findAll();

    return $this->render('home/index.html.twig', [
      'controller_name' => 'HomeController',
      'squad_name'      => $this->getParameter('squad_name'),
      'season_list'          => $season_list,
    ]);
  }
  
  /**
   * @Route("/season/{season_id}", name="season_show", methods={"GET"})
   */
  public function showSeason(EntityManagerInterface $em, string $season_id)
  {
    $season_repo = $em->getRepository(Season::class);
    $season = $season_repo->findOneById($season_id);
    $player_list = $season->getPlayers();
    $match_day_list = $season->getMatchDays();

    return $this->render('home/season.html.twig', [
      'controller_name' => 'HomeController',
      'squad_name'      => $this->getParameter('squad_name'),
      'season'          => $season,
      'player_list'     => $player_list,
      'match_day_list'  => $match_day_list,
    ]);
  }
  
  /**
   * @Route("/", name="season_new")
   */
 public function addSeason(EntityManagerInterface $em)
 {
   $season_repo = $em->getRepository(Season::class);
   $season_list = $season_repo->findAll();

   return $this->render('home/index.html.twig', [
     'controller_name' => 'HomeController',
     'squad_name'      => $this->getParameter('squad_name'),
     'season_list'          => $season_list,
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
