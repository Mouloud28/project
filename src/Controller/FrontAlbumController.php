<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontAlbumController extends AbstractController
{
    #[Route('/front/album', name: 'app_front_album')]
    public function index(): Response
    {
        return $this->render('front_album/index.html.twig', [
            'controller_name' => 'FrontAlbumController',
        ]);
    }
}
