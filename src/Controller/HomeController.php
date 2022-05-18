<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    
    /**
     * @Route("/accueil", name="home")
     */
    public function index()
    {
        $tabQuiz = ["test1", "test2", "test2"];
        return $this->render('home/index.html.twig',
                             ['tabQuiz'=>$tabQuiz]);
    }
}
