<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BienRepository")
 */
class Bien
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_piece;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_chambre;

    /**
     * @ORM\Column(type="integer")
     */
    private $superficie;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $chauffage;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $localisation;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="biens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visite", mappedBy="Bien")
     */
    private $visites;

    public function __construct()
    {
        $this->visites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPiece(): ?int
    {
        return $this->nb_piece;
    }

    public function setNbPiece(int $nb_piece): self
    {
        $this->nb_piece = $nb_piece;

        return $this;
    }

    public function getNbChambre(): ?int
    {
        return $this->nb_chambre;
    }

    public function setNbChambre(int $nb_chambre): self
    {
        $this->nb_chambre = $nb_chambre;

        return $this;
    }

    public function getSuperficie(): ?int
    {
        return $this->superficie;
    }

    public function setSuperficie(int $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getChauffage(): ?string
    {
        return $this->chauffage;
    }

    public function setChauffage(string $chauffage): self
    {
        $this->chauffage = $chauffage;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Visite[]
     */
    public function getVisites(): Collection
    {
        return $this->visites;
    }

    public function addVisite(Visite $visite): self
    {
        if (!$this->visites->contains($visite)) {
            $this->visites[] = $visite;
            $visite->setBien($this);
        }

        return $this;
    }

    public function removeVisite(Visite $visite): self
    {
        if ($this->visites->contains($visite)) {
            $this->visites->removeElement($visite);
            // set the owning side to null (unless already changed)
            if ($visite->getBien() === $this) {
                $visite->setBien(null);
            }
        }

        return $this;
    }
}
