<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClubRepository;
use App\Entity\Club;
use Doctrine\Persistence\ManagerRegistry;
class ClubController extends AbstractController
{
    #[Route('/fetchClubs', name: 'club_fetch')]
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

    #[Route('/removeClub/{id}', name: 'club_remove')]
    public function removeClub(ManagerRegistry $doctrine,$id): Response
    {
        $em= $doctrine->getManager();
        $club= $doctrine->getRepository(Club::class)->find($id);
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute('club_fetch');
    }
}
