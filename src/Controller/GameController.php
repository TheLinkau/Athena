<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use DateTime;

class GameController extends AbstractController
{
    /**
     * @Route("/quiz/play/{quiz}", name="game")
     */
    public function index(Quiz $quiz, Request $request)
    {
        // Requête Ajax score
        if ($request->isXmlHttpRequest() && $request->request->get('score') != null) {
            $em = $this->getDoctrine()->getManager();
            $result = new Result();
            $result->setScore(intval($request->request->get('score')));
            $result->setUser($this->getUser());
            $result->setQuiz($quiz);
            $result->setDate(new DateTime);
            $em->persist($result);
            $em->flush();
            return new JsonResponse($this->generateUrl('home'));
        }

        // On stringify les questions (contenu + r1 + r2 + r3 + r4 + bonnereponse + ...) pour pouvoir les passer au js a travers le twig
        // Les string sont séparées d'un | pour le split js
        $questions = "";
        foreach($quiz->getQuestions() as $q) {
            $questions .= $q->getContent()
            . "|" . $q->getAnswers()[0]
            . "|" . $q->getAnswers()[1]
            . "|" . $q->getAnswers()[2]
            . "|" . $q->getAnswers()[3]
            . "|" . $q->getRightAnswer()
            . "|" . $q->getImage() . "|";
        }
        return $this->render('game/game.html.twig', ["titre" => $quiz->getName(), "questions" => $questions]);
    }
}
