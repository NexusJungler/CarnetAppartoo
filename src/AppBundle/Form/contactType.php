<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class contactType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text')
            ->add('prenom', 'text')
            ->add('adresse', 'text')
            ->add('telephone', 'text')
            ->add('web', 'text', ['required' => false])
            ->add('Enregistrer', 'submit');
    }

}