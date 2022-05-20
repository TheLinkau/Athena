<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use App\Entity;



class SecurityController extends AbstractController
{
    /**
     * @var  EntityManagerInterface $em
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em =$em;
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
       // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array('last_username' => $lastUsername, 'error' => $error));
    }

     /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $u1 = new Entity\User();

        $formUser = $this->createForm(UserType::class, $u1, array('method' => 'put'));

        $formUser->handleRequest($request);

        if($formUser->isSubmitted() && $formUser->isValid()){ 
            $u1->setRoles(["ROLE_USER"]);
            $u1->setPassword(
                $passwordEncoder->encodePassword(
                    $u1,
                    $formUser->get('plainPassword')->getData()
                )
            );
            $this->em->persist($u1);
            $this->em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('security/inscription.html.twig', [
            'formUser' => $formUser->createView()
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}