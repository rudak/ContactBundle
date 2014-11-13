<?php

namespace Rudak\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('phone', 'text', array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('email', 'text', array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('message', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rudak\ContactBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rudak_contactbundle_contact';
    }
}
