<?php

namespace App\Entity;

use App\Repository\OrdonnanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OrdonnanceRepository::class)
 */
class Ordonnance
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
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Medicament::class, inversedBy="ordonnances")
     */
    private $Medicament;

    public function __construct()
    {
        $this->Medicament = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getMedicament()
    {
        return $this->Medicament;
    }
    /**
     * @param mixed $medicament
     */
    public function setMedicament($medicament)
    {
        //if (!$this->Medicament->contains($medicament)) {
            $this->Medicament= $medicament;
        //}

        return $this;
    }

    /*public function removeMedicament(Medicament $medicament): self
    {
        $this->Medicament->removeElement($medicament);

        return $this;
    }*/
}
