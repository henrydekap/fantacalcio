<?php

namespace App\Controller;

use App\Entity\MatchDay;
use App\Entity\Player;
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
    $player_list = $player_repo->findAll();

    $matchday_repo  = $em->getRepository(MatchDay::class);
    $match_day_list = $matchday_repo->findAll();

    return $this->render('home/index.html.twig', [
      'controller_name' => 'HomeController',
      'player_list'     => $player_list,
      'match_day_list'  => $match_day_list,
    ]);
  }
}
