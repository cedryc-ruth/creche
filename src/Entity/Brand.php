<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
#[ORM\Table("brands")]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    /**
     * @var Collection<int, Toy>
     */
    #[ORM\OneToMany(targetEntity: Toy::class, mappedBy: 'brand')]
    private Collection $toys;

    public function __construct()
    {
        $this->toys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Toy>
     */
    public function getToys(): Collection
    {
        return $this->toys;
    }

    public function addToy(Toy $toy): static
    {
        if (!$this->toys->contains($toy)) {
            $this->toys->add($toy);
            $toy->setBrand($this);
        }

        return $this;
    }

    public function removeToy(Toy $toy): static
    {
        if ($this->toys->removeElement($toy)) {
            // set the owning side to null (unless already changed)
            if ($toy->getBrand() === $this) {
                $toy->setBrand(null);
            }
        }

        return $this;
    }
}
