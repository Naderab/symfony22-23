<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column]
    private ?string $nsc = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $userName = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    private ?Classroom $idClassroom = null;

    #[ORM\Column]
    private ?int $average = null;

    public function getNsc(): ?string
    {
        return $this->nsc;
    }

    public function setNsc(string $nsc): self
    {
        $this->nsc = $nsc;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getIdClassroom(): ?Classroom
    {
        return $this->idClassroom;
    }

    public function setIdClassroom(?Classroom $idClassroom): self
    {
        $this->idClassroom = $idClassroom;

        return $this;
    }

    public function getAverage(): ?int
    {
        return $this->average;
    }

    public function setAverage(int $average): self
    {
        $this->average = $average;

        return $this;
    }
}
