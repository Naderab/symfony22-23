<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClubRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Club;

class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }
    #[Route('/club/all', name: 'app_club_all')]
    public function getClubs(ClubRepository $repo) :Response {
        $clubs = $repo->findAll();
        return $this->render('club/listClubs.html.twig',['clubs'=>$clubs]);
    }

    #[Route('/club/get/{id}', name: 'app_club_get')]
    public function getClubById(ClubRepository $repo,$id) :Response {
        $club = $repo->find($id);
        return $this->render('club/details.html.twig',['club'=>$club]);
    }

    #[Route('/club/remove/{id}', name: 'app_club_remove')]
    public function removeClub($id,ManagerRegistry $doctrine) : response {
        $em = $doctrine->getManager();
        $club = $doctrine->getRepository(Club::class)->find($id);
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute('app_club_all');
    }
}
