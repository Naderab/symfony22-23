<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClubRepository;
use App\Entity\Club;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ClubType;
class ClubController extends AbstractController
{
    #[Route('/club/fetch', name: 'club_fetch')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $listClubs= $doctrine->getRepository(Club::class)->findAll();
        //$club= $doctrine->getRepository(Club::class)->find('1');
        return $this->render('club/index.html.twig', [
            'clubs' => $listClubs,
            
        ]);
    }

    // #[Route('/fetchClubs', name: 'club_fetch')]
    // public function index(ClubRepository $clubRepository): Response
    // {
    //     $listClubs = $clubRepository->findAll();
    //     $club = $clubRepository->find('2');
    //     return $this->render('club/index.html.twig', [
    //         'clubs' => $listClubs,
    //         'club' => $club
    //     ]);
    // }

    #[Route('/club/remove/{id}', name: 'club_remove')]
    public function removeClub(ManagerRegistry $doctrine,$id): Response
    {
        $em= $doctrine->getManager();
        $club= $doctrine->getRepository(Club::class)->find($id);
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute('club_fetch');
    }

    #[Route('/club/add', name: 'club_add')]
    public function addClub(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $club = new Club();
        $form = $this->createForm(ClubType::class,$club);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $em->persist($club);
            $em->flush();
            return $this->redirectToRoute('club_fetch');
        }
        //$club->setName('club test persist');
        //$club->setCreationDate(new \DateTime());
        return $this->renderForm('club/add.html.twig',['formClub'=>$form]);
    }
    #[Route('/club/update/{id}', name: 'club_update')]
    public function updateClub(ManagerRegistry $doctrine,$id,Request $req): Response {
        $em = $doctrine->getManager();
        $club = $doctrine->getRepository(Club::class)->find($id);
        $form = $this->createForm(ClubType::class,$club);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $em->persist($club);
            $em->flush();
            return $this->redirectToRoute('club_fetch');
        }
        return $this->renderForm('club/add.html.twig',['formClub'=>$form]);

    }

   
}
