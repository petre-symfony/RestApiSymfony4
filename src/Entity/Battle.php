<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BattleRepository")
 */
class Battle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Programmer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $programmer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\Column(type="datetime")
     */
    private $foughtAt;

    /**
     * @ORM\Column(type="text")
     */
    private $notes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgrammer(): ?Programmer
    {
        return $this->programmer;
    }

    public function setProgrammer(?Programmer $programmer): self
    {
        $this->programmer = $programmer;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getFoughtAt(): ?\DateTimeInterface
    {
        return $this->foughtAt;
    }

    public function setFoughtAt(\DateTimeInterface $foughtAt): self
    {
        $this->foughtAt = $foughtAt;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }
}
