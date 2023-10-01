<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Search;
use App\Form\FilmType;
use App\Form\SearchType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/film')]
class AdminFilmController extends AbstractController
{
    #[Route('/', name: 'app_admin_film_index', methods: ['GET'])]
    public function index(FilmRepository $filmRepository, Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $search->getPage($request -> query -> getInt('page', 1));
            $films = $filmRepository -> findBySearch($search);

            return $this->render('admin_film/index.html.twig', [
                'form' => $form->createView(),
                'films' => $films
            ]);
        }
        return $this->render('admin_film/index.html.twig', [
            'form' => $form -> createView(),
            'films' => $filmRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_film_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $film = new Film();
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($film);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_film_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_film/new.html.twig', [
            'film' => $film,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_film_show', methods: ['GET'])]
    public function show(Film $film): Response
    {
        return $this->render('admin_film/show.html.twig', [
            'film' => $film,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_film_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Film $film, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_film_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_film/edit.html.twig', [
            'film' => $film,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_film_delete', methods: ['POST'])]
    public function delete(Request $request, Film $film, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$film->getId(), $request->request->get('_token'))) {
            $entityManager->remove($film);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_film_index', [], Response::HTTP_SEE_OTHER);
    }
}
