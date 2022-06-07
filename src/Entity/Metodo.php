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

    public function __construct()
    {
        $this->metodoEspecificos = new ArrayCollection();
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

}
