<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[Vich\Uploadable]
class Recette implements \Serializable
{   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $titre;

    #[ORM\Column(type: "text")]
    private string $description;

    #[Vich\UploadableField(mapping: "recette_images", fileNameProperty: "imageName")]
    private ?File $imageFile = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(type: "datetime_immutable", nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: "integer")]
    private int $tempsPreparation;

    #[ORM\Column(type: "integer")]
    private int $tempsCuisson;

    #[ORM\Column(type: "integer")]
    private int $portions;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $auteur;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: "likedRecettes")]
    #[ORM\JoinTable(name: "recette_likes")]
    private Collection $likes;

    #[ORM\Column(type: "datetime_immutable")]
    private \DateTimeImmutable $createdAt;

    #[ORM\OneToMany(targetEntity: RecetteIngredient::class, mappedBy: "recette", cascade: ["remove"])]
    private Collection $ingredients;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    // Gestion de l'image avec VichUploader
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if ($imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    // Empêche la sérialisation de `imageFile`
    public function getImageFile(): ?File
    {
        return null;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getTempsPreparation(): int
    {
        return $this->tempsPreparation;
    }

    public function setTempsPreparation(int $tempsPreparation): self
    {
        $this->tempsPreparation = $tempsPreparation;
        return $this;
    }

    public function getTempsCuisson(): int
    {
        return $this->tempsCuisson;
    }

    public function setTempsCuisson(int $tempsCuisson): self
    {
        $this->tempsCuisson = $tempsCuisson;
        return $this;
    }

    public function getPortions(): int
    {
        return $this->portions;
    }

    public function setPortions(int $portions): self
    {
        $this->portions = $portions;
        return $this;
    }

    public function getAuteur(): User
    {
        return $this->auteur;
    }

    public function setAuteur(User $auteur): self
    {
        $this->auteur = $auteur;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(User $user): self
    {
        if (!$this->likes->contains($user)) {
            $this->likes->add($user);
        }
        return $this;
    }

    public function removeLike(User $user): self
    {
        if ($this->likes->contains($user)) {
            $this->likes->removeElement($user);
        }
        return $this;
    }

    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    /**
     * Implémente \Serializable pour éviter l'erreur de sérialisation
     */
    public function serialize(): string
    {
        return serialize([
            $this->id,
            $this->titre,
            $this->description,
            $this->imageName, 
            $this->tempsPreparation,
            $this->tempsCuisson,
            $this->portions,
            $this->createdAt ? $this->createdAt->format('Y-m-d H:i:s') : null, 
        ]);
    }

    public function unserialize(string $serialized): void
    {
        [
            $this->id,
            $this->titre,
            $this->description,
            $this->imageName,
            $this->tempsPreparation,
            $this->tempsCuisson,
            $this->portions,
            $createdAtString, 
        ] = unserialize($serialized, ['allowed_classes' => false]);

        $this->createdAt = $createdAtString ? \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $createdAtString) : null;
    }
}
