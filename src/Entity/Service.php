<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Service
 *
 * @ORM\Table(name="service", uniqueConstraints={@ORM\UniqueConstraint(name="nomService", columns={"nomService"})})
 * @ORM\Entity
 */
class Service
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
     * @ORM\Column(name="nomService", type="string", length=255, nullable=false)
     */
    private $nomservice;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNomservice(): string
    {
        return $this->nomservice;
    }

    /**
     * @param string $nomservice
     */
    public function setNomservice(string $nomservice): void
    {
        $this->nomservice = $nomservice;
    }

    public function __toString()
    {
        return (string) $this->nomservice;
    }
}
