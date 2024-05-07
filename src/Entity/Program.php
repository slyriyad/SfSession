<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numberOfDAys = null;

    #[ORM\ManyToOne(inversedBy: 'programs')]
    private ?module $module = null;

    #[ORM\ManyToOne(inversedBy: 'programs')]
    private ?session $session = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfDAys(): ?int
    {
        return $this->numberOfDAys;
    }

    public function setNumberOfDAys(int $numberOfDAys): static
    {
        $this->numberOfDAys = $numberOfDAys;

        return $this;
    }

    public function getModule(): ?module
    {
        return $this->module;
    }

    public function setModule(?module $module): static
    {
        $this->module = $module;

        return $this;
    }

    public function getSession(): ?session
    {
        return $this->session;
    }

    public function setSession(?session $session): static
    {
        $this->session = $session;

        return $this;
    }
}
