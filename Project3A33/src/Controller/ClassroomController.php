<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClassroomRepository;
use App\Entity\Classroom;
use App\Form\ClassroomType;
class ClassroomController extends AbstractController
{
    #[Route('/classroom/fetch', name: 'app_classroom')]
    public function index(ClassroomRepository $repo): Response
    {
        $classrooms = $repo->findAll();
        return $this->render('classroom/index.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    #[Route('/classroom/add', name: 'add_classroom')]
    public function add(ManagerRegistry $doctrine,Request $request): Response
    {
        $em = $doctrine->getManager();
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('app_classroom');
        }
        return $this->renderForm('classroom/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/classroom/remove/{id}', name: 'remove_classroom')]
    public function remove(ManagerRegistry $doctrine,$id): Response
    {
        $em = $doctrine->getManager();
        $classroom = $doctrine->getRepository(Classroom::class)->find($id);
        
            $em->remove($classroom);
            $em->flush();
            return $this->redirectToRoute('app_classroom');
        
    }

    #[Route('/classroom/update/{id}', name: 'update_classroom')]
    public function update(ManagerRegistry $doctrine,Request $request,$id): Response
    {
        $em = $doctrine->getManager();
        $classroom = $doctrine->getRepository(Classroom::class)->find($id);
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            // $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('app_classroom');
        }
        return $this->renderForm('classroom/add.html.twig', [
            'form' => $form,
        ]);
    }
}
