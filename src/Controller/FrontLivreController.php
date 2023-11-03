<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Artiste;
use App\Entity\Editeur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontLivreController extends AbstractController
{
    #[Route('/front/livre/{id}', name: 'app_front_livre')]
    public function index(Livre $livre): Response
    {
        return $this->render('front_livre/index.html.twig', [
            'livre' => $livre,
        ]);
    }

    #[Route('/front/livre/fiche/{id}', name: 'app_front_fiche_livre')]
    public function fiche(Livre $livre, Artiste $artiste, Editeur $editeur): Response
    {
        return $this->render('front_livre/fiche.html.twig', [
            'livre' => $livre,
            'artiste' => $artiste,
            'editeur' => $editeur
        ]);
    }
}
