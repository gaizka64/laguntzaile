<?php

namespace laguntzaile\BenevolesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use laguntzaile\BenevolesBundle\Form\PersonneType ;

class DisponibiliteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
	       ->add('Affectation', 'collection', array('type' => new TagType()));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'laguntzaile\BenevolesBundle\Entity\Disponibilite'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'laguntzaile_benevolesbundle_disponibilite';
    }
}
