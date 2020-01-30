<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registration(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(
            RegistrationType::class, $user,
            [
                'validation_groups' => ['registration', 'Default']
            ]
        );

        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }
}
