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
	       ->add('idPersonne', new PersonneType(), array(
                    'label' => ''))

                ->add('joursEtHeuresDispo','textarea',array(
                    'label' => 'Disponibilités',
                    'attr' => array(
                        'placeholder' => 'Jours et heures de vos disponibilités et indisponibilités',
                        'rows' => '2',
                        'cols' => '22')))

                ->add('listeAmis','textarea',array(
                    'required' => 'false',
                    'label' => 'Affinités',
                    'attr' => array(
                        'placeholder' => 'Personnes avec qui vous souhaitez être ou ne pas être',
                        'rows' => '2',
                        'cols' => '22'
                    )))

                ->add('typePoste', 'textarea', array(
                    'label' => 'Type de poste',
                    'required' => 'false',
                    'attr' => array(
                        'placeholder' => 'Postes spécifiques auxquels vous aimeriez être affecté',
                        'rows' => '2',
                        'cols' => '22')))

                ->add('commentaire', 'textarea',array(
                    'required' => false,
                    'label' => 'Remarques et commentaires',
                    'attr' => array(
                        'placeholder' => 'Pour nous aider à vous trouver un poste',
                        'rows' => '2',
                        'cols' => '22')));

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
