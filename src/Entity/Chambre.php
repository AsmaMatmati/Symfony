<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id

     * @Assert\NotBlank
         * @ORM\Column(type="integer")
     */
    private $num;

    /**

     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $numetage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nbrplace;

    /**
     * @ORM\Column(type="string", length=255)
     *   @Assert\Length(min=3,max=255,minMessage="le nom du service est trop court")
     */
    private $service;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bloc;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="chambres" )
     */
    private $category;


    public function getNum(): ?int
    {
        return $this->num;
    }

    public function getNumEtage(): ?string
    {
        return $this->numetage;
    }
    public function setNum(string $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function setNumEtage(string $numetage): self
    {
        $this->numetage = $numetage;

        return $this;
    }

    public function getNbrplace(): ?int
    {
        return $this->nbrplace;
    }

    public function setNbrplace(int $nbrplace): self
    {
        $this->nbrplace = $nbrplace;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }
    public function getBloc(): ?string
    {
        return $this->bloc;
    }
    public function setBloc(string $bloc): self
    {
        $this->bloc = $bloc;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function getCat(): ?string
    {
        return (string) $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
