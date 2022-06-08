<?php

namespace App\Entity;

use App\Repository\MetodoEspecificoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MetodoEspecificoRepository::class)
 */
class MetodoEspecifico
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
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=Metodo::class, inversedBy="metodoEspecificos")
     */
    private $metodo;

    /**
     * @ORM\OneToMany(targetEntity=CombatePeleador::class, mappedBy="metodoEspecifico")
     */
    private $combatesGanados;

    /**
     * @ORM\OneToMany(targetEntity=Apuesta::class, mappedBy="metodoEspecifico")
     */
    private $apuestas;

    public function __construct()
    {
        $this->combatesGanados = new ArrayCollection();
        $this->apuestas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getMetodo(): ?Metodo
    {
        return $this->metodo;
    }

    public function setMetodo(?Metodo $metodo): self
    {
        $this->metodo = $metodo;

        return $this;
    }

    /**
     * @return Collection<int, CombatePeleador>
     */
    public function getCombatesGanados(): Collection
    {
        return $this->combatesGanados;
    }

    public function addCombatesGanados(CombatePeleador $combatesGanados): self
    {
        if (!$this->combatesGanados->contains($combatesGanados)) {
            $this->combatesGanados[] = $combatesGanados;
            $combatesGanados->setMetodoEspecifico($this);
        }

        return $this;
    }

    public function removeCombatesGanados(CombatePeleador $combatesGanados): self
    {
        if ($this->combatesGanados->removeElement($combatesGanados)) {
            // set the owning side to null (unless already changed)
            if ($combatesGanados->getMetodoEspecifico() === $this) {
                $combatesGanados->setMetodoEspecifico(null);
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
            $apuesta->setMetodoEspecifico($this);
        }

        return $this;
    }

    public function removeApuesta(Apuesta $apuesta): self
    {
        if ($this->apuestas->removeElement($apuesta)) {
            // set the owning side to null (unless already changed)
            if ($apuesta->getMetodoEspecifico() === $this) {
                $apuesta->setMetodoEspecifico(null);
            }
        }

        return $this;
    }
}
