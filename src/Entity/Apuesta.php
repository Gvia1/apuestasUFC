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
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="apuestas")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity=Combate::class, inversedBy="apuestas")
     */
    private $combate;

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
}
