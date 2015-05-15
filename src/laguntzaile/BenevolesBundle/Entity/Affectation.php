<?php

namespace laguntzaile\BenevolesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 *
 * @ORM\Table(name="affectation", indexes={@ORM\Index(name="affectation_statut_idx", columns={"statut"}), @ORM\Index(name="IDX_F4DD61D392921F4A", columns={"id_disponibilite"}), @ORM\Index(name="IDX_F4DD61D3E1F1E56B", columns={"id_tour"})})
 * @ORM\Entity(repositoryClass="AffectationRepository")
 */
class Affectation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="affectation_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_et_heure_proposee", type="datetime", nullable=true)
     */
    private $dateEtHeureProposee;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="text", nullable=false)
     */
    private $statut = 'possible';

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=false)
     */
    private $commentaire;

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
     * Set dateEtHeureProposee
     *
     * @param \DateTime $dateEtHeureProposee
     * @return Affectation
     */
    public function setDateEtHeureProposee($dateEtHeureProposee)
    {
        $this->dateEtHeureProposee = $dateEtHeureProposee;

        return $this;
    }

    /**
     * Get dateEtHeureProposee
     *
     * @return \DateTime 
     */
    public function getDateEtHeureProposee()
    {
        return $this->dateEtHeureProposee;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return Affectation
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
     * Set commentaire
     *
     * @param string $commentaire
     * @return Affectation
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
     * Set idDisponibilite
     *
     * @param \laguntzaile\BenevolesBundle\Entity\Disponibilite $idDisponibilite
     * @return Affectation
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
     * Set idTour
     *
     * @param \laguntzaile\BenevolesBundle\Entity\Tour $idTour
     * @return Affectation
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
