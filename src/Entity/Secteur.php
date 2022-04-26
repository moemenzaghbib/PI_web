<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Secteur
 *
 * @ORM\Table(name="secteur", indexes={@ORM\Index(name="FK_8045251F3F0033A2", columns={"id_service"})})
 * @ORM\Entity
 */
class Secteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_secteur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSecteur;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="gouvernement", type="string", length=255, nullable=false)
     */
    private $gouvernement;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=255, nullable=false)
     */
    private $codePostal;

    /**
     * @var \Service
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_service", referencedColumnName="id")
     * })
     */
    private $idService;

    public function getIdSecteur(): ?int
    {
        return $this->idSecteur;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getGouvernement(): ?string
    {
        return $this->gouvernement;
    }

    public function setGouvernement(string $gouvernement): self
    {
        $this->gouvernement = $gouvernement;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

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
