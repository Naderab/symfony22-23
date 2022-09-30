<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestTwigController extends AbstractController
{
    #[Route('/test/twig', name: 'app_test_twig')]
    public function index(): Response
    {
        $var1 = 'value';
        $persons = array(
            array('id'=>1,'name'=>'foulen','email'=>'foulen@esprit.tn'),
            array('id'=>2,'name'=>'Benfoulen','email'=>'Benfoulen@esprit.tn')
        );
        return $this->render('test_twig\index.html.twig',['var'=>$var1,'persons'=>$persons]);
    }
}
