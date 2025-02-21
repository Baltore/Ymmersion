<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "recette_ingredient")]
class RecetteIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Recette::class, inversedBy: "ingredients")]
    #[ORM\JoinColumn(nullable: false)]
    private Recette $recette;

    #[ORM\ManyToOne(targetEntity: Ingredient::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Ingredient $ingredient;

    #[ORM\Column(type: "float")]
    private float $quantite;

    #[ORM\Column(type: "string", length: 50, nullable: true)]
    private ?string $unite = null;

    // Getters & Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecette(): Recette
    {
        return $this->recette;
    }

    public function setRecette(Recette $recette): self
    {
        $this->recette = $recette;
        return $this;
    }

    public function getIngredient(): Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;
        return $this;
    }

    public function getQuantite(): float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;
        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(?string $unite): self
    {
        $this->unite = $unite;
        return $this;
    }
}
