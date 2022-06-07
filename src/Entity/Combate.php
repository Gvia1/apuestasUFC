<?php

namespace App\Entity;

use App\Repository\CombateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CombateRepository::class)
 */
class Combate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rounds;

    /**
     * @ORM\ManyToOne(targetEntity=Division::class, inversedBy="combates")
     */
    private $division;

    /**
     * @ORM\ManyToOne(targetEntity=Evento::class, inversedBy="combates")
     */
    private $evento;

    /**
     * @ORM\ManyToOne(targetEntity=Peleador::class, inversedBy="combatesGanados")
     */
    private $Ganador;

    /**
     * @ORM\ManyToOne(targetEntity=Peleador::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $peleador2;

    /**
     * @ORM\ManyToOne(targetEntity=Peleador::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $peleador1;

    public function __construct()
    {
        $this->peleadores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRounds(): ?string
    {
        return $this->rounds;
    }

    public function setRounds(string $rounds): self
    {
        $this->rounds = $rounds;

        return $this;
    }

    public function getDivision(): ?Division
    {
        return $this->division;
    }

    public function setDivision(?Division $division): self
    {
        $this->division = $division;

        return $this;
    }

    public function getEvento(): ?evento
    {
        return $this->evento;
    }

    public function setEvento(?evento $evento): self
    {
        $this->evento = $evento;

        return $this;
    }

    public function getGanador(): ?Peleador
    {
        return $this->Ganador;
    }

    public function setGanador(?Peleador $Ganador): self
    {
        $this->Ganador = $Ganador;

        return $this;
    }

    public function getPeleador1(): ?Peleador
    {
        return $this->peleador1;
    }

    public function setPeleador1(?Peleador $peleador1): self
    {
        $this->peleador1 = $peleador1;

        return $this;
    }

    public function getPeleador2(): ?Peleador
    {
        return $this->peleador2;
    }

    public function setPeleador2(?Peleador $peleador2): self
    {
        $this->peleador2 = $peleador2;

        return $this;
    }
}
