<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classroom;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ClassroomType;

class ClassroomController extends AbstractController
{
    #[Route('/classroom/fetch', name: 'app_classroom')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $classrooms = $doctrine->getRepository(Classroom::class)->findAll(); 
        return $this->render('classroom/index.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    #[Route('/classroom/add', name: 'add_classroom')]
    public function add(ManagerRegistry $doctrine,Request $req): Response
    {
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($req);
        $em= $doctrine->getManager();
        if($form->isSubmitted()){
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('app_classroom');
        }
      
        return $this->renderForm('classroom/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/classroom/update/{id}', name: 'update_classroom')]
    public function update(ManagerRegistry $doctrine,Request $req,$id): Response
    {
        $classroom = $doctrine->getRepository(Classroom::class)->find($id);
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($req);
        $em= $doctrine->getManager();
        if($form->isSubmitted()){
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('app_classroom');
        }
      
        return $this->renderForm('classroom/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/classroom/remove/{id}', name: 'remove_classroom')]
    public function delete(ManagerRegistry $doctrine,$id) :Response {
        $em = $doctrine->getManager();
        $classroom = $doctrine->getRepository(Classroom::class)->find($id);
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute('app_classroom');
    }
}
