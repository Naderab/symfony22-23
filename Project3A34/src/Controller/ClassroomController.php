<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ClassroomRepository;
use App\Entity\Classroom;
use App\Form\ClassroomFormType;
class ClassroomController extends AbstractController

{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(ClassroomRepository $classroomRepository, ManagerRegistry $em): Response
    {
        $classrooms = $em->getRepository(Classroom::class)->findAll();
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
            'classrooms'=>$classrooms
        ]);
    }

    #[Route('/addClassroom', name: 'add_classroom')]
    public function addClassroom(ClassroomRepository $classroomRepository, ManagerRegistry $doctrine, Request $req): Response
    {
        $em = $doctrine->getManager();
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomFormType::class,$classroom);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('app_classroom');
        }
        return $this->renderForm('classroom/add.html.twig',['form'=>$form]);

    }
    #[Route('/DeleteClassroom/{id}', name: 'delete_classroom')]
    public function DeleteClassroom( ManagerRegistry $doctrine, $id): Response
    {
        $em = $doctrine->getManager();
        $classroom = $doctrine->getRepository(Classroom::class)->find($id);       

            $em->remove($classroom);
            $em->flush();
            return $this->redirectToRoute('app_classroom');
        
    }
    #[Route('/UpdateClassroom/{id}', name: 'update_classroom')]
    public function UpdateClassroom( ManagerRegistry $doctrine, $id, Request $req): Response
    {
        $em = $doctrine->getManager();
        $classroom = $doctrine->getRepository(Classroom::class)->find($id);       
        $form = $this->createForm(ClassroomFormType::class,$classroom);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('app_classroom');
        }
        return $this->renderForm('classroom/add.html.twig',['form'=>$form]);

    }

}
