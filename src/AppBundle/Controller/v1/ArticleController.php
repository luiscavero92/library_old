<?php
namespace AppBundle\Controller\v1;

use AppBundle\Entity\Article;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends APIController
{

    public function __construct()
    {
        parent::__construct('ArticleController', 'AppBundle\Entity\Article', 'AppBundle\Form\ArticleType');
    }

	public function getArticlesAction()
	{
		return parent::getAll();
	}

	public function getArticleAction(Article $article)
	{
		return parent::getOne($article);
	}


	public function postArticlesAction(Request $request)
	{
        return parent::post($request);
        
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