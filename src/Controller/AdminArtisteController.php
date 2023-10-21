<?php

namespace App\Controller;

use App\Entity\Search;
use App\Entity\Artiste;
use App\Form\SearchType;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/artiste')]
class AdminArtisteController extends AbstractController
{
    #[Route('/', name: 'app_admin_artiste_index', methods: ['GET'])]
    public function index(ArtisteRepository $artisteRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $search->getPage($request -> query -> getInt('page', 1));

            $pagination = $paginator->paginate(
                $artisteRepository -> findBySearch($search), /* query NOT result */
                $request->query->getInt('artiste', 1), /*page number*/
                10,  /*limit per page*/
                ["pageParameterName" => "artiste"]
            );
            return $this->render('admin_artiste/index.html.twig', [
                'form' => $form->createView(),
                'artistes' => $pagination
            ]);
        }

        $pagination = $paginator->paginate(
            $artisteRepository -> findAll(), /* query NOT result */
            $request->query->getInt('artiste', 1), /*page number*/
            10,  /*limit per page*/
            ["pageParameterName" => "artiste"]
        );

        return $this->render('admin_artiste/index.html.twig', [
            'form' => $form -> createView(),
            'artistes' => $pagination
        ]);
    }

    #[Route('/new', name: 'app_admin_artiste_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $artiste = new Artiste();
        $form = $this->createForm(ArtisteType::class, $artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($artiste);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_artiste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_artiste/new.html.twig', [
            'artiste' => $artiste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_artiste_show', methods: ['GET'])]
    public function show(Artiste $artiste): Response
    {
        return $this->render('admin_artiste/show.html.twig', [
            'artiste' => $artiste,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_artiste_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Artiste $artiste, EntityManagerInterface $entityManager): Response
    {
        // $imageFile = $artiste->getImageFile();
        $form = $this->createForm(ArtisteType::class, $artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // if ($artiste->getImageFile() === null) {
            //      $imageFile = $entityManager->getRepository(Artiste::class)->find($artiste->getId())->getImageFile();
            //      $artiste->setImageFile($imageFile); // Réaffecter la photo originale
            //  }

            $entityManager->flush();

            return $this->redirectToRoute('app_admin_artiste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_artiste/edit.html.twig', [
            'artiste' => $artiste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_artiste_delete', methods: ['POST'])]
    public function delete(Request $request, Artiste $artiste, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artiste->getId(), $request->request->get('_token'))) {
            $entityManager->remove($artiste);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_artiste_index', [], Response::HTTP_SEE_OTHER);
    }
}
