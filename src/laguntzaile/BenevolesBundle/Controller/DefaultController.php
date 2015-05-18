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

    public function candidatureAction($idEvenement,$idPersonne,$moulinageRecu,Request $requeteUtilisateur)
    {
        
        $moulinageRecuCorrect = false; //On part du principe que ce qui est reçu n'est pas correct
        
        if ($idPersonne != 0)
        {
            // Vérification des paramètres
            $clePrive = "cec1E2T1s31S0l1d3Ma12D1fF3R3n72L0Tr3";
            $moulinageReel = crypt($idPersonne,$clePrive);

            if ($moulinageReel == $moulinageRecu) // On teste si ce qu'on a reçu correspond à ce qu'on devrait recevoir
            {
                $moulinageRecuCorrect = true;
            }
            
            else // Sinon on redirige vers la même page mais sans les parametres
            {
               return $this->redirect($this->generateUrl('laguntzaile_benevoles_candidature', array('idEvenement' => $idEvenement))); 
            }
        }

            // On vérifie si l'id Evenement en question existe dans la base de données
            $gestionnaireEntite = $this->getDoctrine()->getManager();
            $repositoryEvenement = $gestionnaireEntite->getRepository('laguntzaileBenevolesBundle:Evenement');

            $evenement = $repositoryEvenement->find($idEvenement);

            if($evenement == NULL)
            {
                throw $this->createNotFoundException('Erreur 404 : Evenement non trouvé.');
            }

            $disponibilite = new Disponibilite();

            if ($moulinageRecuCorrect == true) // Si l'idPersonne reçu et le moulinage (sel) correspondent alors on récup les infos en BD
            {
                $repositoryPersonne = $gestionnaireEntite->getRepository('laguntzaileBenevolesBundle:Personne');
                $personne = $repositoryPersonne->find($idPersonne);
                if ($personne != null)   
                    $disponibilite->setIdPersonne($personne);
            }

            // Création du formulaire
            $formulaireInscription = $this->createForm(new DisponibiliteType(), $disponibilite);

            $formulaireInscription->handleRequest($requeteUtilisateur);



            if ($formulaireInscription->isValid() and 
                ($disponibilite->getIdPersonne()->getEmail() != null or 
                $disponibilite->getIdPersonne()->getPortable() != null or
                $disponibilite->getIdPersonne()->getDomicile() != null))
            {
                $gestionnaireEntite = $this->getDoctrine()->getManager();
                    
                    // On initialise les valeurs à '' si c'est null
                        // PERSONNE
                    if (!(null !== ($disponibilite->getIdPersonne()->getPrenom())))
                        $disponibilite->getIdPersonne()->setPrenom('');
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getAdresse())))
                        $disponibilite->getIdPersonne()->setAdresse('');
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getCodePostal())))
                        $disponibilite->getIdPersonne()->setCodePostal('');
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getVille())))
                        $disponibilite->getIdPersonne()->setVille('');
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getPortable())))
                        $disponibilite->getIdPersonne()->setPortable('');
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getDomicile())))
                        $disponibilite->getIdPersonne()->setDomicile('');
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getEmail())))
                        $disponibilite->getIdPersonne()->setEmail('');
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getDateNaissance())))
                        $disponibilite->getIdPersonne()->setDateNaissance(new \DateTime(date('Y-m-d G:i:s')));
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getProfession())))
                        $disponibilite->getIdPersonne()->setProfession('');
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getCompetences())))
                        $disponibilite->getIdPersonne()->setCompetences('');
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getAvatar())))
                        $disponibilite->getIdPersonne()->setAvatar('');
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getLangues())))
                        $disponibilite->getIdPersonne()->setLangues('');
                    
                    if (!(null !== ($disponibilite->getIdPersonne()->getCommentaire())))
                        $disponibilite->getIdPersonne()->setCommentaire('');
                    
                        // DISPONIBILITE
                    
                    if (!(null !== ($disponibilite->getJoursEtHeuresDispo())))
                        $disponibilite->setJoursEtHeuresDispo('');
                    
                    if (!(null !== ($disponibilite->getListeAmis())))
                        $disponibilite->setListeAmis('');
                    
                    if (!(null !== ($disponibilite->getTypePoste())))
                        $disponibilite->setTypePoste('');
                    
                    if (!(null !== ($disponibilite->getCommentaire())))
                        $disponibilite->setCommentaire('');
                    
                    
                    $disponibilite->setIdEvenement($evenement);
                    $disponibilite->setDateInscription(new \DateTime(date('Y-m-d G:i:s')));

                    $gestionnaireEntite->persist($disponibilite->getIdPersonne());
                    $gestionnaireEntite->persist($disponibilite);
                    $gestionnaireEntite->flush();

                return $this->render('laguntzaileBenevolesBundle:Default:candidatureEffectuee.html.twig', array('evenement' => $evenement)); 
            }

            return $this->render('laguntzaileBenevolesBundle:Default:candidature.html.twig', array('formulaireInscription'=> $formulaireInscription->createView(), 'evenement' => $evenement));

        }





    
    public function erreurAction()
    {
        return $this->render('laguntzaileBenevolesBundle:Default:erreur.html.twig');
    }

    public function cryptageMaison($chaineACrypter,$clePrivee)
    {
        
            $chaineCryptee = crypt($chaineACrypter,$clePrivee);
            $termine = false;
        
        while($termine == false)
        {
            if (strpos($chaineCryptee,'/') !== false)
            {
               $chaineCryptee = crypt($chaineCryptee,$clePrivee); 
            }
            else
            {
             $termine = true;  
            }
        }
        
        return $chaineCryptee;
            
    }
    public function affectationAction($idDisponibilite,$moulinageRecu, Request $requeteUtilisateur)
    {
        // Vérification des paramètres
        $clePrive = "cec1E2T1s31S0l1d3";
        /*$moulinageReel = crypt($idDisponibilite,$clePrive);
        */
        
        $moulinageReel = $this->cryptageMaison($idDisponibilite,$clePrive);
        
        if ($moulinageRecu != $moulinageReel)
        {

            throw $this->createNotFoundException('Erreur 404.');
        }

        else
        {
            // On vérifie si l'id affectation passée en paramètre existe
            $gestionnaireEntite = $this->getDoctrine()->getManager();
            $repositoryAffectation = $gestionnaireEntite->getRepository('laguntzaileBenevolesBundle:Affectation');
            $repositoryDisponibilite = $gestionnaireEntite->getRepository('laguntzaileBenevolesBundle:Disponibilite');

            $tabAffectations=$repositoryAffectation->getTabAffectationsProposees($idDisponibilite);
            $tabAffectationsDejaTraitees = $repositoryAffectation->getTabAffectationsDejaTraitees($idDisponibilite);
            
            /*if ($tabAffectations == NULL)
            {
                return $this->render('laguntzaileBenevolesBundle:Default:erreur.html.twig');
            }*/

            // On récupère les Affectations liées à cette disponibilité
            $personneEtEvenement = $repositoryDisponibilite->getEvenementPersonne($idDisponibilite);

            // On crée un tableau vide qu'alimentera le formulaire
            $tabDonneesDuFormulaire = array();

            // Création du formulaire
            $formulaire = $this->createFormBuilder($tabDonneesDuFormulaire);
            $nombreDAffectations = count($tabAffectations);

            foreach ($tabAffectations as $affectationCourante)
            {
                $formulaire
                    ->add('radio' . $affectationCourante->getId(),'choice', array(
                    'choices' => array('Acceptee' => ' Accepter', 'Refusee' => ' Refuser '),
                    'expanded' => true,
                    'multiple' => false,
                    'attr' => array('onClick' => 'test(this)')))
                
                    ->add('commentaire' . $affectationCourante->getId(),'textarea',array(
                        'attr' => array(
                            'placeholder' => 'Veuillez nous préciser pouquoi vous refusez cette affectation afin que nous vous fassions des propositions plus adaptées.',
                            'rows' => '5',
                            'cols' => '19')));
            }

            $formulaireAffectation = $formulaire->getForm();
            $formulaireAffectation->handleRequest($requeteUtilisateur); // Permet de prendre en compte la soumission
            $formulaireNonViewe = $formulaireAffectation;

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
                        if ($commentaire = $formulaireAffectation->getData()["commentaire" . $affectationCourante->getId()] == null)
                        {
                            $commentaire = "";
                        }
                        
                        $affectationCourante->setCommentaire($commentaire);
                        $gestionnaireEntite->persist($affectationCourante);
                        $gestionnaireEntite->flush();   
                    }
                }

                return $this->affectationAction($idDisponibilite,$moulinageRecu,new Request());

            }
            
            else
            {
                return $this->render('laguntzaileBenevolesBundle:Default:affectation.html.twig',array(
                    'tabAffectations'=> $tabAffectations,
                    'personneEtEvenement'=> $personneEtEvenement,
                    'formulaireAffectation'=> $formulaireAffectation->createView(),
                    'tabAffectations'=>$tabAffectations,
                    'tabAffectationsDejaTraitees'=>$tabAffectationsDejaTraitees,
                ));
            }
        }
    }
    
    public function cryptageAction($trucACrypter,$clePrivee)
    {
     $valeurCryptee = $this->cryptageMaison($trucACrypter,$clePrivee);
    return $this->render('laguntzaileBenevolesBundle:Default:cryptage.html.twig',array(
                    'valeurCryptee'=> $valeurCryptee,
                    'trucACrypter'=> $trucACrypter));
        
    }
}