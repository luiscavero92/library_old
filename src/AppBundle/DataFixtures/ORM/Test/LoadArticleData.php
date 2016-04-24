<?php
namespace AppBundle\DataFixtures\ORM\Test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Article;
use AppBundle\Types\ClassTypes\Signature;

class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 10; $i++){
            $cdus = $manager->getRepository('AppBundle:CDU')->findAll();
            $randCdu = $cdus[array_rand($cdus)];

            $signature = new Signature('TBEO', 'NAR', 'MAN');

            $article = new Article();

            $article->setRefNumber('34343434'.$i);
            $article->setIsbn('65656565656-'.$i);
            $article->setTitle('Alfagann es Flanagan');
            $article->setSubtitle('Es así');
            $article->setAuthors(['Miguel de Cervantes', 'Galileo Galilei', 'Luilli']);
            $article->setEditionYear('1990');
            $article->setLegalDeposit('Depósito legal: '.$i);
            $article->setPublisher('Circulo de lectores');
            $article->setLocation('Estanteria juvenil');
            $article->setCdu($randCdu);
            $article->setSignature($signature);
            $article->setCategory('BOOK');
            $article->setNote('The best note');

            $manager->persist($article);
        }
		
        $manager->flush();
     
    }

    public function getOrder()
    {
       return 2; 
    }
}