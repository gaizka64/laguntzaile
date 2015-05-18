<?php

namespace laguntzaile\BenevolesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Personne
 *
 * @ORM\Table(name="personne", indexes={@ORM\Index(name="personne_code_postal_idx", columns={"code_postal"}), @ORM\Index(name="personne_date_naissance_idx", columns={"date_naissance"}), @ORM\Index(name="personne_domicile_idx", columns={"domicile"}), @ORM\Index(name="personne_email_idx", columns={"email"}), @ORM\Index(name="personne_nom_idx", columns={"nom"}), @ORM\Index(name="personne_portable_idx", columns={"portable"}), @ORM\Index(name="personne_prenom_idx", columns={"prenom"}), @ORM\Index(name="personne_ville_idx", columns={"ville"})})
 * @ORM\Entity(repositoryClass="PersonneRepository")
 */
class Personne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="personne_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", nullable=false)
     * @Assert\NotBlank(message="Le nom doit être spécifié.")
     * @Assert\Regex(
     *          pattern="#^[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+([\-\' ][a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+)*$#i",
     *          message="Le nom doit être composé (uniquement) de lettres.")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", nullable=false)
     * @Assert\Regex(
     *          pattern="#^[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+([\-\' ][[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]]+)*$#i",
     *          message="Le prénom doit être composé (uniquement) de lettres.")
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", nullable=false)
     * @Assert\Regex(
     *          pattern="#[0-9]{5}#",
     *          message="Code postal incorrect.")
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", nullable=false)
     * @Assert\Regex(
     *          pattern="#^[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+([\-\' ][[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]]+)*$#i",
     *          message="La commune doit être composée (uniquement) de lettres.")
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="portable", type="string", nullable=false)
     * @Assert\Regex(
     *          pattern="#([\+]{0,1})[0-9]{10,}$#",
     *          message="Le numéro de portable doit être composé d'au moins 10 chiffres.") 
     */
    private $portable;

    /**
     * @var string
     *
     * @ORM\Column(name="domicile", type="string", nullable=false)
     * @Assert\Regex(
     *          pattern="#([\+]{0,1})[0-9]{10,}$#",
     *          message="Le numéro du domicile doit être composé d'au moins 10 chiffres.")
     */
    private $domicile;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=false)
     * @Assert\Email(message="Veuillez saisir une adresse de courriel valide.")
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=true)
     * 
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="profession", type="string", nullable=false)
     * @Assert\Regex(
     *          pattern="#[a-z]+#i",
     *          message="La profession doit être composée des lettres.")
     */
    private $profession;

    /**
     * @var string
     *
     * @ORM\Column(name="competences", type="string", nullable=false)
     * @Assert\Regex(
     *          pattern="#[a-z]+#i",
     *          message="Les compétences doivent être composées de lettres.")
     */
    private $competences;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", nullable=false)
     */
    private $avatar;

    /**
     * @var string
     *
     * @ORM\Column(name="langues", type="string", nullable=false)
     * @Assert\Regex(
     *          pattern="#[a-z]+#i",
     *          message="Les langues parlées doivent être composées de lettres.")
     */
    private $langues;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", nullable=false)
     * @Assert\Regex(
     *          pattern="#[a-z]+#i",
     *          message="Le commentaire doit être composé de lettres.")
     */
    private $commentaire;



    /**
     * Set nom
     *
     * @param string $nom
     * @return Personne
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
     * Set prenom
     *
     * @param string $prenom
     * @return Personne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Personne
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     * @return Personne
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Personne
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set portable
     *
     * @param string $portable
     * @return Personne
     */
    public function setPortable($portable)
    {
        $this->portable = $portable;

        return $this;
    }

    /**
     * Get portable
     *
     * @return string 
     */
    public function getPortable()
    {
        return $this->portable;
    }

    /**
     * Set domicile
     *
     * @param string $domicile
     * @return Personne
     */
    public function setDomicile($domicile)
    {
        $this->domicile = $domicile;

        return $this;
    }

    /**
     * Get domicile
     *
     * @return string 
     */
    public function getDomicile()
    {
        return $this->domicile;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Personne
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Personne
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set profession
     *
     * @param string $profession
     * @return Personne
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string 
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set competences
     *
     * @param string $competences
     * @return Personne
     */
    public function setCompetences($competences)
    {
        $this->competences = $competences;

        return $this;
    }

    /**
     * Get competences
     *
     * @return string 
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return Personne
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set langues
     *
     * @param string $langues
     * @return Personne
     */
    public function setLangues($langues)
    {
        $this->langues = $langues;

        return $this;
    }

    /**
     * Get langues
     *
     * @return string 
     */
    public function getLangues()
    {
        return $this->langues;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Personne
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
