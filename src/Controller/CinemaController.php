<?php

namespace App\Controller;

use App\Form\FilmSearchType;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/films', name: 'films_list')]
    public function filmList(
        FilmRepository $filmRepository,
        Request $request,
    ): Response {
        $filmGenre = $filmRepository->findDistinctGenres();//Je requete mes genre de film ici pour que la liste soit toujours a jours de ce qui est dispo 
        $form = $this->createForm(FilmSearchType::class,null,['genres' => $filmGenre]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $criteria = $form->getData();
            
            $films = $filmRepository->findAllWithSeances($criteria);
        } else {
            $films = $filmRepository->findAllWithSeances();
        }
        return $this->render('films/liste.html.twig', [
            'titre' => 'Liste des Films',
            'searchForm' => $form,
            'films' => $films,
            'genre' => $filmGenre
        ]);
    }

    /*     #[Route('/films/search', name: 'app_films_search')]
    public function search(
        Request $request,
        FilmRepository $filmRepository
    ): Response {
        $form = $this->createForm(FilmSearchType::class);
        $form->handleRequest($request);
        $films = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $criteria = $form->getData();
            $films = $filmRepository->findBySearchCriteria($criteria);
        }
        return $this->render('film/search.html.twig', [
            'form' => $form,
            'films' => $films,
        ]);
    } */
}
