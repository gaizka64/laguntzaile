<?php

namespace laguntzaile\BenevolesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use laguntzaile\BenevolesBundle\Entity\Personne	;
use laguntzaile\BenevolesBundle\Entity\Affectation	;
use laguntzaile\BenevolesBundle\Entity\AffectationRepository;
use laguntzaile\BenevolesBundle\Entity\Disponibilite ;
use laguntzaile\BenevolesBundle\Form\PersonneType ;
use laguntzaile\BenevolesBundle\Form\DisponibiliteType ;
use laguntzaile\BenevolesBundle\Form\Evenement ;
use laguntzaile\BenevolesBundle\Form\AffectationType ;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Forms;



class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('laguntzaileBenevolesBundle:Default:index.html.twig', array('name' => $name));
    }





    public function candidatureAction($idEvenement,$idPersonne,$selIdEvenement,$selIdPersonne,Request $requeteUtilisateur)
    {
        $enregistrementEffectue = FALSE; // Au départ, l'enregistrement en BD n'est pas fait

        // On vérifie si l'id Evenement en question existe dans la base de données
        $gestionnaireEntite = $this->getDoctrine()->getManager();
        $repositoryEvenement = $gestionnaireEntite->getRepository('laguntzaileBenevolesBundle:Evenement');

        $evenement = $repositoryEvenement->find($idEvenement);

        if($evenement == NULL)
        {
            return $this->render('laguntzaileBenevolesBundle:Default:erreur.html.twig');
        }

        $disponibilite = new Disponibilite();

        if ($idPersonne != 0)
        {
            $repositoryPersonne = $gestionnaireEntite->getRepository('laguntzaileBenevolesBundle:Personne');
            $personne = $repositoryPersonne->find($idPersonne);
            if ($personne != null)   
                $disponibilite->setIdPersonne($personne);
        }

        // Création du formulaire
        /*$formulaireInscription = $this->createForm(new DisponibiliteType(), $disponibilite);*/

        $formulaireInscription = $this->createFormBuilder($disponibilite)
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
                    'cols' => '22')))

            ->getForm();


        $formulaireInscription->handleRequest($requeteUtilisateur);



        if ($formulaireInscription->isValid() and $disponibilite->getIdPersonne()->getEmail() != null and $disponibilite->getIdPersonne()->getPortable() != null and $disponibilite->getIdPersonne()->getDomicile != null)
        {
            $gestionnaireEntite = $this->getDoctrine()->getManager();
            $disponibilite->setIdEvenement($evenement);

            //$disponibilite->setDateInscription(new \DateTime("now"));
            $disponibilite->setDateInscription(new \DateTime(date('Y-m-d G:i:s')));

            $gestionnaireEntite->persist($disponibilite);
            $gestionnaireEntite->flush();
            $enregistrementEffectue = TRUE;

            return $this->render('laguntzaileBenevolesBundle:Default:candidatureEffectuee.html.twig', array('enregistrementEffectue'=> $enregistrementEffectue, 'evenement' => $evenement)); 
        }



        return $this->render('laguntzaileBenevolesBundle:Default:candidature.html.twig', array('formulaireInscription'=> $formulaireInscription->createView(),'enregistrementEffectue'=> $enregistrementEffectue, 'evenement' => $evenement));
    }






    public function erreurAction()
    {
        return $this->render('laguntzaileBenevolesBundle:Default:erreur.html.twig');
    }











    public function affectationAction($idDisponibilite,$clePublique, Request $requeteUtilisateur)
    {
        // Vérification des paramètres
        $clePrive = "cec1E2T1s31S0l1d3";
        $moulinage = crypt($idDisponibilite,$clePrive);

        if ($clePublique != $moulinage)
        {
            throw $this->createNotFoundException('404 non trouvé');
        }
        
        else
        {
            // On vérifie si l'id affectation passée en paramètre existe
            $gestionnaireEntite = $this->getDoctrine()->getManager();
            $repositoryAffectation = $gestionnaireEntite->getRepository('laguntzaileBenevolesBundle:Affectation');
            $repositoryDisponibilite = $gestionnaireEntite->getRepository('laguntzaileBenevolesBundle:Disponibilite');

            $tabAffectations=$repositoryAffectation->getTabAffectations($idDisponibilite);

            if ($tabAffectations == NULL)
            {
                return $this->render('laguntzaileBenevolesBundle:Default:erreur.html.twig');
            }

            // On récupère les Affectations liées à cette disponibilité

            $personneEtEvenement = $repositoryDisponibilite->getEvenementPersonne($idDisponibilite);

            // On va créer le formulaire
            $tabDonneesDuFormulaire = array();

            // Création du formulaire
            $formulaire = $this->createFormBuilder($tabDonneesDuFormulaire);
            $nombreDAffectations = count($tabAffectations);

            foreach ($tabAffectations as $affectationCourante)
            {
                $formulaire->add('radio' . $affectationCourante->getId(),'choice', array(
                    'choices' => array('Acceptee' => ' Accepter', 'Refusee' => ' Refuser '),
                    'expanded' => true,
                    'multiple' => false));
            }

            $formulaireAffectation = $formulaire->getForm();
            $formulaireAffectation->handleRequest($requeteUtilisateur); // Permet de prendre en compte la soumission


            if ($formulaireAffectation->isSubmitted())
            {   
                $gestionnaireEntite = $this->getDoctrine()->getManager();

                foreach ($tabAffectations as $affectationCourante)
                {
                    if ($formulaireAffectation->getData()["radio" . $affectationCourante->getId()] == "Acceptee")
                    {

                        $affectationCourante->setStatut("acceptee");

                        $gestionnaireEntite->persist($affectationCourante);
                        $gestionnaireEntite->flush();

                    }
                    else if ($formulaireAffectation->getData()["radio" . $affectationCourante->getId()] == "Refusee")
                    {
                        $affectationCourante->setStatut("rejetee");

                        $gestionnaireEntite->persist($affectationCourante);
                        $gestionnaireEntite->flush();   
                    }
                }

                return $this->affectationAction($idDisponibilite, new Request());

            }
            else
            {

                return $this->render('laguntzaileBenevolesBundle:Default:affectation.html.twig',array(
                    'tabAffectations'=> $tabAffectations,
                    'personneEtEvenement'=> $personneEtEvenement,
                    'formulaireAffectation'=> $formulaireAffectation->createView(),
                    'tabAffectations'=>$tabAffectations
                ));
            }
        }
        }
    }