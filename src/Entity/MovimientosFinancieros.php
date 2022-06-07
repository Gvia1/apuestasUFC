<?php

namespace App\Entity;

use App\Repository\MovimientosFinancierosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovimientosFinancierosRepository::class)
 */
class MovimientosFinancieros
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Importe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Concepto;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="movimientosFinancieros")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImporte(): ?int
    {
        return $this->Importe;
    }

    public function setImporte(int $Importe): self
    {
        $this->Importe = $Importe;

        return $this;
    }

    public function getConcepto(): ?string
    {
        return $this->Concepto;
    }

    public function setConcepto(string $Concepto): self
    {
        $this->Concepto = $Concepto;

        return $this;
    }

    public function getUsuario(): ?user
    {
        return $this->Usuario;
    }

    public function setUsuario(?user $Usuario): self
    {
        $this->Usuario = $Usuario;

        return $this;
    }
}
