<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'modules')]
    private ?Category $category = null;

    /**
     * @var Collection<int, Program>
     */
    #[ORM\OneToMany(targetEntity: Program::class, mappedBy: 'module')]
    private Collection $programs;

    public function __construct()
    {
        $this->programs = new ArrayCollection();
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): static
    {
        $this->program = $program;

        return $this;
    }

    /**
     * @return Collection<int, program>
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(program $program): static
    {
        if (!$this->programs->contains($program)) {
            $this->programs->add($program);
            $program->setModule($this);
        }

        return $this;
    }

    public function removeProgram(program $program): static
    {
        if ($this->programs->removeElement($program)) {
            // set the owning side to null (unless already changed)
            if ($program->getModule() === $this) {
                $program->setModule(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
