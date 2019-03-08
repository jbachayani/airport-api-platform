<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class FlightDate extends Constraint
{
    public $message = "La date d’arrivée ne peut pas être inférieur à la date de départ.";
}
