<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Loan;
use AppBundle\Types\ClassTypes\Signature;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
$serializer = $this->get('jms_serializer');

        $articulo = '{"sig1":"misig","sig2":"mio","sig3":"jaja"}';

        $data = $serializer->deserialize($articulo, 'AppBundle\Types\ClassTypes\Signature', 'json');

        $mejor = $data instanceof Signature;         

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'mejor' => $mejor,
            'articulo' => $articulo
        ]);
    }
}
