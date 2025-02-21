<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)] 
#[ORM\Table(name: "user")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    private ?string $plainPassword = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $uuid;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\ManyToMany(targetEntity: Recette::class)]
    #[ORM\JoinTable(name: "recette_likes")]    
    private Collection $likedRecettes;

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
        $this->likedRecettes = new ArrayCollection();
    }

    public function getUsername(): string
    {
        return $this->uuid;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->uuid;
    }

    public function getRoles(): array
    {
        return array_unique($this->roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function getLikedRecettes(): Collection
    {
        return $this->likedRecettes;
    }

    public function addLike(Recette $recette): self
    {
        if (!$this->likedRecettes->contains($recette)) {
            $this->likedRecettes->add($recette);
        }
    
        return $this;
    }

    public function removeLike(Recette $recette): self
    {
        if ($this->likedRecettes->contains($recette)) {
            $this->likedRecettes->removeElement($recette);
        }

        return $this;
    }
}
