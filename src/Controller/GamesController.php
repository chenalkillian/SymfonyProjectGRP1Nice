<?php

namespace App\Controller;

use App\Entity\GamesInfo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GamesController extends AbstractController
{

    #[Route('/games', name: 'app_games')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $game=$entityManager->getRepository(GamesInfo::class)->findAll();
        return $this->render('games/index.html.twig',['Game'=>$game]);

    }
}
