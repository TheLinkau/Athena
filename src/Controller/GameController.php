<?php

namespace App\Controller;

use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/quiz/play/{quiz}", name="game")
     */
    public function index(Quiz $quiz)
    {
        // On stringify les questions (contenu + r1 + r2 + r3 + r4 + bonnereponse + ...) pour pouvoir les passer au js a travers le twig
        // Les string sont séparées d'un | pour le split js
        $questions = "";
        foreach($quiz->getQuestions() as $q) {
            $questions .= $q->getContent()
            . "|" . $q->getAnswers()[0]
            . "|" . $q->getAnswers()[1]
            . "|" . $q->getAnswers()[2]
            . "|" . $q->getAnswers()[3]
            . "|" . $q->getRightAnswer() . "|";
        }
    return $this->render('game/game.html.twig', ["titre" => $quiz->getName(), "questions" => $questions]);
    }
}
