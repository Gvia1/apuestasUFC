<?php

namespace App\Entity;

use App\Repository\CombatePeleadorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CombatePeleadorRepository::class)
 */
class CombatePeleador
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Peleador::class, inversedBy="combates")
     * @ORM\JoinColumn(nullable=false)
     */
    private $peleador;

    /**
     * @ORM\ManyToOne(targetEntity=Combate::class, inversedBy="peleadores")
     * @ORM\JoinColumn(nullable=false)
     */
    private $combate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ganador;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $round;

    /**
     * @ORM\ManyToOne(targetEntity=Metodo::class, inversedBy="combatesGanados")
     * @ORM\JoinColumn(nullable=false)
     */
    private $metodo;

    /**
     * @ORM\ManyToOne(targetEntity=MetodoEspecifico::class, inversedBy="combatesGanados")
     */
    private $metodoEspecifico;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeleador(): ?peleador
    {
        return $this->peleador;
    }

    public function setPeleador(?peleador $peleador): self
    {
        $this->peleador = $peleador;

        return $this;
    }

    public function getCombate(): ?combate
    {
        return $this->combate;
    }

    public function setCombate(?combate $combate): self
    {
        $this->combate = $combate;

        return $this;
    }

    public function isGanador(): ?bool
    {
        return $this->ganador;
    }

    public function setGanador(?bool $ganador): self
    {
        $this->ganador = $ganador;

        return $this;
    }

    public function getRound(): ?string
    {
        return $this->round;
    }

    public function setRound(string $round): self
    {
        $this->round = $round;

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
}
