<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Loan;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need

        $doctrine = $this->getDoctrine();
        $manager = $doctrine->getManager();
        
        $article = $doctrine->getRepository('AppBundle:Article')->findByIsbn('An Isbn');
        $copys = $doctrine
            ->getRepository('AppBundle:Copy')
            ->findBy(array('article' => $article, 'available' => true));

        if($copys){
            $copy = $copys[0];
        }else{
            throw new \Exception("There aren't available copys of this article");
        }

        $reader = $doctrine
            ->getRepository('AppBundle:Reader')
            ->findOneByRecordNumber('11111111');

        $loan = new Loan();
        $loan->setCopy($copy);
        $loan->setReader($reader);
        $loan->setLoanDate(date_create(date("Y-m-d")));

        $manager->persist($loan);
        $manager->flush();

        $repository = $doctrine->getRepository('AppBundle:Loan');
        $articulo = $repository->findAll()[0];
        $mejor = $articulo;
        $serializer = $this->get('serializer');
        $articulo = $serializer->serialize($articulo, 'json');

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'articulo' => $articulo,
            'mejor' => $mejor,
        ]);
    }
}
