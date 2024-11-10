<?php declare(strict_types=1);

namespace Ingesting\Core\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'ing_ingested_item')]
class IngestedItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $repository = null;

    #[ORM\Column]
    private ?int $starredScore = null;

    #[ORM\Column]
    private ?int $ForkScore = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $registrationDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRepository(): ?string
    {
        return $this->repository;
    }

    public function setRepository(string $repository): static
    {
        $this->repository = $repository;

        return $this;
    }

    public function getStarredScore(): ?int
    {
        return $this->starredScore;
    }

    public function setStarredScore(int $starredScore): static
    {
        $this->starredScore = $starredScore;

        return $this;
    }

    public function getForkScore(): ?int
    {
        return $this->ForkScore;
    }

    public function setForkScore(int $ForkScore): static
    {
        $this->ForkScore = $ForkScore;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeImmutable
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeImmutable $registrationDate): static
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }
}
