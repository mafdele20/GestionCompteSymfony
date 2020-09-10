<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\OperationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"read:read"}},
 * collectionOperations={"get"},
 * itemOperations={"get"})
 * @ApiFilter(SearchFilter::class, properties={"compte.numero": "exact"})
 */
class Operation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     *  @Groups({"read:read"})
     */
    private $dateOperation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recu;

    /**
     * @ORM\Column(type="decimal", precision=50, scale=2)
     *  @Groups({"read:read"})
     */
    private $montant;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     *  @Groups({"read:read"})
     */
    private $taxe;

    /**
     * @ORM\ManyToOne(targetEntity=TypeOperation::class, inversedBy="operations")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:read"})
     */
    private $typeOperation;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class, inversedBy="operations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compte;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOperation(): ?\DateTimeInterface
    {
        return $this->dateOperation;
    }

    public function setDateOperation(\DateTimeInterface $dateOperation): self
    {
        $this->dateOperation = $dateOperation;

        return $this;
    }

    public function getRecu(): ?string
    {
        return $this->recu;
    }

    public function setRecu(string $recu): self
    {
        $this->recu = $recu;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getTaxe(): ?string
    {
        return $this->taxe;
    }

    public function setTaxe(string $taxe): self
    {
        $this->taxe = $taxe;

        return $this;
    }

    public function getTypeOperation(): ?TypeOperation
    {
        return $this->typeOperation;
    }

    public function setTypeOperation(?TypeOperation $typeOperation): self
    {
        $this->typeOperation = $typeOperation;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

  
    
}
