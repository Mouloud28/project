<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Album;
use App\Entity\Livre;
use App\Entity\Serie;
use App\Form\FilmType;
use App\Form\AlbumType;
use App\Form\LivreType;
use App\Form\SerieType;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontCreationController extends AbstractController
{
    #[Route('/front/creation/1', name: 'app_creation')]
    public function page1(Request $request, CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();

        $categorie = new Categorie(); // Créez une nouvelle instance de Categorie
        $form = $this->createForm(CategorieType::class, $categorie, [
            'categories' => $categories, // Passez les catégories au formulaire
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $selectedCategorie = $categorie->getNom(); // Récupérez la catégorie sélectionnée

            return $this->redirectToRoute('app_creation2', ['categorie' => $selectedCategorie]);
        }

        return $this->render('front_creation/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/front/creation/2', name: 'app_creation2')]
    public function page2(Request $request, EntityManagerInterface $entityManager): Response
    {
        $selectedCategorie = $request->get('categorie');
        $formData = null;
        // $formType = LivreType::class;

        switch ($selectedCategorie) {

            case 'Livre':
                $formData = new Livre();
                $formType = LivreType::class;

                $form = $this->createForm($formType, $formData);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // Gérez la validation et la sauvegarde du formulaire ici
                    $entityManager->persist($formData);
                    $entityManager->flush();

                    // Redirigez l'utilisateur vers la page d'accueil ou ailleurs après la création
                    return $this->redirectToRoute('app_front');
                }

                return $this->render('front_creation/index2.html.twig', [
                    'form' => $form->createView(),
                ]);

                break;

            case 'Film':
                $formData = new Film();
                $formType = FilmType::class;

                $form = $this->createForm($formType, $formData);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // Gérez la validation et la sauvegarde du formulaire ici
                    $entityManager->persist($formData);
                    $entityManager->flush();

                    // Redirigez l'utilisateur vers la page d'accueil ou ailleurs après la création
                    return $this->redirectToRoute('app_front');
                }

                return $this->render('front_creation/index2.html.twig', [
                    'form' => $form->createView(),
                ]);

                break;

            case 'Série':
                $formData = new Serie();
                $formType = SerieType::class;

                $form = $this->createForm($formType, $formData);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // Gérez la validation et la sauvegarde du formulaire ici
                    $entityManager->persist($formData);
                    $entityManager->flush();

                    // Redirigez l'utilisateur vers la page d'accueil ou ailleurs après la création
                    return $this->redirectToRoute('app_front');
                }

                return $this->render('front_creation/index2.html.twig', [
                    'form' => $form->createView(),
                ]);

                break;

            case 'Album':
                $formData = new Album();
                $formType = AlbumType::class;

                $form = $this->createForm($formType, $formData);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // Gérez la validation et la sauvegarde du formulaire ici
                    $entityManager->persist($formData);
                    $entityManager->flush();

                    // Redirigez l'utilisateur vers la page d'accueil ou ailleurs après la création
                    return $this->redirectToRoute('app_front');
                }

                return $this->render('front_creation/index2.html.twig', [
                    'form' => $form->createView(),
                ]);

                break;
        }

        // Redirigez l'utilisateur vers la page d'accueil ou ailleurs après la création
        return $this->redirectToRoute('app_front');
    }
}
