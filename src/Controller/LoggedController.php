<?php

namespace App\Controller;

use Symfony\Component\Security\Core\User\UserInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FormCreator;
use App\Model\DashboardModel;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LoggedController extends AbstractController
{
    private $model;
    private $formCreator;

    public function __construct(ContainerInterface $container, DashboardModel $model)
    {
        $this->model = $model;
        $this->formCreator = new FormCreator($container);
    }

    #[Route("/profile/{id}", name: "app_profile")]
    public function view_profile($id)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute("app_login");
        }
        if ($id == $this->getUser()->getId()) {
            return $this->redirectToRoute("app_user_profile");
        }
        $usr = $this->model->fetchUserProfile($id);
        if ($usr) {
            return $this->render('logged/viewprofile.html.twig', [
                'profile' => $usr,
                'user' => $this->getUser(),
                'posts' => $this->model->fetchUserPosts($id)
            ]);
        } else {
            throw new NotFoundHttpException("Profile was not found");
        }
    }
    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(Request $request, UserInterface $user): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute("app_logout");
        }

        $form = $this->formCreator->postForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->model->submitPost($user, $form);
            // return $this->renderView()
            // return $this->redirectToRoute("app_dashboard");
        }

        return $this->renderForm('logged/dashboard.html.twig', [
            'user' => $this->getUser(),
            'posts' => $this->model->fetchPosts(),
            'submit' => $form
        ]);
    }

    #[Route('/profile', name: 'app_user_profile')]
    public function profile(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute("app_login");
        }

        $form = $this->formCreator->profileForm($this->model->fetchUserProfile($this->getUser()));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->model->updateProfile($this->getUser(), $form);
            // return $this->redirectToRoute('app_dashboard');
        }
        return $this->renderForm('logged/profile.html.twig', [
            'user' => $this->getUser(),
            'profile' => $this->model->fetchUserProfile($this->getUser()),
            'form' => $form,
            'posts' => $this->model->fetchUserPosts($this->getUser())
        ]);
    }
    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {
        return $this->redirectToRoute("app_login");
    }

    #[Route('/post/{id}', name: 'app_post')]
    public function post($id, Request $request)
    {
        $form = $this->formCreator->commentForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->model->submitComment($form, $this->getUser(), (int)$id);
            return $this->redirectToRoute("app_post", ['id' => $id]);
        }
        return $this->renderForm("logged/post.html.twig", [
            'user' => $this->getUser(),
            'post' => $this->model->fetchPost($id),
            'form' => $form
        ]);
    }
    #[Route('/post/delete/{id}', name: 'app_post_delete')]
    public function deletePost($id)
    {
        $post = $this->model->fetchPost($id);
        if ($this->getUser() != $post->getUser()) {
            return $this->redirectToRoute("app_dashboard");
        } else {
            $this->model->deletePost($id);
            return $this->redirectToRoute("app_dashboard");
        }
    }
    #[Route('/post/delete_comment/{id}', name: 'app_comment_delete')]
    public function deleteComment($id)
    {
        $post = $this->model->fetchComment($id)[0];
        if (($this->getUser())->getId() != ($post->getOwner())->getId()) {
            return $this->redirectToRoute("app_dashboard");
        } else {
            $this->model->deleteComment($id);
            return $this->redirectToRoute("app_dashboard");
        }
    }
    #[Route('/search', name: 'app_search')]
    public function search()
    {

        $results = $this->model->search();
        return $this->render('logged/search.html.twig', [
            'results' => $results,
            'user' => $this->getUser()
        ]);
    }
}
