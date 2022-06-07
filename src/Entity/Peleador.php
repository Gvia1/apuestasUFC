<?php

namespace App\Entity;

use App\Repository\PeleadorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeleadorRepository::class)
 */
class Peleador
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alias;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $edad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $altura;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $peso;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $victorias;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $empates;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $derrotas;

    /**
     * @ORM\ManyToMany(targetEntity=Combate::class, mappedBy="peleador1")
     */
    private $combatesPeleador1;

    /**
     * @ORM\ManyToOne(targetEntity=Division::class, inversedBy="campeon")
     */
    private $division;

    public function __construct()
    {
        $this->combates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getEdad(): ?string
    {
        return $this->edad;
    }

    public function setEdad(string $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getAltura(): ?string
    {
        return $this->altura;
    }

    public function setAltura(string $altura): self
    {
        $this->altura = $altura;

        return $this;
    }

    public function getPeso(): ?string
    {
        return $this->peso;
    }

    public function setPeso(string $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getVictorias(): ?string
    {
        return $this->victorias;
    }

    public function setVictorias(string $victorias): self
    {
        $this->victorias = $victorias;

        return $this;
    }

    public function getEmpates(): ?string
    {
        return $this->empates;
    }

    public function setEmpates(string $empates): self
    {
        $this->empates = $empates;

        return $this;
    }

    public function getDerrotas(): ?string
    {
        return $this->derrotas;
    }

    public function setDerrotas(string $derrotas): self
    {
        $this->derrotas = $derrotas;

        return $this;
    }

    /**
     * @return Collection<int, Combate>
     */
    public function getCombatesPeleador1(): Collection
    {
        return $this->combates;
    }

    public function addCombatePeleador1(Combate $combate): self
    {
        if (!$this->combates->contains($combate)) {
            $this->combates[] = $combate;
            $combate->addPeleador1($this);
        }

        return $this;
    }

    public function removeCombatePeleador1(Combate $combate): self
    {
        if ($this->combates->removeElement($combate)) {
            $combate->removePeleador1($this);
        }

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
}
