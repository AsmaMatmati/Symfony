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
     * @Assert\NotBlank (message="la description est obligatoire")
     * @ORM\Column(type="string", length=255)
     */
    private $description;


    /**
     * @Assert\NotBlank (message="nbr_jrs est obligatoire")
     * @ORM\Column(type="integer")
     */
    private $nbr_jrs;


    /**
     * @Assert\NotBlank (message="nbr_doses est obligatoire")
     * @ORM\Column(type="float")
     */
    private $nbr_doses;

    /**
     * @Assert\NotBlank (message="nbr_fois est obligatoire")
     * @ORM\Column(type="integer")
     */
    private $nbr_fois;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_paquets;


    /**
     * @ORM\ManyToOne(targetEntity=Medicament::class, inversedBy="ordonnace")
     */
    private $medicaments;

    /**
     * @ORM\ManyToOne(targetEntity=Consultation::class, inversedBy="ordonnances")
     */
    private $Consultation;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="ordonnances")
     */
    private $Patient;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="ordonnances")
     */
    private $Users;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="ordonnances")
     */
    private $Categorie;




    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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


    public function getMedicaments()
    {
        return $this->medicaments;
    }

    /**
     * @param mixed $medicaments
     */
    public function setMedicaments($medicaments)
    {
        $this->medicaments = $medicaments;
        return $this;
    }


    public function getConsultation(): ?Consultation
    {
        return $this->Consultation;
    }

    public function setConsultation(?Consultation $Consultation): self
    {
        $this->Consultation = $Consultation;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->Patient;
    }

    public function setPatient(?Patient $Patient): self
    {
        $this->Patient = $Patient;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getNbrJrs()
    {
        return $this->nbr_jrs;
    }

    /**
     * @param mixed $nbr_jrs
     */
    public function setNbrJrs($nbr_jrs): void
    {
        $this->nbr_jrs = $nbr_jrs;
    }

    /**
     * @return mixed
     */
    public function getNbrPaquets()
    {
        return $this->nbr_paquets;
    }

    /**
     * @param mixed $nbr_paquets
     */
    public function setNbrPaquets($nbr_paquets): void
    {
        $this->nbr_paquets = $nbr_paquets;
    }

    /**
     * @return mixed
     */
    public function getNbrDoses()
    {
        return $this->nbr_doses;
    }

    /**
     * @param mixed $nbr_doses
     */
    public function setNbrDoses($nbr_doses): void
    {
        $this->nbr_doses = $nbr_doses;
    }

    /**
     * @return mixed
     */
    public function getNbrFois()
    {
        return $this->nbr_fois;
    }

    /**
     * @param mixed $nbr_fois
     */
    public function setNbrFois($nbr_fois): void
    {
        $this->nbr_fois = $nbr_fois;
    }

    public function getUsers(): ?Users
    {
        return $this->Users;
    }

    public function setUsers(?Users $Users): self
    {
        $this->Users = $Users;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }


}
