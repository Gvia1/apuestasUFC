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
     * @ORM\ManyToOne(targetEntity=Division::class, inversedBy="campeon")
     */
    private $division;

    /**
     * @ORM\OneToMany(targetEntity=CombatePeleador::class, mappedBy="peleador", orphanRemoval=true)
     */
    private $combates;

    /**
     * @ORM\OneToMany(targetEntity=Apuesta::class, mappedBy="ganador")
     */
    private $apuestas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $victorias;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $derrotas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $empates;


    public function __construct()
    {
        $this->combates = new ArrayCollection();
        $this->combatesGanados = new ArrayCollection();
        $this->apuestas = new ArrayCollection();
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

    public function getDivision(): ?Division
    {
        return $this->division;
    }

    public function setDivision(?Division $division): self
    {
        $this->division = $division;

        return $this;
    }

    /**
     * @return Collection<int, CombatePeleador>
     */
    public function getCombates(): Collection
    {
        return $this->combates;
    }

    public function addCombate(CombatePeleador $combate): self
    {
        if (!$this->combates->contains($combate)) {
            $this->combates[] = $combate;
            $combate->setPeleador($this);
        }

        return $this;
    }

    public function removeCombate(CombatePeleador $combate): self
    {
        if ($this->combates->removeElement($combate)) {
            // set the owning side to null (unless already changed)
            if ($combate->getPeleador() === $this) {
                $combate->setPeleador(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Apuesta>
     */
    public function getApuestas(): Collection
    {
        return $this->apuestas;
    }

    public function addApuesta(Apuesta $apuesta): self
    {
        if (!$this->apuestas->contains($apuesta)) {
            $this->apuestas[] = $apuesta;
            $apuesta->setGanador($this);
        }

        return $this;
    }

    public function removeApuesta(Apuesta $apuesta): self
    {
        if ($this->apuestas->removeElement($apuesta)) {
            // set the owning side to null (unless already changed)
            if ($apuesta->getGanador() === $this) {
                $apuesta->setGanador(null);
            }
        }

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

    public function getDerrotas(): ?string
    {
        return $this->derrotas;
    }

    public function setDerrotas(?string $derrotas): self
    {
        $this->derrotas = $derrotas;

        return $this;
    }

    public function getEmpates(): ?string
    {
        return $this->empates;
    }

    public function setEmpates(?string $empates): self
    {
        $this->empates = $empates;

        return $this;
    }

}
