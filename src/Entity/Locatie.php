<?php

namespace App\Entity;

use App\Repository\LocatieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocatieRepository::class)
 */
class Locatie
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
    private $Adres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Stad;

    /**
     * @ORM\ManyToOne(targetEntity=Lokaal::class, inversedBy="Locatie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Locatie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdres(): ?string
    {
        return $this->Adres;
    }

    public function setAdres(string $Adres): self
    {
        $this->Adres = $Adres;

        return $this;
    }

    public function getStad(): ?string
    {
        return $this->Stad;
    }

    public function setStad(string $Stad): self
    {
        $this->Stad = $Stad;

        return $this;
    }

    public function getLocatie(): ?Lokaal
    {
        return $this->Locatie;
    }

    public function setLocatie(?Lokaal $Locatie): self
    {
        $this->Locatie = $Locatie;

        return $this;
    }
}
