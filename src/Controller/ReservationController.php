<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReservationType;

final class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(Request $request,
        ReservationType $reservationType,
    ): Response {
        $form = $this->createForm(ReservationType::class, null);
        $form->handleRequest($request);
    
    
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }
}
/*     public function reservationForm(
        Request $request,
        ReservationType $reservationType,
    ): Response {
        $form = $this->createForm(ReservationType::class, null);
        $form->handleRequest($request);
    }
}
 */