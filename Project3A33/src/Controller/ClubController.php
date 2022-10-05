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
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }
    #[Route('/club/get/{nom}', name: 'app_club_getName')]
    public function getName($nom):Response {
        return $this->render('club/detail.html.twig', ['nom'=>$nom]);
    }

    #[Route('/club/all', name: 'club_get_all')]
    public function getClubs(ClubRepository $repo) : Response {
        $clubs = $repo->findAll();
        return $this->render('club/clubs.html.twig',["clubs"=>$clubs]);
    }

    #[Route('/club/{id}', name: 'club_get')]
    public function getClubById(ClubRepository $repo,$id) : Response {
        $club = $repo->find($id);
        return $this->render('club/detailsClub.html.twig',["club"=>$club]);
    }

    #[Route('/removeClub/{id}', name: 'club_remove')]
    public function removeClub(ManagerRegistry $doctrine,$id) :Response {
        $em = $doctrine->getManager();
        $repo= $doctrine->getRepository(Club::class);
        $club = $repo->find($id);
        $em->remove($club);
        $em->flush();
        return  $this->redirectToRoute('club_get_all');
    }
}
