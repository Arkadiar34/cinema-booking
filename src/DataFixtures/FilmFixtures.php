<?php

namespace App\DataFixtures;

use App\Entity\Film;
use App\Entity\Salle;
use App\Entity\Seance;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FilmFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // les salles du cinema
        $donneesSalles = [
            ['numero' => 1, 'nom' => 'Salle Lumière', 'capacite' => 180, 'equipement' => '4K, Dolby Atmos'],
            ['numero' => 2, 'nom' => 'Salle Méliès', 'capacite' => 120, 'equipement' => '3D, Dolby Digital'],
            ['numero' => 3, 'nom' => 'Salle Premium', 'capacite' => 60, 'equipement' => 'IMAX, fauteuils inclinables'],
            ['numero' => 4, 'nom' => 'Salle Godard', 'capacite' => 90, 'equipement' => '4K, son stéréo'],
        ];

        $salles = [];

        foreach ($donneesSalles as $donnee) {
            $salle = new Salle();
            $salle->setNumero($donnee['numero']);
            $salle->setNom($donnee['nom']);
            $salle->setCapacite($donnee['capacite']);
            $salle->setEquipement($donnee['equipement']);

            $manager->persist($salle);
            $salles[] = $salle;
        }

        // les films a l'affiche
        $donneesFilms = [
            ['Matrix', 'Science-Fiction', 136, '1999-06-23', 'Lana et Lilly Wachowski', '9', "Un programmeur découvre que le monde qu'il habite n'est qu'une simulation, et rejoint un groupe de rebelles décidés à renverser les machines."],
            ['Inception', 'Science-Fiction', 148, '2010-07-21', 'Christopher Nolan', '9', "Un voleur capable de s'infiltrer dans les rêves se voit confier une mission inverse : implanter une idée dans l'esprit d'un héritier."],
            ['Interstellar', 'Science-Fiction', 169, '2014-11-05', 'Christopher Nolan', '8', "Alors que la Terre devient inhabitable, une équipe d'explorateurs franchit un trou de ver pour chercher un nouveau monde."],
            ['Dune', 'Science-Fiction', 155, '2021-09-15', 'Denis Villeneuve', '8', "L'héritier d'une grande maison est envoyé sur une planète désertique dont l'épice est la ressource la plus convoitée de l'univers."],
            ['Blade Runner 2049', 'Science-Fiction', 164, '2017-10-04', 'Denis Villeneuve', '8', "Trente ans après les événements du premier film, un nouveau blade runner met au jour un secret enfoui depuis longtemps."],
            ['Arrival', 'Science-Fiction', 116, '2016-12-07', 'Denis Villeneuve', '8', "Une linguiste est recrutée par l'armée pour communiquer avec des visiteurs venus d'ailleurs, dont les intentions restent indéchiffrables."],
            ['Le Fabuleux Destin d\'Amélie Poulain', 'Comédie', 122, '2001-04-25', 'Jean-Pierre Jeunet', '8', "Une jeune serveuse montmartroise décide de changer discrètement la vie de son entourage, sans jamais se dévoiler."],
            ['Intouchables', 'Comédie', 112, '2011-11-02', 'Olivier Nakache et Éric Toledano', '8', "Un aristocrate tétraplégique engage comme aide à domicile un jeune homme tout juste sorti de prison."],
            ['La La Land', 'Comédie', 128, '2017-01-25', 'Damien Chazelle', '8', "À Los Angeles, une actrice en devenir et un pianiste de jazz voient leur histoire se heurter à leurs ambitions."],
            ['Le Dîner de Cons', 'Comédie', 80, '1998-04-15', 'Francis Veber', '7', "Un éditeur organise chaque semaine un dîner où chacun doit amener l'invité le plus ridicule possible. Ce soir-là, tout dérape."],
            ['OSS 117 : Le Caire, nid d\'espions', 'Comédie', 99, '2006-04-19', 'Michel Hazanavicius', '7', "Un agent secret français aussi sûr de lui qu'incompétent est envoyé en Égypte pour élucider la disparition d'un collègue."],
            ['Parasite', 'Drame', 132, '2019-06-05', 'Bong Joon-ho', '9', "Une famille sans ressources s'introduit un à un dans le quotidien d'une riche famille de Séoul, jusqu'au basculement."],
            ['Les Affranchis', 'Drame', 145, '1990-09-19', 'Martin Scorsese', '9', "L'ascension puis la chute d'un jeune homme happé par la mafia new-yorkaise sur trois décennies."],
            ['Forrest Gump', 'Drame', 142, '1994-10-05', 'Robert Zemeckis', '8', "Un homme au destin hors du commun traverse quarante ans d'histoire américaine sans jamais cesser de courir."],
            ['La Liste de Schindler', 'Drame', 195, '1994-03-02', 'Steven Spielberg', '9', "Un industriel allemand emploie des centaines de Juifs dans son usine et finit par tout risquer pour les sauver."],
            ['Les Évadés', 'Drame', 142, '1995-03-01', 'Frank Darabont', '9', "Condamné à perpétuité pour un crime qu'il nie avoir commis, un banquier se lie d'amitié avec un détenu de longue date."],
            ['Joker', 'Drame', 122, '2019-10-09', 'Todd Phillips', '8', "Un comédien raté et méprisé bascule peu à peu dans la violence, et devient une figure de la révolte à Gotham."],
            ['Le Voyage de Chihiro', 'Animation', 125, '2002-04-10', 'Hayao Miyazaki', '9', "Une fillette de dix ans se retrouve prisonnière d'un monde peuplé d'esprits et doit travailler pour sauver ses parents."],
            ['Princesse Mononoké', 'Animation', 134, '2000-01-12', 'Hayao Miyazaki', '8', "Un jeune prince maudit cherche un remède au cœur d'une forêt où les dieux animaux affrontent les hommes."],
            ['Là-haut', 'Animation', 96, '2009-07-29', 'Pete Docter', '8', "Un veuf de 78 ans s'envole vers l'Amérique du Sud en accrochant des milliers de ballons à sa maison."],
            ['Spider-Man : New Generation', 'Animation', 117, '2018-12-12', 'Bob Persichetti', '8', "Un adolescent du Queens découvre qu'il existe d'autres Spider-Man, venus de dimensions parallèles."],
            ['Mad Max : Fury Road', 'Action', 120, '2015-05-14', 'George Miller', '8', "Dans un désert post-apocalyptique, une conductrice en fuite et un survivant solitaire sont poursuivis par un tyran et son armée."],
            ['John Wick', 'Action', 101, '2014-10-22', 'Chad Stahelski', '7', "Un tueur à gages retiré des affaires reprend du service après que des truands s'en sont pris à ce qui lui restait."],
            ['Gladiator', 'Action', 155, '2000-06-21', 'Ridley Scott', '8', "Trahi et réduit en esclavage, un général romain devient gladiateur pour se venger de l'empereur qui a détruit sa famille."],
            ['Seven', 'Thriller', 127, '1996-01-31', 'David Fincher', '9', "Deux inspecteurs traquent un tueur qui met en scène ses crimes autour des sept péchés capitaux."],
            ['Le Silence des agneaux', 'Thriller', 118, '1991-04-10', 'Jonathan Demme', '9', "Une jeune recrue du FBI consulte un psychiatre cannibale emprisonné pour remonter la piste d'un autre tueur en série."],
            ['Shutter Island', 'Thriller', 138, '2010-02-24', 'Martin Scorsese', '8', "Deux marshals enquêtent sur la disparition d'une patiente dans un hôpital psychiatrique isolé sur une île."],
        ];

        $langues = ['VF', 'VOST'];
        $prix = ['7.50', '9.20', '11.00', '13.50'];
        $heures = [11, 14, 16, 18, 20, 22];
        $minutes = [0, 15, 30, 45];

        foreach ($donneesFilms as $donnee) {
            [$titre, $genre, $duree, $dateSortie, $realisateur, $note, $synopsis] = $donnee;

            $film = new Film();
            $film->setTitre($titre);
            $film->setGenre($genre);
            $film->setDuree($duree);
            $film->setDateSortie(new \DateTime($dateSortie));
            $film->setRealisateur($realisateur);
            $film->setNote($note);
            $film->setSynopsis($synopsis);
            $film->setAffiche($this->genererAffiche($titre));

            $manager->persist($film);

            // entre 2 et 5 seances, reparties au hasard sur les 14 prochains jours
            $nombreSeances = rand(2, 5);
            $joursUtilises = [];

            for ($i = 0; $i < $nombreSeances; $i++) {
                // on evite deux seances le meme jour pour un meme film
                do {
                    $jour = rand(0, 13);
                } while (in_array($jour, $joursUtilises));

                $joursUtilises[] = $jour;

                $dateHeure = new \DateTime('today');
                $dateHeure->modify("+{$jour} days");
                $dateHeure->setTime($heures[array_rand($heures)], $minutes[array_rand($minutes)]);

                $seance = new Seance();
                $seance->setFilm($film);
                $seance->setSalle($salles[array_rand($salles)]);
                $seance->setDateHeure($dateHeure);
                $seance->setLangue($langues[array_rand($langues)]);
                $seance->setPrix($prix[array_rand($prix)]);
                $seance->setPlacesDisponibles(rand(0, 80));

                $manager->persist($seance);
            }
        }

        $manager->flush();
    }

    // genere une affiche de remplacement aux couleurs du site
    private function genererAffiche(string $titre): string
    {
        return 'https://placehold.co/300x450/14090b/c8102e?text=' . urlencode($titre);
    }
}
