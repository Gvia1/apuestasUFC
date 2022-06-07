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
     * @ORM\OneToMany(targetEntity=Resultado::class, mappedBy="metodoEspecifico")
     */
    private $resultados;

    public function __construct()
    {
        $this->resultados = new ArrayCollection();
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
     * @return Collection<int, Resultado>
     */
    public function getResultados(): Collection
    {
        return $this->resultados;
    }

    public function addResultado(Resultado $resultado): self
    {
        if (!$this->resultados->contains($resultado)) {
            $this->resultados[] = $resultado;
            $resultado->setMetodoEspecifico($this);
        }

        return $this;
    }

    public function removeResultado(Resultado $resultado): self
    {
        if ($this->resultados->removeElement($resultado)) {
            // set the owning side to null (unless already changed)
            if ($resultado->getMetodoEspecifico() === $this) {
                $resultado->setMetodoEspecifico(null);
            }
        }

        return $this;
    }
}
