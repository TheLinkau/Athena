<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Repository\ResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RankingController extends AbstractController
{

    /**
     * @Route("/quiz/{quiz}", name="ranking")
     */
    public function index(ResultRepository $repo, Quiz $quiz)
    {
        // Récupération de tous les résultats du quiz
        $results = $repo->findByQuiz($quiz);
        // Parmis ces résultats, on garde pour chaque utilisateur son meilleur score
        $resultsDico = array();
        foreach ($results as $value) {
            if (array_key_exists($value->getUser()->getId(), $resultsDico)) {
                if ($resultsDico[$value->getUser()->getId()]->getScore() < $value->getScore()) {
                    $resultsDico[$value->getUser()->getId()] = $value;
                }
            } else {
                $resultsDico[$value->getUser()->getId()] = $value;
            }
        }

        dump($quiz);

    return $this->render('ranking/ranking.html.twig', ["results" => $resultsDico, "quiz" => $quiz/*, "total" => count($quiz->getQuestions())*/]);
    }
}
