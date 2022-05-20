<?php

namespace App\Controller;

use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    
    /**
     * @Route("/accueil", name="home")
     */
    public function index(QuizRepository $repo)
    {
        // Récupération de tous les quiz
        $results = $repo->findAll();
        return $this->render('home/accueil.html.twig',
                             ['tabQuiz'=>$results]);
    }
}
