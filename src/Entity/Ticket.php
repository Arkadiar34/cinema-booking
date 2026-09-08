<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroSiege = null;

    #[ORM\Column(length: 255,unique:true)]
    private ?string $codeTicket = null;

    #[ORM\Column(length: 255)]
    private ?string $typeTarif = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column]
    private ?bool $estUtilise = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?reservation $reservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroSiege(): ?string
    {
        return $this->numeroSiege;
    }

    public function setNumeroSiege(string $numeroSiege): static
    {
        $this->numeroSiege = $numeroSiege;

        return $this;
    }

    public function getCodeTicket(): ?string
    {
        return $this->codeTicket;
    }

    public function setCodeTicket(string $codeTicket): static
    {
        $this->codeTicket = $codeTicket;

        return $this;
    }

    public function getTypeTarif(): ?string
    {
        return $this->typeTarif;
    }

    public function setTypeTarif(string $typeTarif): static
    {
        $this->typeTarif = $typeTarif;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTime $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function isEstUtilise(): ?bool
    {
        return $this->estUtilise;
    }

    public function setEstUtilise(bool $estUtilise): static
    {
        $this->estUtilise = $estUtilise;

        return $this;
    }

    public function getReservation(): ?reservation
    {
        return $this->reservation;
    }

    public function setReservation(?reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }
}
