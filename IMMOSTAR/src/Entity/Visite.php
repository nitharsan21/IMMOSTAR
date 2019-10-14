<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bien", inversedBy="visites")
     */
    private $Bien;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visiteur", inversedBy="visites")
     */
    private $Visiteur;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $suite;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBien(): ?Bien
    {
        return $this->Bien;
    }

    public function setBien(?Bien $Bien): self
    {
        $this->Bien = $Bien;

        return $this;
    }

    public function getVisiteur(): ?Visiteur
    {
        return $this->Visiteur;
    }

    public function setVisiteur(?Visiteur $Visiteur): self
    {
        $this->Visiteur = $Visiteur;

        return $this;
    }

    public function getSuite(): ?string
    {
        return $this->suite;
    }

    public function setSuite(string $suite): self
    {
        $this->suite = $suite;

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
}
