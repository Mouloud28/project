<?php

namespace App\Controller;

use App\Entity\RoleArtisteFilm;
use App\Form\RoleArtisteFilmType;
use App\Repository\RoleArtisteFilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/role/artiste/film')]
class RoleArtisteFilmController extends AbstractController
{
    #[Route('/', name: 'app_role_artiste_film_index', methods: ['GET'])]
    public function index(RoleArtisteFilmRepository $roleArtisteFilmRepository): Response
    {
        return $this->render('role_artiste_film/index.html.twig', [
            'role_artiste_films' => $roleArtisteFilmRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_role_artiste_film_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $roleArtisteFilm = new RoleArtisteFilm();
        $form = $this->createForm(RoleArtisteFilmType::class, $roleArtisteFilm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($roleArtisteFilm);
            $entityManager->flush();

            return $this->redirectToRoute('app_role_artiste_film_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('role_artiste_film/new.html.twig', [
            'role_artiste_film' => $roleArtisteFilm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_role_artiste_film_show', methods: ['GET'])]
    public function show(RoleArtisteFilm $roleArtisteFilm): Response
    {
        return $this->render('role_artiste_film/show.html.twig', [
            'role_artiste_film' => $roleArtisteFilm,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_role_artiste_film_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RoleArtisteFilm $roleArtisteFilm, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RoleArtisteFilmType::class, $roleArtisteFilm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_role_artiste_film_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('role_artiste_film/edit.html.twig', [
            'role_artiste_film' => $roleArtisteFilm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_role_artiste_film_delete', methods: ['POST'])]
    public function delete(Request $request, RoleArtisteFilm $roleArtisteFilm, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$roleArtisteFilm->getId(), $request->request->get('_token'))) {
            $entityManager->remove($roleArtisteFilm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_role_artiste_film_index', [], Response::HTTP_SEE_OTHER);
    }
}
