<?php

namespace App\Controller;

use App\Entity\GamesInfo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/games/form', name: 'app_games_form')]
    public function form(Request $request,EntityManagerInterface $entityManager):Response{

        $GamesInfo=new GamesInfo();
        $form=$this->createFormBuilder($GamesInfo)
            ->add('name')
            ->add('dev')
            ->add('editor')
            ->add('releasedate')
            ->add('price')
            ->add('gender')
            ->add('platform_game')
            ->add('rating')
            ->add('last_modification_user')
            ->add('submit', SubmitType::class,['label'=>'Create a new Game !'])
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $GamesInfo=$form->getData();
           // $GamesInfo->setOwner($this->getUser());

            $entityManager->persist($GamesInfo);
            $entityManager->flush();
        }return  $this->render('games/form.html.twig',
            ['form'=>$form]);

    }
}
