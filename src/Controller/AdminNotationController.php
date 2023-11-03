<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Album;
use App\Entity\Livre;
use App\Entity\Serie;
use App\Entity\Notation;
use App\Form\NotationType;
use App\Repository\NotationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/notation')]
class AdminNotationController extends AbstractController
{
    #[Route('/', name: 'app_admin_notation_index', methods: ['GET'])]
    public function index(NotationRepository $notationRepository): Response
    {
        return $this->render('admin_notation/index.html.twig', [
            'notations' => $notationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_notation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $notation = new Notation();
        $form = $this->createForm(NotationType::class, $notation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($notation);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_notation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_notation/new.html.twig', [
            'notation' => $notation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_notation_show', methods: ['GET'])]
    public function show(Notation $notation): Response
    {
        return $this->render('admin_notation/show.html.twig', [
            'notation' => $notation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_notation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Notation $notation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NotationType::class, $notation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_notation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_notation/edit.html.twig', [
            'notation' => $notation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_notation_delete', methods: ['POST'])]
    public function delete(Request $request, Notation $notation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$notation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($notation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_notation_index', [], Response::HTTP_SEE_OTHER);
    }

    public function rateAction(Request $request)
{
    $note = $request->request->get('note');
    $livreId = $request->request->get('livre_id'); // ID de l'élément noté (par exemple, un livre)
    $filmId = $request->request->get('film_id'); // ID de l'élément noté (par exemple, un film)
    $serieId = $request->request->get('serie_id'); // ID de l'élément noté (par exemple, une série)
    $albumId = $request->request->get('album_id'); // ID de l'élément noté (par exemple, un album)

    // Enregistrez la notation en base de données, en associant l'utilisateur actuel
    // et l'élément noté (book, movie, etc.)
    // ...

    // Réponse JSON pour confirmer la notation
    return new JsonResponse(['success' => true]);
}

#[Route('/noter/{type}/{id}', name: 'notation_create', methods: ['POST'])]
public function createNotation(Request $request, EntityManagerInterface $entityManager, $type, $id)
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Créer un nouvel objet Notation
        $notation = new Notation();

        // Traiter la soumission du formulaire
        $form = $this->createForm(NotationType::class, $notation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Associer la notation à l'œuvre et à l'utilisateur
            $notation->setUser($user);

            // Récupérez l'œuvre correspondante en fonction du type
            // $entityManager = [$this->getDoctrine()->getManager()];
            $work = null;

            if ($type === 'Livre') {
                $work = $entityManager->getRepository(Livre::class)->find($id);
                $notation->setLivre($work);
            } elseif ($type === 'Film') {
                $work = $entityManager->getRepository(Film::class)->find($id);
                $notation->setFilm($work);
            } elseif ($type === 'Serie') {
                $work = $entityManager->getRepository(Serie::class)->find($id);
                $notation->setSerie($work);
            } elseif ($type === 'Album') {
                $work = $entityManager->getRepository(Album::class)->find($id);
                $notation->setAlbum($work);
            }

            if (!$work) {
                return $this->redirectToRoute('confirmation_page');
            }

            // Associez l'œuvre à la notation

            // Enregistrez la notation en base de données
            $entityManager->persist($notation);
            $entityManager->flush();

            // Redirection vers une page de confirmation
            return $this->redirectToRoute('confirmation_page');
        }

        return $this->render('notation/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
