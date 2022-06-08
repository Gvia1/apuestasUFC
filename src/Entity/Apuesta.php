<?php

namespace App\Entity;

use App\Repository\ApuestaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApuestaRepository::class)
 */
class Apuesta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="apuestas")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity=Combate::class, inversedBy="apuestas")
     */
    private $combate;

    /**
     * @ORM\ManyToOne(targetEntity=Metodo::class, inversedBy="apuestas")
     */
    private $metodo;

    /**
     * @ORM\ManyToOne(targetEntity=MetodoEspecifico::class, inversedBy="apuestas")
     */
    private $metodoEspecifico;

    /**
     * @ORM\ManyToOne(targetEntity=Peleador::class, inversedBy="apuestas")
     */
    private $ganador;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $round;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?user
    {
        return $this->usuario;
    }

    public function setUsuario(?user $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
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

    public function getMetodoEspecifico(): ?metodoEspecifico
    {
        return $this->metodoEspecifico;
    }

    public function setMetodoEspecifico(?metodoEspecifico $metodoEspecifico): self
    {
        $this->metodoEspecifico = $metodoEspecifico;

        return $this;
    }

    public function getGanador(): ?peleador
    {
        return $this->ganador;
    }

    public function setGanador(?peleador $ganador): self
    {
        $this->ganador = $ganador;

        return $this;
    }

    public function getRound(): ?string
    {
        return $this->round;
    }

    public function setRound(?string $round): self
    {
        $this->round = $round;

        return $this;
    }
}
