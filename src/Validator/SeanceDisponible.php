<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class SeanceDisponible extends Constraint
{
    public string $message = 'Seulement {{ places }} places disponibles pour cette séance';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}