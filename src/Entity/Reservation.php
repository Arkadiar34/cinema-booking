<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\SeanceDisponible;

#[SeanceDisponible]
#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $numeroReservation = null;

    #[ORM\Column]
    private ?\DateTime $dateReservation = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $montantTotal = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: 'La séance est obligatoire')]
    private ?seance $seance = null;

    /**
     * @var Collection<int, Ticket>
     */
    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'reservation')]
    private Collection $tickets;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: 'Le film est obligatoire')]
    private ?Film $film = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Le nombre de places est obligatoire')]
    #[Assert\Positive(message: 'Le nombre de places doit être positif')]
    #[Assert\Range(
        min: 1,
        max: 10,
        notInRangeMessage: 'Vous devez réserver entre {{ min }} et {{ max }} places'
    )]
    private ?int $nbPlaces = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email(message: 'L\'adresse email {{ value }} n\'est pas valide')]
    private ?string $emailClient = null;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroReservation(): ?string
    {
        return $this->numeroReservation;
    }

    public function setNumeroReservation(string $numeroReservation): static
    {
        $this->numeroReservation = $numeroReservation;

        return $this;
    }

    public function getDateReservation(): ?\DateTime
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTime $dateReservation): static
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getMontantTotal(): ?string
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(string $montantTotal): static
    {
        $this->montantTotal = $montantTotal;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getUtilisateur(): ?utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getSeance(): ?seance
    {
        return $this->seance;
    }

    public function setSeance(?seance $seance): static
    {
        $this->seance = $seance;

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): static
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets->add($ticket);
            $ticket->setReservation($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getReservation() === $this) {
                $ticket->setReservation(null);
            }
        }

        return $this;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): static
    {
        $this->film = $film;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): static
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->emailClient;
    }

    public function setEmailClient(string $emailClient): static
    {
        $this->emailClient = $emailClient;

        return $this;
    }
}
