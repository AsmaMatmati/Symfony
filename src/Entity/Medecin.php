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




    public function __toString()
    {
        $n=$this->getNomMedecin();
        return $n;
    }


}
