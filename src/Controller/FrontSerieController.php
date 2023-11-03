<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontSerieController extends AbstractController
{
    #[Route('/front/serie', name: 'app_front_serie')]
    public function index(): Response
    {
        return $this->render('front_serie/index.html.twig', [
            'controller_name' => 'FrontSerieController',
        ]);
    }
}
