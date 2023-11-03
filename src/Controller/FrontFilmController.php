<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Artiste;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontFilmController extends AbstractController
{
    #[Route('/front/film/{id}', name: 'app_front_film')]
    public function index(Film $film): Response
    {
        return $this->render('front_film/index.html.twig', [
            'film' => $film,
        ]);
    }

    #[Route('/front/film/fiche/{id}', name: 'app_front_fiche_film')]
    public function fiche(Film $film, Artiste $artiste): Response
    {
        return $this->render('front_film/fiche.html.twig', [
            'film' => $film,
            'artiste' => $artiste
        ]);
    }
}
