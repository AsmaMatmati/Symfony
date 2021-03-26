<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedecinRepository::class)
 */
class Medecin
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
    private $nomMedecin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomMed;


    /**
     * @ORM\Column(type="integer")
     */
    private $Num_Tel;

    /**
     * @ORM\OneToMany(targetEntity=Ordonnance::class, mappedBy="Medecin")
     */
    private $ordonnances;

    public function __construct()
    {
        $this->ordonnances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMedecin(): ?string
    {
        return $this->nomMedecin;
    }

    public function setNomMedecin(string $nomMedecin): self
    {
        $this->nomMedecin = $nomMedecin;

        return $this;
    }


    public function getPrenomMed(): ?string
    {
        return $this->prenomMed;
    }


    public function setPrenomMed($prenomMed): self
    {
        $this->prenomMed = $prenomMed;
        return $this;
    }


    public function getNumTel(): ?int
    {
        return $this->Num_Tel;
    }

    public function setNumTel($Num_Tel): self
    {
        $this->Num_Tel = $Num_Tel;
        return $this;
    }



    /**
     * @return Collection|Ordonnance[]
     */
    public function getOrdonnances(): Collection
    {
        return $this->ordonnances;
    }

    public function addOrdonnance(Ordonnance $ordonnance): self
    {
        if (!$this->ordonnances->contains($ordonnance)) {
            $this->ordonnances[] = $ordonnance;
            $ordonnance->setMedecin($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->removeElement($ordonnance)) {
            // set the owning side to null (unless already changed)
            if ($ordonnance->getMedecin() === $this) {
                $ordonnance->setMedecin(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        $n=$this->getNomMedecin();
        return $n;
    }


}
