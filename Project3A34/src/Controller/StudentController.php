<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Student;
use App\Form\StudentType;
use App\Form\SearchNscType;

use Doctrine\Persistence\ManagerRegistry;
use App\Repository\StudentRepository;

class StudentController extends AbstractController{

    #[Route('/bonjour',name:'bonjour')]
    public function index() : Response {
        return new Response("Bonjour mes étudiants");
    }
    #[Route('student/fetch', name: 'student_fetch')]
    public function fetch(ManagerRegistry $doctrine,Request $req): Response
    {
        $students= $doctrine->getRepository(Student::class)->findAll();
        $studentsOrdredByEmail= $doctrine->getRepository(Student::class)->getStudentsOrdredByEmail();
        $studentsNA= $doctrine->getRepository(Student::class)->getStudentsNotAdmitted();

        $form = $this->createForm(SearchNscType::class);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $filtre = $form['filtre']->getData();
            // $email = $form['email']->getData();
            $studentsSearch = $doctrine->getRepository(Student::class)->searchBy($filtre);
            return $this->renderForm('student/index.html.twig', [
                'students' => $studentsSearch,
                'studentsOE' => $studentsOrdredByEmail,
                'studentsNA' => $studentsNA,

                'form'=>$form
    
                
            ]);
        }
        //$club= $doctrine->getRepository(Club::class)->find('1');
        return $this->renderForm('student/index.html.twig', [
            'students' => $students,
            'studentsOE' => $studentsOrdredByEmail,
            'studentsNA' => $studentsNA,

            'form'=>$form

            
        ]);
    }


    #[Route('student/remove/{id}', name: 'student_remove')]
    public function remove(ManagerRegistry $doctrine,$id): Response
    {
        $em= $doctrine->getManager();
        $student= $doctrine->getRepository(Student::class)->find($id);
        $em->remove($student);
        $em->flush();
        return $this->redirectToRoute('student_fetch');
    }

    #[Route('student/add', name: 'student_add')]
    public function add(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $student = new Student();
        $form = $this->createForm(StudentType::class,$student);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute('student_fetch');
        }
        //$club->setName('club test persist');
        //$club->setCreationDate(new \DateTime());
        return $this->renderForm('student/add.html.twig',['form'=>$form]);
    }
    #[Route('student/update/{id}', name: 'student_update')]
    public function update(ManagerRegistry $doctrine,$id,Request $req): Response {
        $em = $doctrine->getManager();
        $student = $doctrine->getRepository(Student::class)->find($id);
        $form = $this->createForm(StudentType::class,$student);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute('student_fetch');
        }
        return $this->renderForm('student/add.html.twig',['form'=>$form]);

    }

    #[Route('student/getByClass/{id}', name: 'student_byclass')]
    public function getByClass($id,StudentRepository $repository) : Response {
        $students = $repository->getStudentsByClass($id);
        return $this->render('student/byclass.html.twig', [
            'students' => $students,
            
        ]);
    }
}
?>