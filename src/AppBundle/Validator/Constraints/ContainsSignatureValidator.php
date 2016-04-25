<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use AppBundle\Types\ClassTypes\Signature;
use JMS\Serializer\SerializerBuilder;

class ContainsSignatureValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {

    	$serializer = SerializerBuilder::create()->build();

    	$newvalue = json_encode($value);

        $object = $serializer->deserialize($newvalue, 'AppBundle\Types\ClassTypes\Signature', 'json');

        if (!$object instanceof Signature) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', implode($value))
                ->addViolation();
        }
    }
}