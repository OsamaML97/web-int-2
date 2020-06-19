<?php

namespace FactureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity(repositoryClass="FactureBundle\Repository\FactureRepository")
 */
class Facture
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
     * @var float
     *
     *
     * @ORM\Column(name="Montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $Montant;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Delais", type="datetime", nullable=false, columnDefinition="DATETIME on update CURRENT_TIMESTAMP")
     */
    private $Delais;
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_User", type="integer", nullable=false)
     */
    private $id_U;
    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=255, nullable=false)
     */
    private $Etat;

    /**
     * @return float
     */
    public function getMontant()
    {
        return $this->Montant;
    }

    /**
     * @param float $Montant
     */
    public function setMontant($Montant)
    {
        $this->Montant = $Montant;
    }

    /**
     * @return \DateTime
     */
    public function getDelais()
    {
        return $this->Delais;
    }

    /**
     * @param \DateTime $Delais
     */
    public function setDelais($Delais)
    {
        $this->Delais = $Delais;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->Etat;
    }

    /**
     * @param string $Etat
     */
    public function setEtat($Etat)
    {
        $this->Etat = $Etat;
    }

    /**
     * @return int
     */
    public function getIdU()
    {
        return $this->id_U;
    }

    /**
     * @return int
     */
    public function getid_U()
    {
        return $this->id_U;
    }

    /**
     * @param int $id_U
     */
    public function setIdU($id_U)
    {
        $this->id_U = $id_U;
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

