<?php

namespace AppBundle\Form;

class FormStrongValidator
{
    private $form;

    public function __construct($form)
    {
        $this->form = $form;
    }
    public function getHiddenErrors()
    {
        $submitted = $this->form->isSubmitted() ? 'YES' : 'NO';
        $empty     = $this->form->isEmpty() ? 'YES' : 'NO';
        $valid     = $this->form->isValid() ? 'YES' : 'NO';
        $errors    = $this->form->getErrors()->count() ? $this->form->getErrors() : 'NONE';

        $chain  = "[ You have Hidden Errors, check about the next options: ";
        $chain .= "(1) Check de form name that you put in the request, the name should be: ". $this->form->getName() . " ";
        $chain .= "(2) If is a PATCH request, check if array('method' => 'PATCH') is added in the form builder ";
        $chain .= "(3) Check if the passed id as attributes of the entity exist ";
        $chain .= "(4) Check if a required field is missing ";
        $chain .= "(5) Also you can see form received data -> ". json_encode($this->form->getNormData()) . " ";
        $chain .= "(6) Check if the form is submitted, actually: " . $submitted . " ";
        $chain .= "(7) Check if the form is empty, actually: " . $empty . " ";
        $chain .= "(8) Check if the form is valid, actually: " . $valid . " ";
        $chain .= "(9) Also may you have this normal errors: ".  $errors . " ";
        $chain .= "(10) If you can't found the problem, you can check more with getConfig() method ";
        $chain .= " ]";
        return $chain;
    }
}
