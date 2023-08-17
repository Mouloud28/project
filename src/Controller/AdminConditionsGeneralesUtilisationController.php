<?php

namespace App\Controller;

use App\Entity\ConditionsGeneralesUtilisation;
use App\Form\ConditionsGeneralesUtilisationType;
use App\Repository\ConditionsGeneralesUtilisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/conditions/generales/utilisation')]
class AdminConditionsGeneralesUtilisationController extends AbstractController
{
    #[Route('/', name: 'app_admin_conditions_generales_utilisation_index', methods: ['GET'])]
    public function index(ConditionsGeneralesUtilisationRepository $conditionsGeneralesUtilisationRepository): Response
    {
        return $this->render('admin_conditions_generales_utilisation/index.html.twig', [
            'conditions_generales_utilisations' => $conditionsGeneralesUtilisationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_conditions_generales_utilisation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $conditionsGeneralesUtilisation = new ConditionsGeneralesUtilisation();
        $form = $this->createForm(ConditionsGeneralesUtilisationType::class, $conditionsGeneralesUtilisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conditionsGeneralesUtilisation);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_conditions_generales_utilisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_conditions_generales_utilisation/new.html.twig', [
            'conditions_generales_utilisation' => $conditionsGeneralesUtilisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_conditions_generales_utilisation_show', methods: ['GET'])]
    public function show(ConditionsGeneralesUtilisation $conditionsGeneralesUtilisation): Response
    {
        return $this->render('admin_conditions_generales_utilisation/show.html.twig', [
            'conditions_generales_utilisation' => $conditionsGeneralesUtilisation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_conditions_generales_utilisation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ConditionsGeneralesUtilisation $conditionsGeneralesUtilisation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConditionsGeneralesUtilisationType::class, $conditionsGeneralesUtilisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_conditions_generales_utilisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_conditions_generales_utilisation/edit.html.twig', [
            'conditions_generales_utilisation' => $conditionsGeneralesUtilisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_conditions_generales_utilisation_delete', methods: ['POST'])]
    public function delete(Request $request, ConditionsGeneralesUtilisation $conditionsGeneralesUtilisation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conditionsGeneralesUtilisation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($conditionsGeneralesUtilisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_conditions_generales_utilisation_index', [], Response::HTTP_SEE_OTHER);
    }
}
