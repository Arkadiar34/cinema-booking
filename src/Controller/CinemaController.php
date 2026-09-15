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

    #[Route('/films', name: 'films_list')]
    public function filmList(
        Request $request,
        FilmRepository $filmRepository,
    ): Response {
        $limit = 12;
        $page = $request->query->getInt('page', 1);
        //Je requete mes genre de film ici pour que la liste soit toujours a jours de ce qui est dispo
        $filmGenre = $filmRepository->findDistinctGenres();
        $form = $this->createForm(FilmSearchType::class, null, ['genres' => $filmGenre]);
        $form->handleRequest($request);

        //je déclare critère vide pour éviter de casser la liste
        $criteria = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $criteria = $form->getData();
        }

        //j'inclus mes critère dans la pagination
        $paginator = $filmRepository->findBySearchCriteria($criteria, $page, $limit);
        $totalPages = ceil(count($paginator) / $limit);

        return $this->render('films/liste.html.twig', [
            'titre' => 'Liste des Films',
            'searchForm' => $form,
            'films' => $paginator,
            'genre' => $filmGenre,
            'totalPages' => $totalPages,
            'pageActuelle' => $page,
        ]);
    }
}
