<?php
namespace AppBundle\DataFixtures\ORM\Test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Loan;

class LoadLoanData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for($i=0; $i<20;$i++){
            $articles = $manager->getRepository('AppBundle:Article')->findAll();
            $randArticle = $articles[array_rand($articles)];

            $copys = $manager
            ->getRepository('AppBundle:Copy')
            ->findBy(array('article' => $randArticle, 'available' => true));
        if($copys){
            $copy = $copys[0];
        }else{
            continue;
        }

        $readers = $manager->getRepository('AppBundle:Reader')->findAll();
        $randReader = $readers[array_rand($readers)];

        $loan = new Loan();
        $loan->setCopy($copy);
        $loan->setReader($randReader);
        $loan->setLoanDate(date_create(date("Y-m-d")));

        $manager->persist($loan);
        $manager->flush();

        }       
        
        
     
    }

    public function getOrder()
    {
       return 5; 
    }
}