<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="demande_ibfk_1", columns={"id_service"})})
 * @ORM\Entity
 */
class Demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="num_demande", type="integer", nullable=false)
     */
    private $numDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="type_demande", type="string", length=50, nullable=false)
     */
    private $typeDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="date_demande", type="string", length=255, nullable=false)
     */
    private $dateDemande;

    /**
     * @var int
     *
     * @ORM\Column(name="id_citoyen", type="integer", nullable=false)
     */
    private $idCitoyen;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var \Service
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_service", referencedColumnName="id")
     * })
     */
    private $idService;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumDemande(): ?int
    {
        return $this->numDemande;
    }

    public function setNumDemande(int $numDemande): self
    {
        $this->numDemande = $numDemande;

        return $this;
    }

    public function getTypeDemande(): ?string
    {
        return $this->typeDemande;
    }

    public function setTypeDemande(string $typeDemande): self
    {
        $this->typeDemande = $typeDemande;

        return $this;
    }

    public function getDateDemande(): ?string
    {
        return $this->dateDemande;
    }

    public function setDateDemande(string $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getIdCitoyen(): ?int
    {
        return $this->idCitoyen;
    }

    public function setIdCitoyen(int $idCitoyen): self
    {
        $this->idCitoyen = $idCitoyen;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getIdService(): ?Service
    {
        return $this->idService;
    }

    public function setIdService(?Service $idService): self
    {
        $this->idService = $idService;

        return $this;
    }


}
