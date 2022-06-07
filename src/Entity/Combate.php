<?php

namespace App\Entity;

use App\Repository\CombateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CombateRepository::class)
 */
class Combate
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
    private $rounds;

    /**
     * @ORM\ManyToOne(targetEntity=Division::class, inversedBy="combates")
     */
    private $division;

    /**
     * @ORM\ManyToOne(targetEntity=Evento::class, inversedBy="combates")
     */
    private $evento;

    /**
     * @ORM\ManyToMany(targetEntity=Peleador::class, inversedBy="combates")
     */
    private $peleadores;

    /**
     * @ORM\ManyToOne(targetEntity=peleador::class, inversedBy="combatesGanados")
     */
    private $ganador;


    public function __construct()
    {
        $this->peleadores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRounds(): ?string
    {
        return $this->rounds;
    }

    public function setRounds(string $rounds): self
    {
        $this->rounds = $rounds;

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

    public function getEvento(): ?evento
    {
        return $this->evento;
    }

    public function setEvento(?evento $evento): self
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * @return Collection<int, Peleador>
     */
    public function getPeleadores(): Collection
    {
        return $this->peleadores;
    }

    public function addPeleadore(Peleador $peleadore): self
    {
        if (!$this->peleadores->contains($peleadore)) {
            $this->peleadores[] = $peleadore;
        }

        return $this;
    }

    public function removePeleadore(Peleador $peleadore): self
    {
        $this->peleadores->removeElement($peleadore);

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


}
