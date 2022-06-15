<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Apuesta::class, mappedBy="usuario")
     */
    private $apuestas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Apellidos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Direccion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Localidad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entidad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $oficina;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero_cuenta;

    /**
     * @ORM\OneToMany(targetEntity=MovimientosFinancieros::class, mappedBy="usuario", orphanRemoval=true)
     */
    private $movimientos;

    public function __construct()
    {
        $this->apuestas = new ArrayCollection();
        $this->movimientosFinancieros = new ArrayCollection();
        $this->movimientos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Apuesta>
     */
    public function getApuestas(): Collection
    {
        return $this->apuestas;
    }

    public function addApuesta(Apuesta $apuesta): self
    {
        if (!$this->apuestas->contains($apuesta)) {
            $this->apuestas[] = $apuesta;
            $apuesta->setUsuario($this);
        }

        return $this;
    }

    public function removeApuesta(Apuesta $apuesta): self
    {
        if ($this->apuestas->removeElement($apuesta)) {
            // set the owning side to null (unless already changed)
            if ($apuesta->getUsuario() === $this) {
                $apuesta->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MovimientosFinancieros>
     */
    public function getMovimientosFinancieros(): Collection
    {
        return $this->movimientos;
    }

    public function addMovimientosFinanciero(MovimientosFinancieros $movimientos): self
    {
        if (!$this->movimientos->contains($movimientos)) {
            $this->movimientos[] = $movimientos;
            $movimientos->setUsuario($this);
        }

        return $this;
    }

    public function removeMovimientosFinanciero(MovimientosFinancieros $movimientos): self
    {
        if ($this->movimientos->removeElement($movimientos)) {
            // set the owning side to null (unless already changed)
            if ($movimientos->getUsuario() === $this) {
                $movimientos->setUsuario(null);
            }
        }

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->Apellidos;
    }

    public function setApellidos(string $Apellidos): self
    {
        $this->Apellidos = $Apellidos;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->Direccion;
    }

    public function setDireccion(string $Direccion): self
    {
        $this->Direccion = $Direccion;

        return $this;
    }

    public function getLocalidad(): ?string
    {
        return $this->Localidad;
    }

    public function setLocalidad(string $Localidad): self
    {
        $this->Localidad = $Localidad;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEntidad(): ?string
    {
        return $this->entidad;
    }

    public function setEntidad(string $entidad): self
    {
        $this->entidad = $entidad;

        return $this;
    }

    public function getOficina(): ?string
    {
        return $this->oficina;
    }

    public function setOficina(string $oficina): self
    {
        $this->oficina = $oficina;

        return $this;
    }

    public function getDc(): ?string
    {
        return $this->dc;
    }

    public function setDc(string $dc): self
    {
        $this->dc = $dc;

        return $this;
    }

    public function getNumeroCuenta(): ?string
    {
        return $this->numero_cuenta;
    }

    public function setNumeroCuenta(string $numero_cuenta): self
    {
        $this->numero_cuenta = $numero_cuenta;

        return $this;
    }

    /**
     * @return Collection<int, MovimientosFinancieros>
     */
    public function getMovimientos(): Collection
    {
        return $this->movimientos;
    }

    public function addMovimiento(MovimientosFinancieros $movimiento): self
    {
        if (!$this->movimientos->contains($movimiento)) {
            $this->movimientos[] = $movimiento;
            $movimiento->setUsuario($this);
        }

        return $this;
    }

    public function removeMovimiento(MovimientosFinancieros $movimiento): self
    {
        if ($this->movimientos->removeElement($movimiento)) {
            // set the owning side to null (unless already changed)
            if ($movimiento->getUsuario() === $this) {
                $movimiento->setUsuario(null);
            }
        }

        return $this;
    }
    public function getSaldo()
    {
        $saldo=0;
        $movimientos=$this->getMovimientos();
        foreach($movimientos as $movimiento){
            $saldo+=$movimiento->getImporte();
        }

        return $saldo;
    }
    
}
