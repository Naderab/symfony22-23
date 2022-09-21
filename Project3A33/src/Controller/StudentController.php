<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class StudentController extends AbstractController{

    #[Route('/bonjour',name:'index')]
    public function index(): Response {
        return new Response("Bonjour mes étudiants");
    }

    #[Route('/bonjour2',name:'index2')]
    public function index2(): Response {
        return new Response("Bonjour mes étudiants 2");
    }
}
?>