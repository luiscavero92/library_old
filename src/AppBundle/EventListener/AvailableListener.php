<?php
namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;

class AvailableListener
{
	public function __construct($container){
		$this->container = $container;
	}

    public function postPersist(LifecycleEventArgs $args)
    {
        
    	$entity = $args->getEntity();
        if (get_class($entity) == "AppBundle\Entity\Loan") {

        	$copy = $entity->getCopy();
        	
        	if($entity->getReturnDate()){
	            $copy->setAvailable(true);
	        }else{
	            $copy->setAvailable(false);
	        }
	        $doctrine = $this->container->get('doctrine')->getManager();
        	$doctrine->flush();
        }
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
    	$entity = $args->getEntity();
        if (get_class($entity) == "AppBundle\Entity\Loan") {

        	$copy = $entity->getCopy();
        	
        	if($entity->getReturnDate()){
	            $copy->setAvailable(true);
	        }else{
	            $copy->setAvailable(false);
	        }
	        $doctrine = $this->container->get('doctrine')->getManager();
        	$doctrine->flush();
        }
    }
}
