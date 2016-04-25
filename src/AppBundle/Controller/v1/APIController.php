<?php
namespace AppBundle\Controller\v1;

use FOS\RestBundle\Controller\FOSRestController;

use Symfony\Component\HttpKernel\Exception\HttpException;

use Symfony\Component\HttpFoundation\Request;

class APIController extends FOSRestController
{
    //Error messages
	protected $deleteErrorMsg = "Data base delete error.";
    protected $updateErrorMsg = "Data base update error.";
    protected $insertErrorMsg = "Data base insert error.";
    protected $accessErrorMsg = "Data base access error. Check database config and if the entity recieved exists";
    protected $unauthorizedAccessMsg = "Unauthorized access!";
    protected $formError = "Check the name of the form is correct, or if the passed id as attributes of the entity exist or if a required field is missing.";
    protected $badRequestMsg = "The request could not be understood by the server due to malformed syntax. The client SHOULD NOT repeat the request without modifications.";
    protected $urlUserService = "/api/user/v1/users";
    protected $urlUserPassService = "http://user.com/api/user/v1/user/password";
    protected $urlChecklistService = "/api/checkr/v%s/checklists";
    protected $urlReportService = "/api/checkr/v%s/checklistreports";
    const CHECKLISTS_403 = "You have not permissions to read the checklists";
    const ROLES_403 = "You have not permissions to assign this rol: ";

    //Children class attributes
    protected $className;
    protected $entityName;
    protected $formName;

    public function __construct($className, $entityName, $formName)
    {
        $this->className = $className;
        $this->entityName = $entityName;
        $this->formName = $formName;
    }

	public function getAll()
	{
		try{
            $repository = $this->getDoctrine()->getRepository($this->entityName);
			$items = $repository->findAll();
		} catch (\Exception $e) {
			$this->get('logger')->error($e->getMessage(), array("TRACE ERROR: ".__METHOD__));
			throw new HttpException(500, $this->accessErrorMsg);
		}
		if(!$items){
        	throw new HttpException(404, "No list found");
        }

		$serializer = $this->container->get('serializer');

		$view = $this->view($items, 200);
		return $this->handleView($view);
	}

	public function getOne($item)
	{
		$view = $this->view($item, 200);
		return $this->handleView($view);
	}

	public function post(Request $request)
	{
		$item = new $this->entityName();

    	$form = $this->createForm($this->formName, $item);

    	$form->handleRequest($request);

    	if(!$form->isValid()){
    		$msg = ($form->getErrors(true)->count()==0) ?  $this->formError : $form->getErrors(true);
            throw new HttpException(400, "formErrors: ".$msg);	
    	}
    	try{
            $em = $this->getDoctrine()->getManager();
		    $em->persist($item);
		    $em->flush();
        } catch (HttpException $e) {
            $this->get('logger')->error($e->getMessage(), array("TRACE ERROR: ".__METHOD__));
            throw $e;
        } catch (\Exception $e) {
            $this->get('logger')->error($e->getMessage(), array("TRACE ERROR: ".__METHOD__));
            throw new HttpException(500, $this->insertErrorMsg);
        } 

		$view = $this->view($item,201);
    	return $this->handleView($view);
        
	}
/*
	public function patchAlertAction(Request $request, Alert $alert)
	{	

    	$form = $this->createForm("AppBundle\Form\AlertType", $alert, array('method' => 'PATCH'));
    	
    	$form->handleRequest($request);

    	if(!$form->isValid()){
    		$msg = ($form->getErrors(true)->count()==0) ?  $this->formError : $form->getErrors(true);
            throw new HttpException(400, "formErrors: ".$msg);	
    	}

    	try{
            $em = $this->getDoctrine()->getManager();
		    $em->persist($alert);
		    $em->flush();
        } catch (HttpException $e) {
            $this->get('logger')->error($e->getMessage(), array("TRACE ERROR: ".__METHOD__));
            throw $e;
        } catch (\Exception $e) {
            $this->get('logger')->error($e->getMessage(), array("TRACE ERROR: ".__METHOD__));
            throw new HttpException(500, $this->insertErrorMsg);
        } 

		$view = $this->view($alert,200);
    	return $this->handleView($view);

	}

	public function deleteAlertAction(Alert $alert)
	{

        try{
            $em = $this->get('doctrine')->getManager();
            $em->remove($alert);
            $em->flush();
        } catch (HttpException $e) {
            $this->get('logger')->error($e->getMessage(), array("TRACE ERROR: ".__METHOD__));
            throw $e;
        } catch (\Exception $e) {
            $this->get('logger')->error($e->getMessage(), array("TRACE ERROR: ".__METHOD__));
            throw new HttpException(500, $this->deleteErrorMsg);
        }

        $view = $this->view("", 204);
        return $this->handleView($view);
	}*/


}