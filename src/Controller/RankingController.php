<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Repository\ResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RankingController extends AbstractController
{
    public function cmp($res1, $res2)
    {
        return $res1->getScore() < $res2->getScore();
    }

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

        // On trie sur le score
        usort($resultsDico, array($this, "cmp"));
        // Et on garde les 10 meilleurs
        $resultsDico = array_slice($resultsDico, 0, 10);

        return $this->render('ranking/ranking.html.twig', ["results" => $resultsDico, "quiz" => $quiz, "total" => count($quiz->getQuestions())]);
    }
}
