<?php

namespace App\Entity;

use App\Repository\FichierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FichierRepository::class)
 */
class Fichier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message=" entrez la description s'il vous plait !!")
     */
    private $description;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="champ obligatoire")
     * @Assert\File(
     *     maxSize = "20M",
     *     mimeTypes = {"image/jpg", "image/png","image/pdf","application/pdf"},
     *     mimeTypesMessage = "Please upload a valid File"
     * )
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity=Dossier::class, inversedBy="fichiers" )
     */
    private $dossier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }

    public function setDossier(?Dossier $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($image): void
    {
        $this->file = $image;
    }

}
