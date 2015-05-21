<?php

namespace laguntzaile\BenevolesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Disponibilite
 *
 * @ORM\Table(name="disponibilite", indexes={@ORM\Index(name="disponibilite_date_inscription_idx", columns={"date_inscription"}), @ORM\Index(name="disponibilite_statut_idx", columns={"statut"}), @ORM\Index(name="IDX_2CBACE2F8B13D439", columns={"id_evenement"}), @ORM\Index(name="IDX_2CBACE2F5F15257A", columns={"id_personne"})})
 * @ORM\Entity(repositoryClass="DisponibiliteRepository")
 */
class Disponibilite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="disponibilite_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscription", type="datetime", nullable=true)
     */
    private $dateInscription;

    /**
     * @var string
     *
     * @ORM\Column(name="jours_et_heures_dispo", type="text", nullable=false)
     * @Assert\NotBlank(message="Les disponibilités doivent être spécifiées.")
     */
    private $joursEtHeuresDispo;

    /**
     * @var string
     *
     * @ORM\Column(name="liste_amis", type="text", nullable=false)
     */
    private $listeAmis;

    /**
     * @var string
     *
     * @ORM\Column(name="type_poste", type="text", nullable=false)
     */
    private $typePoste;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=false)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", nullable=false)
     */
    private $statut = 'proposee';

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evenement", referencedColumnName="id")
     * })
     * @Assert\Valid
     */
    private $idEvenement;

    /**
     * @var \Personne
     *
     * @ORM\ManyToOne(targetEntity="Personne", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_personne", referencedColumnName="id")
     * })
     * @Assert\Valid
     */
    private $idPersonne;



    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     * @return Disponibilite
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime 
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set joursEtHeuresDispo
     *
     * @param string $joursEtHeuresDispo
     * @return Disponibilite
     */
    public function setJoursEtHeuresDispo($joursEtHeuresDispo)
    {
        $this->joursEtHeuresDispo = $joursEtHeuresDispo;

        return $this;
    }

    /**
     * Get joursEtHeuresDispo
     *
     * @return string 
     */
    public function getJoursEtHeuresDispo()
    {
        return $this->joursEtHeuresDispo;
    }

    /**
     * Set listeAmis
     *
     * @param string $listeAmis
     * @return Disponibilite
     */
    public function setListeAmis($listeAmis)
    {
        $this->listeAmis = $listeAmis;

        return $this;
    }

    /**
     * Get listeAmis
     *
     * @return string 
     */
    public function getListeAmis()
    {
        return $this->listeAmis;
    }

    /**
     * Set typePoste
     *
     * @param string $typePoste
     * @return Disponibilite
     */
    public function setTypePoste($typePoste)
    {
        $this->typePoste = $typePoste;

        return $this;
    }

    /**
     * Get typePoste
     *
     * @return string 
     */
    public function getTypePoste()
    {
        return $this->typePoste;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Disponibilite
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return Disponibilite
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idPersonne
     *
     * @param \laguntzaile\BenevolesBundle\Entity\Personne $idPersonne
     * @return Disponibilite
     */
    public function setIdPersonne(\laguntzaile\BenevolesBundle\Entity\Personne $idPersonne = null)
    {
        $this->idPersonne = $idPersonne;

        return $this;
    }

    /**
     * Get idPersonne
     *
     * @return \laguntzaile\BenevolesBundle\Entity\Personne 
     */
    public function getIdPersonne()
    {
        return $this->idPersonne;
    }

    /**
     * Set idEvenement
     *
     * @param \laguntzaile\BenevolesBundle\Entity\Evenement $idEvenement
     * @return Disponibilite
     */
    public function setIdEvenement(\laguntzaile\BenevolesBundle\Entity\Evenement $idEvenement = null)
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }

    /**
     * Get idEvenement
     *
     * @return \laguntzaile\BenevolesBundle\Entity\Evenement 
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }
}
