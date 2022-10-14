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
        $persons = array(array('id'=>'1','name'=>'foulen','email'=>'foulen@gmail.com'),
        array('id'=>'2','name'=>'benfoulen','email'=>'benfoulen@esprit.tn'));
        return $this->render('test_twig/index.html.twig', [
            'controller_name' => 'TestTwigController',
            'var1'=>'valeur test route',
            'p'=>$persons
        ]);
    }

    #[Route('/affiche/{name}', name: 'getname')]
    public function getName($name)
    {
        return $this->render('test_twig/affiche.html.twig', [
            'nom'=>$name
        ]);
    }

    #[Route('/formations', name: 'app_formations')]
    public function getFormations(): Response
    {
        $listTableau = array(
        array('ref' => 'form147', 'Titre' => 'Formation Symfony 4','Description'=>'formation pratique',
            'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020', 'nb_participants'=>19) ,
        array('ref'=>'form177','Titre'=>'Formation SOA' ,
            'Description'=>'formation theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
            'nb_participants'=>0),
        array('ref'=>'form178','Titre'=>'Formation Angular' ,
            'Description'=>'formation theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
            'nb_participants'=>12)

    );
       // var_dump($listTableau);


        return $this->render('test_twig/formations.html.twig', [
            'listeTableau'=> $listTableau
        ]);
    }
    #[Route('/formationDetails/{id}', name: 'app_formation_details')]
    public function detail($id)
    {return $this->render('test_twig/detail.html.twig', [
            'nom'=>$id
        ]);
    }
}
