<?php

namespace App\Entity;

use App\Repository\DivisionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DivisionRepository::class)
 */
class Division
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
    private $nombre;


    /**
     * @ORM\OneToMany(targetEntity=Combate::class, mappedBy="division")
     */
    private $combates;

    /**
     * @ORM\OneToMany(targetEntity=Peleador::class, mappedBy="division")
     */
    private $peleadores;

    public function __construct()
    {
        $this->campeon = new ArrayCollection();
        $this->combates = new ArrayCollection();
        $this->peleadores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Peleador>
     */
    public function getCampeon(): Collection
    {
        return $this->campeon;
    }

    public function addCampeon(Peleador $campeon): self
    {
        if (!$this->campeon->contains($campeon)) {
            $this->campeon[] = $campeon;
            $campeon->setDivision($this);
        }

        return $this;
    }

    public function removeCampeon(Peleador $campeon): self
    {
        if ($this->campeon->removeElement($campeon)) {
            // set the owning side to null (unless already changed)
            if ($campeon->getDivision() === $this) {
                $campeon->setDivision(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Combate>
     */
    public function getCombates(): Collection
    {
        return $this->combates;
    }

    public function addCombate(Combate $combate): self
    {
        if (!$this->combates->contains($combate)) {
            $this->combates[] = $combate;
            $combate->setDivision($this);
        }

        return $this;
    }

    public function removeCombate(Combate $combate): self
    {
        if ($this->combates->removeElement($combate)) {
            // set the owning side to null (unless already changed)
            if ($combate->getDivision() === $this) {
                $combate->setDivision(null);
            }
        }

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
            $peleadore->setDivision($this);
        }

        return $this;
    }

    public function removePeleadore(Peleador $peleadore): self
    {
        if ($this->peleadores->removeElement($peleadore)) {
            // set the owning side to null (unless already changed)
            if ($peleadore->getDivision() === $this) {
                $peleadore->setDivision(null);
            }
        }

        return $this;
    }
}
