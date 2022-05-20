<?php

namespace App\Controller;

use App\Entity;
use App\Repository\ResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{

      /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        $result = $this->getDoctrine()->getRepository(Entity\Result::class)->findBy(['user'=>$this->getUser()]);

        return $this->render('profil/profil.html.twig', array('profil' => $result, 'user' => $this->getUser()));

    }
}