<?php

namespace laguntzaile\BenevolesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use laguntzaile\BenevolesBundle\Form\PersonneType ;

class AffectationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
	    ->add('statut','choice', array(
					'choices' => array('Acceptee' => ' Accepter', 'Refusee' => ' Refuser '),
                    'expanded' => true,
                    'multiple' => false))
            
        ->add('commentaire','hidden');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'laguntzaile\BenevolesBundle\Entity\Affectation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'laguntzaile_benevolesbundle_affectation';
    }
    
    
}
