<?php
namespace AppBundle\Types\ClassTypes;

use JMS\Serializer\Annotation\Type;

class Signature
{

	const DELIMITER = '¨';

    /**
     * @Type("string")
     */
    private $sig1;

    /**
     * @Type("string")
     */
    private $sig2;

    /**
     * @Type("string")
     */
    private $sig3;
    
    /**
     * @param string $sig1
     * @param string $sig2
     * @param string $sig3
     */
    public function __construct($sig1, $sig2, $sig3)
    {
        $this->sig1 = $sig1;
        $this->sig2 = $sig2;
        $this->sig3 = $sig3;
    }

    /**
     * @return string
     */
    public function getSig1()
    {
        return $this->sig1;
    }

    /**
     * @return string
     */
    public function getSig2()
    {
        return $this->sig2;
    }

    /**
     * @return string
     */
    public function getSig3()
    {
        return $this->sig3;
    }
}