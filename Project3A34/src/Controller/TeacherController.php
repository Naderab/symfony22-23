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

    #[Route('/showteacher/{name}', name: 'app_teacher')]
    public function showTeacher($name): Response
    {
        //return new Response('Hello'.$name);
        return $this->render('teacher/showTeacher.html.twig', [
            'nom' => $name,'para2'=>'parametre 2','para3'=>'para3'
        ]);
    }
}
