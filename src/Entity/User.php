<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email", message="email déjà utilisé !")
 * @ApiResource(
 *      paginationItemsPerPage=5,
 *      collectionOperations={
 *         "get"={
 *             "normalization_context"={"groups"={"users-list:read"}}
 *         },
 *         "post"
 *     },
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={"groups"={"user:read"}}
 *         },
 *         "delete"={
 *             "security"="(is_granted('ROLE_ADMIN') or object.getShop() == user)",
 *             "security_message"="Vous n'êtes pas autorisé à supprimer cet utilisateur!"
 *          },
 *     },
 * )
 */
class User
{

    use ResourceId;

    /**
     * @ORM\Column(type="string", length=180)
     * @Groups({"user:read", "shop:read", "shop:read"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users-list:read", "user:read","shop:read" }) 
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users-list:read", "user:read", "shop:read"}) 
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"user:read"})
     */
    private $postal_code;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"user:read"}) 
     */
    private $city;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"user:read"})
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="users", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user:read"})
     */
    private $shop;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): self
    {
        $this->shop = $shop;

        return $this;
    }
}
