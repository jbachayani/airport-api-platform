<?php

namespace App\Validator\Constraints;

use Symfony\Component\HttpFoundation\File\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class FlightDateValidator extends ConstraintValidator
{

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param \Symfony\Component\Validator\Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof FlightDate) {
            throw new UnexpectedTypeException($constraint, FlightDate::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $flight = $this->context->getObject();
        $depertureDate = $flight->getDepertureDate();
        $arrivalDate = $flight->getArrivalDate();

        if($depertureDate > $arrivalDate)
        {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
