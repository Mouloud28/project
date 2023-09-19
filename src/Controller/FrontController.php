<?php

namespace App\Controller;

use App\Model\SearchData;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    #[Route('/front', name: 'app_front')]
    public function index(Request $request): Response
    {
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $searchData->page = $request->query->getInt('page', 1);
        }

        return $this->render('front/index.html.twig', [
            'form' => $form->createView(),
            // 'controller_name' => 'FrontController',
        ]);
    }
}
