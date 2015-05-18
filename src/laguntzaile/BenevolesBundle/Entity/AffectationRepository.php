<?php

namespace laguntzaile\BenevolesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AffectationRepository extends EntityRepository
{
    public function getTabAffectationsProposees($idDisponibilite)
    {
        $gestionnaireEntite = $this->_em;
        
        $requete = $gestionnaireEntite->createQuery('   SELECT a, t, p
                                                        FROM laguntzaileBenevolesBundle:Affectation a
                                                        JOIN a.idTour t
                                                        JOIN t.idPoste p
                                                        WHERE a.idDisponibilite = :idDisponibilite AND a.statut = \'proposee\'
                                                        ORDER BY t.debut
                                                        
                                                    ');
        $requete->setParameter('idDisponibilite', $idDisponibilite);
        
        return $requete->getResult();   
    }
    
    public function getTabAffectationsDejaTraitees($idDisponibilite)
    {
        $gestionnaireEntite = $this->_em;
        
        $requete = $gestionnaireEntite->createQuery('   SELECT a, t, p
                                                        FROM laguntzaileBenevolesBundle:Affectation a
                                                        JOIN a.idTour t
                                                        JOIN t.idPoste p
                                                        WHERE a.idDisponibilite = :idDisponibilite AND a.statut = \'acceptee\' OR a.statut = \'rejetee\'
                                                        ORDER BY t.debut
                                                        
                                                    ');
        $requete->setParameter('idDisponibilite', $idDisponibilite);
        
        return $requete->getResult();   
    }
}