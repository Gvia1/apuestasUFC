<?php

namespace App\Entity;

use App\Repository\MetodoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MetodoRepository::class)
 */
class Metodo
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
     * @ORM\OneToMany(targetEntity=MetodoEspecifico::class, mappedBy="metodo")
     */
    private $metodoEspecificos;

    /**
     * @ORM\OneToMany(targetEntity=CombatePeleador::class, mappedBy="metodo")
     */
    private $combatesGanados;

    /**
     * @ORM\OneToMany(targetEntity=Apuesta::class, mappedBy="metodo")
     */
    private $apuestas;

    public function __construct()
    {
        $this->metodoEspecificos = new ArrayCollection();
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

    /**
     * @return Collection<int, MetodoEspecifico>
     */
    public function getMetodoEspecifico(): Collection
    {
        return $this->metodoEspecificos;
    }

    public function addMetodoEspecifico(MetodoEspecifico $metodoEspecifico): self
    {
        if (!$this->metodoEspecificos->contains($metodoEspecifico)) {
            $this->metodoEspecificos[] = $metodoEspecifico;
            $metodoEspecifico->setMetodo($this);
        }

        return $this;
    }

    public function removeMetodoEspecifico(MetodoEspecifico $metodoEspecifico): self
    {
        if ($this->metodoEspecificos->removeElement($metodoEspecifico)) {
            // set the owning side to null (unless already changed)
            if ($metodoEspecifico->getMetodo() === $this) {
                $metodoEspecifico->setMetodo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CombatePeleador>
     */
    public function getCombatesGanados(): Collection
    {
        return $this->combatesGanados;
    }

    public function addCombatesGanado(CombatePeleador $combatesGanado): self
    {
        if (!$this->combatesGanados->contains($combatesGanado)) {
            $this->combatesGanados[] = $combatesGanado;
            $combatesGanado->setMetodo($this);
        }

        return $this;
    }

    public function removeCombatesGanado(CombatePeleador $combatesGanado): self
    {
        if ($this->combatesGanados->removeElement($combatesGanado)) {
            // set the owning side to null (unless already changed)
            if ($combatesGanado->getMetodo() === $this) {
                $combatesGanado->setMetodo(null);
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
            $apuesta->setMetodo($this);
        }

        return $this;
    }

    public function removeApuesta(Apuesta $apuesta): self
    {
        if ($this->apuestas->removeElement($apuesta)) {
            // set the owning side to null (unless already changed)
            if ($apuesta->getMetodo() === $this) {
                $apuesta->setMetodo(null);
            }
        }

        return $this;
    }

}
