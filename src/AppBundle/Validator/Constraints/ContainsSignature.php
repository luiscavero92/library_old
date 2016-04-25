<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsSignature extends Constraint
{
    public $message = 'The Signature obtained is invalid.';
}