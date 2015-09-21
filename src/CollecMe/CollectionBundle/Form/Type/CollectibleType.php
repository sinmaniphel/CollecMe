<?php

namespace CollecMe\CollectionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CollectibleType extends AbstractType {


    public function buildForm(
        FormBuilderInterface $builder,
        array $options)
    {
        $builder
            ->add('colIsCirca')
            ->add('colDate')
            ->add('colName', 'text')
            ->add('colDescription', 'text')
            ->add('save','submit')
            
            ;
    }

    public function getName()
    {
        return 'colme_form_type_collectible';
    }
    
    
}