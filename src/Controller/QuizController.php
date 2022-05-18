<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Quiz;
use App\Entity\Question;
use App\Form\QuizType;
use DateTime;

class QuizController extends AbstractController
{
    
    /**
     * @Route("/quiz/new", name="quiz.new")
     */
    public function newQuiz(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            foreach($form->getExtraData() as $data) {
                $dataQuestion = $data['__name__'];
                $question = new Question();
                $question->setQuiz($quiz);
                $question->setContent($dataQuestion['content']);
                $answers = [];
                $answers[] = $dataQuestion['answerA'];
                $answers[] = $dataQuestion['answerB'];
                $answers[] = $dataQuestion['answerC'];
                $answers[] = $dataQuestion['answerD'];
                $question->setAnswers($answers);
                $question->setRightAnswer($dataQuestion['rightAnswer']);
                $em->persist($question);
            }
            $quiz->setDateCreation(new DateTime);
            $quiz->setCreatedBy('user');
            $em->persist($quiz);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        
        return $this->render('quiz/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
