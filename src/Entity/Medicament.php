<?php

namespace App\Entity;

use App\Repository\MedicamentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MedicamentRepository::class)
 */
class Medicament
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le code est obligatoire")
     * @Assert\Length(min="4",minMessage="message from annotation: field must be at least 4")
     * @Assert\Length (max="10", maxMessage="max Length 10")
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @Assert\NotBlank(message="Le nom est obligatoire")
     * @Assert\Length(min="4", minMessage="le nom est trop court")
     * @Assert\Length (max="50",maxMessage="le nom est trés long")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank(message="Le prix est obligatoire")
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @Assert\NotBlank(message="La stock est obligatoire")
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\OneToMany(targetEntity="Ordonnance", mappedBy="medicaments")
     */
   private $ordonnaces;

   /**
    * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="medicaments")
    */
   private $Categorie;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrdonnaces()
    {
        return $this->ordonnaces;
    }

    /**
     * @param mixed $ordonnaces
     */
    public function setOrdonnaces($ordonnaces): void
    {
        $this->ordonnaces = $ordonnaces;
    }

    public function addProduct(Ordonnance $ordonnance): self
    {
        if (!$this->ordonnaces->contains($ordonnance)) {
            $this->ordonnaces[] = $ordonnance;
            $ordonnance->setMedicaments($this);
        }

        return $this;
    }



    /*public function removeProduct(Ordonnance $ordonnance): self
    {
        if ($this->ordonnaces->contains($ordonnace)) {
            $this->ordonnaces->removeElement($ordonnace);
            // set the owning side to null (unless already changed)
            if ($ordonnace->getMedicament() === $this) {
                $ordonnace->setMedicament(null);
            }
        }

        return $this;
    }

*/

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
