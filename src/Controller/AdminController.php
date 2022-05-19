<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\QuizRepository;
use App\Repository\UserRepository;
use App\Entity\Quiz;
use App\Entity\User;

class AdminController extends AbstractController
{
    private $quizRepository;
    private $userRepository;

    public function __construct(QuizRepository $quizRepository, UserRepository $userRepository) {
        $this->quizRepository = $quizRepository;
        $this->userRepository = $userRepository;
    }
    
    /**
     * @Route("/admin/quiz", name="admin.quiz.index")
     */
    public function indexQuiz()
    {
        $quiz = $this->quizRepository->findAll();
        return $this->render('admin/quiz/index.html.twig', [
            'quiz' => $quiz
        ]);
    }

    /**
     * @Route("/admin/quiz/delete/{id}", name="admin.quiz.delete")
     */
    public function deleteQuiz(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $quiz = $this->quizRepository->find($id);
        $em->remove($quiz);
        $em->flush();
        return $this->redirectToRoute('admin.quiz.index');
    }
    
    /**
     * @Route("/admin/user", name="admin.user.index")
     */
    public function indexUser()
    {
        $users = $this->userRepository->findAll();
        return $this->render('admin/user/index.html.twig', [
            'users' => $users
        ]);
    }
    
    /**
     * @Route("/admin/user/promote/{id}", name="admin.user.promote")
     */
    public function promoteUser(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->userRepository->find($id);
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('admin.user.index');
    }
    
    /**
     * @Route("/admin/user/demote/{id}", name="admin.user.demote")
     */
    public function demoteUser(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->userRepository->find($id);
        $user->setRoles(["ROLE_USER"]);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('admin.user.index');
    }
    
    /**
     * @Route("/admin/utilisateur/delete/{id}", name="admin.user.delete")
     */
    public function deleteUser(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->userRepository->find($id);
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('admin.user.index');
    }
}
