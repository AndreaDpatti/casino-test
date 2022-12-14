<?php

namespace App\Entity;

use App\Repository\CasinoGameTableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CasinoGameTableRepository::class)]
class CasinoGameTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $icon_2 = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIcon2(): ?string
    {
        return $this->icon_2;
    }

    public function setIcon2(string $icon_2): self
    {
        $this->icon_2 = $icon_2;

        return $this;
    }
}
