<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tache
 *
 * @ORM\Entity(repositoryClass="App\Repository\TacheRepository")
 */
class Tache
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_tache", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTache;

    /**
     * @Assert\NotBlank(message="Numero Tache doit etre non vide")
     * @Assert\Length(
     *      min = 1,
     *      minMessage=" Entrer un Numero Tache au mini de 1 chifre"
     *
     *     )
     *
     * @ORM\Column(name="num_tache", type="integer", nullable=false)
     */
    private $numTache;

    /**
     * @Assert\NotBlank(message=" Nom doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un Nom au mini de 5 caracteres"
     *
     *     )
     *
     * @ORM\Column(name="nom_tache", type="string", length=255, nullable=false)
     */
    private $nomTache;

    /**
     * @Assert\NotBlank(message=" Temps Alloué du Tache doit etre non vide")
     * @Assert\Length(
     *      min = 4,
     *      minMessage=" Entrer temps alloué en heurs (minimum 4 heurs )"
     *
     *     )
     *
     * @ORM\Column(name="needed_time", type="integer", nullable=false)
     */
    private $neededTime;

    /**
     * @Assert\NotBlank(message=" Etat Tache doit etre non vide")
     * @Assert\Length(
     *      min = 4,
     *      minMessage="Etat Tache trop courte"
     *
     *     )
     *
     * @ORM\Column(name="etat_tache", type="string", length=255, nullable=false, options={"default"="NOT DONE"})
     */
    private $etatTache = 'NOT DONE';

    /**
     * @Assert\NotBlank(message=" Importance Tache doit etre non vide")
     * @Assert\Length(
     *      min = 4,
     *      minMessage="Importance Tache trop courte"
     *
     *     )
     *
     * @ORM\Column(name="importance", type="string", length=255, nullable=false, options={"default"="Normal"})
     */
    private $importance = 'Normal';

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="taches")
     */
    private $employee;


    /**
     * @return int
     */
    public function getIdTache(): int
    {
        return $this->idTache;
    }

    /**
     * @param int $idTache
     */
    public function setIdTache(int $idTache): void
    {
        $this->idTache = $idTache;
    }

    /**
     * @return int
     */
    public function getNumTache(): ?int
    {
        return $this->numTache;
    }

    /**
     * @param int $numTache
     */
    public function setNumTache(int $numTache): void
    {
        $this->numTache = $numTache;
    }

    /**
     * @return string
     */
    public function getNomTache(): ?string
    {
        return $this->nomTache;
    }

    /**
     * @param string $nomTache
     */
    public function setNomTache(string $nomTache): void
    {
        $this->nomTache = $nomTache;
    }

    /**
     * @return int
     */
    public function getNeededTime(): ?int
    {
        return $this->neededTime;
    }

    /**
     * @param int $neededTime
     */
    public function setNeededTime(int $neededTime): void
    {
        $this->neededTime = $neededTime;
    }

    /**
     * @return string
     */
    public function getEtatTache(): ?string
    {
        return $this->etatTache;
    }

    /**
     * @param string $etatTache
     */
    public function setEtatTache(string $etatTache): void
    {
        $this->etatTache = $etatTache;
    }

    /**
     * @return string
     */
    public function getImportance(): ?string
    {
        return $this->importance;
    }

    /**
     * @param string $importance
     */
    public function setImportance(string $importance): void
    {
        $this->importance = $importance;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }




}
