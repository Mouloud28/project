<?php

namespace App\Controller;

use App\Entity\Search;
use App\Form\SearchType;
use App\Repository\FilmRepository;
use App\Repository\AlbumRepository;
use App\Repository\LivreRepository;
use App\Repository\SerieRepository;
use App\Repository\SearchRepository;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/search')]
class SearchController extends AbstractController
{

    #[Route('/', name: 'app_search_index', methods: ['GET'])]
    public function index(SearchRepository $searchRepository, Request $request, ArtisteRepository $artisteRepository, FilmRepository $filmRepository, SerieRepository $serieRepository, AlbumRepository $albumRepository, LivreRepository $livreRepository): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        // Gérez la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérez les paramètres de recherche
            $type = $search->getType();
            $terme = $search->getTerme();

            // En fonction du type de recherche, exécutez la recherche appropriée
            switch ($type) {
                case 'artiste':
                    $results = $artisteRepository->findBySearch($search);
                    break;
                case 'film':
                    $results = $filmRepository->findBySearch($search);
                    break;
                case 'serie':
                    $results = $serieRepository->findBySearch($search);
                    break;
                case 'album':
                    $results = $albumRepository->findBySearch($search);
                    break;
                case 'livre':
                    $results = $livreRepository->findBySearch($search);
                    break;
                default:
                    // Type de recherche non pris en charge
                    $results = [];
            }

            // Paginez les résultats
            $page = $request->query->getInt('page', 1);
            $perPage = 10; // Nombre d'éléments par page
            $offset = ($page - 1) * $perPage;
            $paginatedResults = array_slice($results, $offset, $perPage);

            // Affichez les résultats dans le modèle de vue approprié
            return $this->render('search/index.html.twig', [
                'form' => $form->createView(),
                'results' => $paginatedResults,
            ]);
        }

        // Affichez le formulaire de recherche vide
        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'results' => [],
        ]);

        return $this->render('search/index.html.twig', [
            'searches' => $searchRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_search_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($search);
            $entityManager->flush();

            return $this->redirectToRoute('app_search_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('search/new.html.twig', [
            'search' => $search,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_search_show', methods: ['GET'])]
    public function show(Search $search): Response
    {
        return $this->render('search/show.html.twig', [
            'search' => $search,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_search_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Search $search, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_search_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('search/edit.html.twig', [
            'search' => $search,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_search_delete', methods: ['POST'])]
    public function delete(Request $request, Search $search, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $search->getId(), $request->request->get('_token'))) {
            $entityManager->remove($search);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_search_index', [], Response::HTTP_SEE_OTHER);
    }

    public function search()
    {
        // Créez une instance de la classe Recherche et associez-la à RechercheType



    }
}
