<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="publication", indexes={@ORM\Index(name="publication_ibfk_1", columns={"id_citoyen"})})
 * @ORM\Entity
 */
class Publication
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=false)
     */
    private $photo;

    /**
     * @var int
     *
     * @ORM\Column(name="id_employee", type="integer", nullable=false)
     */
    private $idEmployee;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirm_publication", type="boolean", nullable=false)
     */
    private $confirmPublication;

    /**
     * @var \Citoyen
     *
     * @ORM\ManyToOne(targetEntity="Citoyen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_citoyen", referencedColumnName="id")
     * })
     */
    private $idCitoyen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getIdEmployee(): ?int
    {
        return $this->idEmployee;
    }

    public function setIdEmployee(int $idEmployee): self
    {
        $this->idEmployee = $idEmployee;

        return $this;
    }

    public function getConfirmPublication(): ?bool
    {
        return $this->confirmPublication;
    }

    public function setConfirmPublication(bool $confirmPublication): self
    {
        $this->confirmPublication = $confirmPublication;

        return $this;
    }

    public function getIdCitoyen(): ?Citoyen
    {
        return $this->idCitoyen;
    }

    public function setIdCitoyen(?Citoyen $idCitoyen): self
    {
        $this->idCitoyen = $idCitoyen;

        return $this;
    }


}
