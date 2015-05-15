<?php

namespace laguntzaile\BenevolesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement", indexes={@ORM\Index(name="evenement_archive_idx", columns={"archive"}), @ORM\Index(name="evenement_debut_idx", columns={"debut"}), @ORM\Index(name="IDX_B26681E4019AD94", columns={"id_evenement_precedent"})})
 * @ORM\Entity(repositoryClass="EvenementRepository")
 */
class Evenement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="evenement_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", nullable=false)
     */
    private $nom;

    /**
     * @var boolean
     *
     * @ORM\Column(name="archive", type="boolean", nullable=false)
     */
    private $archive = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetimetz", nullable=false)
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetimetz", nullable=false)
     */
    private $fin;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", nullable=false)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="plan", type="text", nullable=true)
     */
    private $plan;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evenement_precedent", referencedColumnName="id")
     * })
     */
    private $idEvenementPrecedent;



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
     * Set nom
     *
     * @param string $nom
     * @return Evenement
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     * @return Evenement
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return boolean 
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     * @return Evenement
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime 
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     * @return Evenement
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime 
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     * @return Evenement
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string 
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set plan
     *
     * @param string $plan
     * @return Evenement
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return string 
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Set idEvenementPrecedent
     *
     * @param \laguntzaile\BenevolesBundle\Entity\Evenement $idEvenementPrecedent
     * @return Evenement
     */
    public function setIdEvenementPrecedent(\laguntzaile\BenevolesBundle\Entity\Evenement $idEvenementPrecedent = null)
    {
        $this->idEvenementPrecedent = $idEvenementPrecedent;

        return $this;
    }

    /**
     * Get idEvenementPrecedent
     *
     * @return \laguntzaile\BenevolesBundle\Entity\Evenement 
     */
    public function getIdEvenementPrecedent()
    {
        return $this->idEvenementPrecedent;
    }
}
