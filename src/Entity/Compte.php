<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteRepository::class)
 */
class Compte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cleRib;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $solde;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $frais;

    /**
     * @ORM\ManyToOne(targetEntity=TypeCompte::class, inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeCompte;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $proprietaire;

    /**
     * @ORM\ManyToMany(targetEntity=Etat::class, inversedBy="Etat")
     */
    private $etats;

    public function __construct()
    {
        $this->etats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCleRib(): ?string
    {
        return $this->cleRib;
    }

    public function setCleRib(string $cleRib): self
    {
        $this->cleRib = $cleRib;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getFrais(): ?string
    {
        return $this->frais;
    }

    public function setFrais(string $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function getTypeCompte(): ?TypeCompte
    {
        return $this->typeCompte;
    }

    public function setTypeCompte(?TypeCompte $typeCompte): self
    {
        $this->typeCompte = $typeCompte;

        return $this;
    }

    public function getProprietaire(): ?Client
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Client $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    /**
     * @return Collection|Etat[]
     */
    public function getEtats(): Collection
    {
        return $this->etats;
    }

    public function addEtat(Etat $etat): self
    {
        if (!$this->etats->contains($etat)) {
            $this->etats[] = $etat;
        }

        return $this;
    }

    public function removeEtat(Etat $etat): self
    {
        if ($this->etats->contains($etat)) {
            $this->etats->removeElement($etat);
        }

        return $this;
    }
}
