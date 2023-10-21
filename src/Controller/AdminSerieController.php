<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Entity\Search;
use App\Form\SerieType;
use App\Form\SearchType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/serie')]
class AdminSerieController extends AbstractController
{
    #[Route('/', name: 'app_admin_serie_index', methods: ['GET'])]
    public function index(SerieRepository $serieRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $search->getPage($request -> query -> getInt('page', 1));

            $pagination = $paginator->paginate(
                $serieRepository -> findBySearch($search), /* query NOT result */
                $request->query->getInt('serie', 1), /*page number*/
                10,  /*limit per page*/
                ["pageParameterName" => "serie"]
            );

            return $this->render('admin_serie/index.html.twig', [
                'form' => $form->createView(),
                'series' => $pagination
            ]);
        }

        $pagination = $paginator->paginate(
            $serieRepository -> findAll(), /* query NOT result */
            $request->query->getInt('serie', 1), /*page number*/
            10,  /*limit per page*/
            ["pageParameterName" => "serie"]
        );

        return $this->render('admin_serie/index.html.twig', [
            'form' => $form->createView(),
            'series' => $pagination
        ]);
    }

    #[Route('/new', name: 'app_admin_serie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $serie = new Serie();
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($serie);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_serie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_serie/new.html.twig', [
            'serie' => $serie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_serie_show', methods: ['GET'])]
    public function show(Serie $serie): Response
    {
        return $this->render('admin_serie/show.html.twig', [
            'serie' => $serie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_serie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Serie $serie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_serie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_serie/edit.html.twig', [
            'serie' => $serie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_serie_delete', methods: ['POST'])]
    public function delete(Request $request, Serie $serie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$serie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($serie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_serie_index', [], Response::HTTP_SEE_OTHER);
    }
}
