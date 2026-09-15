<?php

namespace App\Validator;

use App\Entity\Reservation;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SeanceDisponibleValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$value instanceof Reservation) {
            return;
        }

        $placesRestantes = $value->getSeance()->getPlacesDisponibles();

        if ($value->getNbPlaces() > $placesRestantes) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ places }}', $placesRestantes)
                ->addViolation();
        }
    }
}