<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Search;
use App\Form\AlbumType;
use App\Form\SearchType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/album')]
class AdminAlbumController extends AbstractController
{
    #[Route('/', name: 'app_admin_album_index', methods: ['GET'])]
    public function index(AlbumRepository $albumRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $search->getPage($request -> query -> getInt('page', 1));

            $pagination = $paginator->paginate(
                $albumRepository -> findBySearch($search), /* query NOT result */
                $request->query->getInt('album', 1), /*page number*/
                10,  /*limit per page*/
                ["pageParameterName" => "album"]
            );

            return $this->render('admin_album/index.html.twig', [
                'form' => $form->createView(),
                'albums' => $pagination
            ]);
        }

        $pagination = $paginator->paginate(
            $albumRepository -> findAll(), /* query NOT result */
            $request->query->getInt('album', 1), /*page number*/
            10,  /*limit per page*/
            ["pageParameterName" => "album"]
        );

        return $this->render('admin_album/index.html.twig', [
            'form' => $form->createView(),
            'albums' => $pagination
        ]);
    }

    #[Route('/new', name: 'app_admin_album_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($album);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_album_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_album/new.html.twig', [
            'album' => $album,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_album_show', methods: ['GET'])]
    public function show(Album $album): Response
    {
        return $this->render('admin_album/show.html.twig', [
            'album' => $album,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_album_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Album $album, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_album_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_album/edit.html.twig', [
            'album' => $album,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_album_delete', methods: ['POST'])]
    public function delete(Request $request, Album $album, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$album->getId(), $request->request->get('_token'))) {
            $entityManager->remove($album);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_album_index', [], Response::HTTP_SEE_OTHER);
    }
}
