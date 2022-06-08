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
     * @ORM\OneToMany(targetEntity=CombatePeleador::class, mappedBy="combate", orphanRemoval=true)
     */
    private $peleadores;


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
     * @return Collection<int, CombatePeleador>
     */
    public function getPeleadores(): Collection
    {
        return $this->peleadores;
    }

    public function addPeleadores(CombatePeleador $peleadores): self
    {
        if (!$this->peleadores->contains($peleadores)) {
            $this->peleadores[] = $peleadores;
            $peleadores->setCombate($this);
        }

        return $this;
    }

    public function removePeleadore(CombatePeleador $peleadores): self
    {
        if ($this->peleadores->removeElement($peleadores)) {
            // set the owning side to null (unless already changed)
            if ($peleadores->getCombate() === $this) {
                $peleadores->setCombate(null);
            }
        }

        return $this;
    }

}
