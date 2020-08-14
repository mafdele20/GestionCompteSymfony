<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatRepository::class)
 */
class Etat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Compte::class, mappedBy="etats")
     */
    private $Etat;

    public function __construct()
    {
        $this->Etat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getEtat(): Collection
    {
        return $this->Etat;
    }

    public function addEtat(Compte $etat): self
    {
        if (!$this->Etat->contains($etat)) {
            $this->Etat[] = $etat;
            $etat->addEtat($this);
        }

        return $this;
    }

    public function removeEtat(Compte $etat): self
    {
        if ($this->Etat->contains($etat)) {
            $this->Etat->removeElement($etat);
            $etat->removeEtat($this);
        }

        return $this;
    }
}
