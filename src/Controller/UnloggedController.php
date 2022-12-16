<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UnloggedController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // phpinfo();
        // die();
        return $this->render("unlogged/home.html.twig");
    }
    
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser()){
            return $this->redirectToRoute("app_dashboard");
        }
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->renderForm("unlogged/login.html.twig", [
            'last_username' => $lastUsername,
            'error' => $error,
            'reason' => ''
        ]);
    }

    #[Route('/confirm', name: 'app_confirm')]
    public function confirm(): Response
    {
        return $this->render('unlogged/confirm.html.twig');
    }

    #[Route('/conrifm_success', name: 'app_confirm_success')]
    public function confirmSuccess(): Response
    {
        return $this->render('unlogged/confirmSuccess.html.twig');
    }
}
