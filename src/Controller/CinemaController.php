<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CinemaController extends AbstractController
{
    #[Route('/', name: 'cinema_home')]
    public function index(): Response
    {
        return $this->render('cinema/index.html.twig', [
            'titre' => 'Accueil Cinéma',
        ]);
    }
    /* #[Route('/films', name: 'cinema_films', methods: ['GET'])]
    public function liste(): Response {} */
}
