<?php

namespace App\Entity;

use App\Repository\LokaalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LokaalRepository::class)
 */
class Lokaal
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $TotaalToegestanePersonen;

    /**
     * @ORM\OneToMany(targetEntity=Locatie::class, mappedBy="Locatie")
     */
    private $Locatie;

    public function __construct()
    {
        $this->Locatie = new ArrayCollection();
    }

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

    public function getTotaalToegestanePersonen(): ?string
    {
        return $this->TotaalToegestanePersonen;
    }

    public function setTotaalToegestanePersonen(?string $TotaalToegestanePersonen): self
    {
        $this->TotaalToegestanePersonen = $TotaalToegestanePersonen;

        return $this;
    }

    /**
     * @return Collection|Locatie[]
     */
    public function getLocatie(): Collection
    {
        return $this->Locatie;
    }

    public function addLocatie(Locatie $locatie): self
    {
        if (!$this->Locatie->contains($locatie)) {
            $this->Locatie[] = $locatie;
            $locatie->setLocatie($this);
        }

        return $this;
    }

    public function removeLocatie(Locatie $locatie): self
    {
        if ($this->Locatie->removeElement($locatie)) {
            // set the owning side to null (unless already changed)
            if ($locatie->getLocatie() === $this) {
                $locatie->setLocatie(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getStad() . ' - ' . $this->getAdres();
    }
}
