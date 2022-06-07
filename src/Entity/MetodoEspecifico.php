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

    public function __construct()
    {
        
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
}
