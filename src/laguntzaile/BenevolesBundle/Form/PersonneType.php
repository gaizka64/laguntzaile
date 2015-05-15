<?php

namespace laguntzaile\BenevolesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text',array(
                'label' => 'Nom'))
            
            ->add('prenom','text',array(
                'label' => 'Prénom'))
            
            ->add('dateNaissance','date',array(
                'format' => 'dd-MM-yyyy',
                'label' => 'Date de naissance',
                //'empty_value' => '',
                'widget' => 'text'))
            
            ->add('email','email',array(
                'required' => 'true',
                'label' => 'Adresse de courriel'))
            
            ->add('adresse','textarea',array(
                'label' => 'Adresse Postale',
                'attr' => array('cols' => '21', 'rows' => '2')))
            
            ->add('codePostal','text',array(
                'label' => 'Code postal',
                'attr' => array('size' => '5')))
            
            ->add('ville','text', array(
                'label' => 'Commune',
                'attr' => array('size' => '10')))
            
            ->add('portable','text',array(
                'label' => 'N° de portable'))
            
            ->add('domicile','text',array(
                'label' => 'N° du domicile'))
            
            ->add('profession','text')
            
            ->add('competences','text',array(
                'label' => 'Compétences'))
            
            ->add('langues','text',array(
                'label' => 'Langues parlées',
                 'attr' => array(
                    'placeholder' => 'ex : français,basque,...')))
                  
            ->add('commentaire','textarea',array(
                'label' => 'Commentaire',
                'attr' => array(
                        'placeholder' => 'Informations que vous souhaitez communiquer',
                        'rows' => '2',
                        'cols' => '19')))   
        
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'laguntzaile\BenevolesBundle\Entity\Personne'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'laguntzaile_benevolesbundle_personne';
    }
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'laguntzaile\BenevolesBundle\Entity\Personne',
        );
    }
}
