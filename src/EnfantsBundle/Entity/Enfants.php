<?php

namespace EnfantsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use OC\PlatformBundle\Form\AdvertType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Enfants
 *
 * @ORM\Table(name="enfants")
 * @ORM\Entity(repositoryClass="EnfantsBundle\Repository\EnfantsRepository")
 */
class Enfants
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\Type(type="alpha")
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     * @Assert\Type(type="alpha")
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *  @Assert\Choice({"f", "m"})
     * @ORM\Column(name="sexe", type="string", length=255, nullable=true)
     */
    private $sexe;

    /**
     * @var string
     * @ORM\Column(name="lieuNaissance", type="string", length=255, nullable=true)
     */
    private $lieuNaissance;

    /**
     * @var string
     * @Assert\Date
     * @var string A "Y-m-d" formatted value
     * @ORM\Column(name="dateNaissance", type="string", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="medicin", type="string", length=255, nullable=true)
     */
    private $medicin;

    /**
     * @var int
     * @Assert\Range(
     *      min = 0,
     *      max = 500,
     *      minMessage = "You need 0 at least",
     *      maxMessage = "You cant put more than 500"
     * )
     * @ORM\Column(name="medecinNumero", type="integer", nullable=true)
     */
    private $medecinNumero;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return string
     */
    public function getLieuNaissance()
    {
        return $this->lieuNaissance;
    }

    /**
     * @param string $lieuNaissance
     */
    public function setLieuNaissance($lieuNaissance)
    {
        $this->lieuNaissance = $lieuNaissance;
    }

    /**
     * @return string
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param string $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return string
     */
    public function getMedicin()
    {
        return $this->medicin;
    }

    /**
     * @param string $medicin
     */
    public function setMedicin($medicin)
    {
        $this->medicin = $medicin;
    }

    /**
     * @return int
     */
    public function getMedecinNumero()
    {
        return $this->medecinNumero;
    }

    /**
     * @param int $medecinNumero
     */
    public function setMedecinNumero($medecinNumero)
    {
        $this->medecinNumero = $medecinNumero;
    }

}



