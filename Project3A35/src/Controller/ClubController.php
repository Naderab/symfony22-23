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

    #[Route('/getclubs', name: 'app_club_get')]
    public function getClub(ClubRepository $repository): Response
    {
        $clubs = $repository->findAll();
        return $this->render('club/index.html.twig', [
            'clubs' => $clubs,
        ]);
    }

    // #[Route('/club/details/{id}', name: 'app_club_details')]
    // public function clubDetails(ClubRepository $repository,$id): Response
    // {
    //     $club = $repository->find($id);
    //     return $this->render('club/details.html.twig', [
    //         'club' => $club,
    //     ]);
    // }

    #[Route('/club/details/{id}', name: 'app_club_details')]
    public function clubDetails(ManagerRegistry $em,$id): Response
    {
        $repository = $em->getRepository(Club::class);
        $club = $repository->find($id);
        return $this->render('club/details.html.twig', [
            'club' => $club,
        ]);
    }
}
