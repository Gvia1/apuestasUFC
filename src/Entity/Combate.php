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
     * @ORM\ManyToMany(targetEntity=Peleador::class, inversedBy="combates")
     */
    private $peleador1;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rounds;

    /**
     * @ORM\ManyToOne(targetEntity=Division::class, inversedBy="combates")
     */
    private $division;

    /**
     * @ORM\ManyToOne(targetEntity=evento::class, inversedBy="combates")
     */
    private $evento;

    public function __construct()
    {
        $this->peleadores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Peleador>
     */
    public function getPeleadores(): Collection
    {
        return $this->peleador1;
    }

    public function addPeleador1(Peleador $peleador1): self
    {
        if (!$this->peleador1->contains($peleador1)) {
            $this->peleador1[] = $peleador1;
        }

        return $this;
    }

    public function removePeleador1(Peleador $peleador1): self
    {
        $this->peleador1->removeElement($peleador1);

        return $this;
    }

    /**
     * @return Collection<int, Peleador>
     */
    public function getPeleador2(): Collection
    {
        return $this->peleador2;
    }

    public function addPeleador2(Peleador $peleador2): self
    {
        if (!$this->peleador2->contains($peleador2)) {
            $this->peleador2[] = $peleador2;
        }

        return $this;
    }

    public function removePeleador2(Peleador $peleador2): self
    {
        $this->peleador2->removeElement($peleador2);

        return $this;
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
}
