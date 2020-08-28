<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteRepository::class)
 *  @ApiResource(
 * normalizationContext={"groups"={"read:read"}},
 * collectionOperations={"get"},
 * itemOperations={"get"})
 * @ApiFilter(SearchFilter::class, properties={"numero": "exact"})
 */
class Compte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cleRib;

    /**
     * @ORM\Column(type="date")
     * @Groups({"read:read"})
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:read"})
     */
    private $numero;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     * @Groups({"read:read"})
     */
    private $solde;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $frais;

    /**
     * @ORM\ManyToOne(targetEntity=TypeCompte::class, inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:read"})
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

    /**
     * @ORM\OneToMany(targetEntity=Operation::class, mappedBy="compte")
     * @Groups({"read:read"})
     */
    private $operations;



    public function __construct()
    {
        $this->etats = new ArrayCollection();
        $this->operations = new ArrayCollection();
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

    /**
     * @return Collection|Operation[]
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation): self
    {
        if (!$this->operations->contains($operation)) {
            $this->operations[] = $operation;
            $operation->setCompte($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operations->contains($operation)) {
            $this->operations->removeElement($operation);
            // set the owning side to null (unless already changed)
            if ($operation->getCompte() === $this) {
                $operation->setCompte(null);
            }
        }

        return $this;
    }



   
 
}
