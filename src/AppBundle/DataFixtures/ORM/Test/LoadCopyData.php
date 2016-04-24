<?php
namespace AppBundle\DataFixtures\ORM\Test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Copy;

class LoadCopyData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
		for($i = 0; $i<30; $i++){
        $articles = $manager->getRepository('AppBundle:Article')->findAll();
        $randArticle = $articles[array_rand($articles)];


        $copy = new Copy();
        $copy->setArticle($randArticle);
        $copy->setCopyNumber('COPYNUMBER'.$i);
        $copy->setAddedOn(date_create(date("Y-m-d")));

        $manager->persist($copy);
        }
        
        $manager->flush();

    }

    public function getOrder()
    {
       return 3; 
    }
}