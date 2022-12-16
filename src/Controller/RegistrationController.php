<?php

namespace App\Controller;

use App\Form\FormCreator;
use App\Mailing\MailSender;
use App\Model\DashboardModel;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private MailSender $mailSender;
    private DashboardModel $model;
    private FormCreator $formCreator;
    private EmailVerifier $emailVerifier;

    public function __construct(MailSender $mailSender, DashboardModel $model, ContainerInterface $container, EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
        $this->mailSender = $mailSender;
        $this->model = $model;
        $this->formCreator = new FormCreator($container);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request): Response
    {
        $form = $this->formCreator->userForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->model->insertUser($form);
            $this->mailSender->sendConfirmation($user);
            return $this->redirectToRoute('app_confirm');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, UserRepository $userRepository): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        return $this->redirectToRoute('app_confirm_success');
    }

}
