<?php
namespace AppBundle\Types\ORMTypes;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use AppBundle\Types\ClassTypes\Signature;

/**
 * My custom datatype.
 */
class SignatureType extends Type
{
    const SIGNATURE = 'signature'; // modify to match your type name


    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'varchar(255)';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
    	$arrayValues = preg_split("/" . Signature::DELIMITER . "/", $value); 
        return new Signature($arrayValues[0], $arrayValues[1], $arrayValues[2]);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
    	if ($value instanceof Signature) {
            $value = $value->getSig1() . Signature::DELIMITER . $value->getSig2() . Signature::DELIMITER . $value->getSig3();
        }

        return $value;
    }

    public function canRequireSQLConversion()
    {
        return true;
    }

    public function getName()
    {
        return self::SIGNATURE;
    }
}