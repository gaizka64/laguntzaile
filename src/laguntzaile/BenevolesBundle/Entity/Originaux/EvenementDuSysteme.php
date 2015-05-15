<?php

namespace laguntzaile\BenevolesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvenementDuSysteme
 *
 * @ORM\Table(name="evenement_du_systeme", indexes={@ORM\Index(name="evenement_du_systeme_action_idx", columns={"action"}), @ORM\Index(name="IDX_F4DBA55FECCFAC24", columns={"id_affectation"}), @ORM\Index(name="IDX_F4DBA55F92921F4A", columns={"id_disponibilite"}), @ORM\Index(name="IDX_F4DBA55F8B13D439", columns={"id_evenement"}), @ORM\Index(name="IDX_F4DBA55F5F15257A", columns={"id_personne"}), @ORM\Index(name="IDX_F4DBA55F920C4E9B", columns={"id_poste"}), @ORM\Index(name="IDX_F4DBA55FE1F1E56B", columns={"id_tour"})})
 * @ORM\Entity
 */
class EvenementDuSysteme
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="evenement_du_systeme_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_et_heure", type="datetime", nullable=false)
     */
    private $dateEtHeure;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", nullable=false)
     */
    private $action;

    /**
     * @var \Affectation
     *
     * @ORM\ManyToOne(targetEntity="Affectation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_affectation", referencedColumnName="id")
     * })
     */
    private $idAffectation;

    /**
     * @var \Disponibilite
     *
     * @ORM\ManyToOne(targetEntity="Disponibilite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_disponibilite", referencedColumnName="id")
     * })
     */
    private $idDisponibilite;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evenement", referencedColumnName="id")
     * })
     */
    private $idEvenement;

    /**
     * @var \Personne
     *
     * @ORM\ManyToOne(targetEntity="Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_personne", referencedColumnName="id")
     * })
     */
    private $idPersonne;

    /**
     * @var \Poste
     *
     * @ORM\ManyToOne(targetEntity="Poste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_poste", referencedColumnName="id")
     * })
     */
    private $idPoste;

    /**
     * @var \Tour
     *
     * @ORM\ManyToOne(targetEntity="Tour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tour", referencedColumnName="id")
     * })
     */
    private $idTour;



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
     * Set dateEtHeure
     *
     * @param \DateTime $dateEtHeure
     * @return EvenementDuSysteme
     */
    public function setDateEtHeure($dateEtHeure)
    {
        $this->dateEtHeure = $dateEtHeure;

        return $this;
    }

    /**
     * Get dateEtHeure
     *
     * @return \DateTime 
     */
    public function getDateEtHeure()
    {
        return $this->dateEtHeure;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return EvenementDuSysteme
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set idAffectation
     *
     * @param \laguntzaile\BenevolesBundle\Entity\Affectation $idAffectation
     * @return EvenementDuSysteme
     */
    public function setIdAffectation(\laguntzaile\BenevolesBundle\Entity\Affectation $idAffectation = null)
    {
        $this->idAffectation = $idAffectation;

        return $this;
    }

    /**
     * Get idAffectation
     *
     * @return \laguntzaile\BenevolesBundle\Entity\Affectation 
     */
    public function getIdAffectation()
    {
        return $this->idAffectation;
    }

    /**
     * Set idDisponibilite
     *
     * @param \laguntzaile\BenevolesBundle\Entity\Disponibilite $idDisponibilite
     * @return EvenementDuSysteme
     */
    public function setIdDisponibilite(\laguntzaile\BenevolesBundle\Entity\Disponibilite $idDisponibilite = null)
    {
        $this->idDisponibilite = $idDisponibilite;

        return $this;
    }

    /**
     * Get idDisponibilite
     *
     * @return \laguntzaile\BenevolesBundle\Entity\Disponibilite 
     */
    public function getIdDisponibilite()
    {
        return $this->idDisponibilite;
    }

    /**
     * Set idEvenement
     *
     * @param \laguntzaile\BenevolesBundle\Entity\Evenement $idEvenement
     * @return EvenementDuSysteme
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

    /**
     * Set idPersonne
     *
     * @param \laguntzaile\BenevolesBundle\Entity\Personne $idPersonne
     * @return EvenementDuSysteme
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
     * Set idPoste
     *
     * @param \laguntzaile\BenevolesBundle\Entity\Poste $idPoste
     * @return EvenementDuSysteme
     */
    public function setIdPoste(\laguntzaile\BenevolesBundle\Entity\Poste $idPoste = null)
    {
        $this->idPoste = $idPoste;

        return $this;
    }

    /**
     * Get idPoste
     *
     * @return \laguntzaile\BenevolesBundle\Entity\Poste 
     */
    public function getIdPoste()
    {
        return $this->idPoste;
    }

    /**
     * Set idTour
     *
     * @param \laguntzaile\BenevolesBundle\Entity\Tour $idTour
     * @return EvenementDuSysteme
     */
    public function setIdTour(\laguntzaile\BenevolesBundle\Entity\Tour $idTour = null)
    {
        $this->idTour = $idTour;

        return $this;
    }

    /**
     * Get idTour
     *
     * @return \laguntzaile\BenevolesBundle\Entity\Tour 
     */
    public function getIdTour()
    {
        return $this->idTour;
    }
}
