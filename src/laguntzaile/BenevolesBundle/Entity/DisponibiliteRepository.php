<?php

namespace laguntzaile\BenevolesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DisponibiliteRepository extends EntityRepository
{
    public function getEvenementPersonne($idDisponibilite)
    {
        $gestionnaireEntite = $this->_em;
        
        $requete = $gestionnaireEntite->createQuery('SELECT d, p, e
        FROM laguntzaileBenevolesBundle:Disponibilite d
        JOIN d.idPersonne p
        JOIN d.idEvenement e
        WHERE d.id = :idDisponibilite');
        $requete->setParameter('idDisponibilite', $idDisponibilite);
        return  $requete->getResult();
    }
}