<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    #[Route('/teacher', name: 'app_teacher')]
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }


    #[Route('/teacher/{name}/{id}/{prenom}', name: 'app_teacher_show')]
    public function index2($name,$id,$prenom): Response
    {
        return $this->render('teacher/showTeacher.html.twig',[
            'name'=>$name,
            'i'=>$id,
            'p'=>$prenom
        ]);
    }
}
