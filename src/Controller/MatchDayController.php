<?php

namespace App\Controller;

use App\Entity\MatchDay;
use App\Form\MatchDayType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchDayController extends AbstractController
{
  /**
   * @Route("/matchday", name="matchday")
   */
  public function index()
  {
    return $this->render('match_day/index.html.twig', [
      'controller_name' => 'MatchDayController',
    ]);
  }

  /**
   * @Route("/matchday/edit/{match_day_number}", name="matchday_edit", methods={"GET","POST"})
   */
  public function edit(Request $request, int $match_day_number, EntityManagerInterface $em): Response
  {
    $match_day_repo = $em->getRepository(MatchDay::class);
    $match_day      = $match_day_repo->findOneBy(['number' => $match_day_number]);

    $form = $this->createForm(MatchDayType::class, $match_day);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->getDoctrine()->getManager()->flush();

      return $this->redirectToRoute('home');
    }

    return $this->render('match_day/edit.html.twig', [
      'match_day' => $match_day,
      'form'      => $form->createView(),
    ]);
  }
}