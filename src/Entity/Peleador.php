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
     * @ORM\ManyToMany(targetEntity=Combate::class, mappedBy="peleadores")
     */
    private $combates;

    /**
     * @ORM\OneToMany(targetEntity=Combate::class, mappedBy="ganador")
     */
    private $combatesGanados;

    public function __construct()
    {
        $this->combates = new ArrayCollection();
        $this->combatesGanados = new ArrayCollection();
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
     * @return Collection<int, Combate>
     */
    public function getCombates(): Collection
    {
        return $this->combates;
    }

    public function addCombate(Combate $combate): self
    {
        if (!$this->combates->contains($combate)) {
            $this->combates[] = $combate;
            $combate->addPeleadore($this);
        }

        return $this;
    }

    public function removeCombate(Combate $combate): self
    {
        if ($this->combates->removeElement($combate)) {
            $combate->removePeleadore($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Combate>
     */
    public function getCombatesGanados(): Collection
    {
        return $this->combatesGanados;
    }

    public function addCombatesGanado(Combate $combatesGanado): self
    {
        if (!$this->combatesGanados->contains($combatesGanado)) {
            $this->combatesGanados[] = $combatesGanado;
            $combatesGanado->setGanador($this);
        }

        return $this;
    }

    public function removeCombatesGanado(Combate $combatesGanado): self
    {
        if ($this->combatesGanados->removeElement($combatesGanado)) {
            // set the owning side to null (unless already changed)
            if ($combatesGanado->getGanador() === $this) {
                $combatesGanado->setGanador(null);
            }
        }

        return $this;
    }
}
