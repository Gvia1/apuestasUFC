<?php

namespace App\Entity;

use App\Repository\ResultadoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResultadoRepository::class)
 */
class Resultado
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Combate::class, cascade={"persist", "remove"})
     */
    private $combate;

    /**
     * @ORM\ManyToOne(targetEntity=metodo::class, inversedBy="metodoEspecifico")
     */
    private $metodo;

    /**
     * @ORM\ManyToOne(targetEntity=MetodoEspecifico::class, inversedBy="resultados")
     */
    private $metodoEspecifico;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCombate(): ?Combate
    {
        return $this->combate;
    }

    public function setCombate(?Combate $combate): self
    {
        $this->combate = $combate;

        return $this;
    }

    public function getMetodo(): ?metodo
    {
        return $this->metodo;
    }

    public function setMetodo(?metodo $metodo): self
    {
        $this->metodo = $metodo;

        return $this;
    }

    public function getMetodoEspecifico(): ?MetodoEspecifico
    {
        return $this->metodoEspecifico;
    }

    public function setMetodoEspecifico(?MetodoEspecifico $metodoEspecifico): self
    {
        $this->metodoEspecifico = $metodoEspecifico;

        return $this;
    }
}
