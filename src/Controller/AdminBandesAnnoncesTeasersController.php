<?php

namespace App\Controller;

use App\Entity\BandesAnnoncesTeasers;
use App\Form\BandesAnnoncesTeasersType;
use App\Repository\BandesAnnoncesTeasersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/bandes/annonces/teasers')]
class AdminBandesAnnoncesTeasersController extends AbstractController
{
    #[Route('/', name: 'app_bandes_annonces_teasers_index', methods: ['GET'])]
    public function index(BandesAnnoncesTeasersRepository $bandesAnnoncesTeasersRepository): Response
    {
        return $this->render('bandes_annonces_teasers/index.html.twig', [
            'bandes_annonces_teasers' => $bandesAnnoncesTeasersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bandes_annonces_teasers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bandesAnnoncesTeaser = new BandesAnnoncesTeasers();
        $form = $this->createForm(BandesAnnoncesTeasersType::class, $bandesAnnoncesTeaser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bandesAnnoncesTeaser);
            $entityManager->flush();

            return $this->redirectToRoute('app_bandes_annonces_teasers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bandes_annonces_teasers/new.html.twig', [
            'bandes_annonces_teaser' => $bandesAnnoncesTeaser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bandes_annonces_teasers_show', methods: ['GET'])]
    public function show(BandesAnnoncesTeasers $bandesAnnoncesTeaser): Response
    {
        return $this->render('bandes_annonces_teasers/show.html.twig', [
            'bandes_annonces_teaser' => $bandesAnnoncesTeaser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bandes_annonces_teasers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BandesAnnoncesTeasers $bandesAnnoncesTeaser, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BandesAnnoncesTeasersType::class, $bandesAnnoncesTeaser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_bandes_annonces_teasers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bandes_annonces_teasers/edit.html.twig', [
            'bandes_annonces_teaser' => $bandesAnnoncesTeaser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bandes_annonces_teasers_delete', methods: ['POST'])]
    public function delete(Request $request, BandesAnnoncesTeasers $bandesAnnoncesTeaser, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bandesAnnoncesTeaser->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bandesAnnoncesTeaser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bandes_annonces_teasers_index', [], Response::HTTP_SEE_OTHER);
    }
}
