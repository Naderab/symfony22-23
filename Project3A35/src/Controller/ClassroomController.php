<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Classroom;
use App\Form\ClassroomType;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(ClassroomRepository $classroomRepository): Response
    {
        $classrooms = $classroomRepository->findAll();
        return $this->render('classroom/index.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    #[Route('/classroom/add', name: 'add_classroom')]
    public function addClassroom(ManagerRegistry $doctrine,Request $req) :Response {
        $em = $doctrine->getManager();
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('app_classroom');
        }

        return $this->renderForm('classroom/add.html.twig',['form'=>$form]);
    
    }
    #[Route('/classroom/remove/{id}', name: 'remove_classroom')]
    public function classroomremove (ManagerRegistry $doctrine ,$id)
    {
        $manager=$doctrine->getManager();
        $repository=$doctrine->getRepository(Classroom::class);
        $classroom=$repository->find($id);
        $manager->remove($classroom);
        $manager->flush();
        return $this->redirectToRoute('app_classroom');

    }
    #[Route('classroom/update/{id}', name: 'update')]
    public function update( ManagerRegistry $doctrine, $id, Request $request): Response{
        $em= $doctrine->getManager();
        $classroom=$doctrine->getRepository(Classroom::class)->find($id);
        $form=$this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $em->flush();
            return $this->redirectToRoute('app_classroom');
        
        }
        return $this->renderForm('classroom/add.html.twig',['form'=>$form]);


    }
}
