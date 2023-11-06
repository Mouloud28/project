<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('front/user')]
class FrontUserController extends AbstractController
{
    #[Route('/', name: 'app_front_user')]
    public function index(): Response
    {
        return $this->render('front_user/index.html.twig', [
            'controller_name' => 'FrontUserController',
        ]);
    }

    #[Route('/edit/profile', name: 'app_front_user_edit', methods: ['GET', 'POST'])]
    public function editProfile(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('message', 'Profil mis à jour !');
            return $this->redirectToRoute('app_front_user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front_user/editprofile.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/edit/password', name: 'app_front_password_edit', methods: ['GET', 'POST'])]
    public function editPassword(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): Response
    {
        if ($request->isMethod('POST')) {
            // $user = $this->getUser();
            // On vérifie si les 2 mots de passe sont identiques.

            if ($request->request->get('pass') ==  $request->request->get('pass2')) {
                $user->setPassword($passwordEncoder->hashPassword($user, $request->request->get('pass')));
                $entityManager->flush();
                $this->addFlash('message', 'Mot de passe mis à jour avec succès.');
            } else {
                $this->addFlash('error', 'Les deux mot de passe ne sont pas identiques.');
            }
        }
        return $this->render('front_user/editpassword.html.twig');
    }
}
