<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('authors')
            ->add('refNumber')
            ->add('editionYear')
            ->add('isbn')
            ->add('publisher')
            ->add('legalDeposit')
            ->add('cdu', EntityType::class, array('class' => 'AppBundle\Entity\CDU', 'invalid_message' => 'CDU ID is not valid'))
            ->add('signature')
            ->add('location')
            ->add('category')
            ->add('note')
            ->add('loanable')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }

    public function getName()
    {
        return('article');
    }
}
