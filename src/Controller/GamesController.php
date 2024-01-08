<?php

namespace App\Controller;

use App\Entity\GamesInfo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class  GamesController extends AbstractController{
    #[Route('/games/show/{id}', name: 'app_games_show')]
    public function show(GamesInfo $game,EntityManagerInterface $entityManager){
        $games = $entityManager->getRepository(GamesInfo::class)->findAll();
        return $this->render('games/index2.html.twig', [
            'Game' => $game,'Games' => $games,
        ]);
    }
    #[Route('/games/all', name: 'app_games_show_all')]
    public function show_all(EntityManagerInterface $entityManager): Response
    {
        $games=$entityManager->getRepository(GamesInfo::class)->findAll();
        return $this->render('games/index.html.twig',['Games'=>$games]);
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
    #[Route('/games/edit/{id}', name: 'app_games_edit_form', methods: ['GET'])]
    public function update_form(EntityManagerInterface $entityManager, int $id){
        $game = $entityManager->getRepository(GamesInfo::class)->find($id);
        return $this->render('player/index.html.twig', ['game' => $game]);
    }
    #[Route('/games/edit/{id}', name: 'app_games_edit',methods: ['POST'])]
    public function update(Request $request,EntityManagerInterface $entityManager, int $id){

        $game = $entityManager->getRepository(GamesInfo::class)->find($id);
        $game->setName($request->request->get('name'));
        $game->setDev($request->request->get('dev'));
        $game->setEditor($request->request->get('editor'));
        $game->setReleasedate($request->request->get('releasedate'));
        $game->setPrice($request->request->get('price'));
        $game->setGender($request->request->get('gender'));
        $game->setPlatformGame($request->request->get('platformgame'));
        $game->setRating($request->request->get('rating'));
        $game->setLastModificationUser($request->request->get('lastmodificationuser'));
        $entityManager->flush();

        return $this->redirectToRoute('app_games_show_all');
    }
    #[Route('/games/delete/{id}', name: 'app_games_delete')]
    public function delete(EntityManagerInterface $entityManager,GamesInfo $game,Security $security){
    $iduser=$game->getLastModificationUser();

        $useractual = $security->getUser();
    $iduserlogin=$useractual->getID();

        if($iduserlogin==$iduser){
            $entityManager->remove($game);
            $entityManager->flush();
            return $this->redirectToRoute('app_games_show_all');
        }else{
            return $this->redirectToRoute('app_games_show_all');
        }

    }
}
