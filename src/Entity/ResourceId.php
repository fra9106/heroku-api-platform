<?php 

declare(strict_types=1);

namespace App\Entity;

trait ResourceId 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"phones-list:read", "phone:read", "users-list:read", "user:read", "shops-list:read", "shop:read" })
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

}