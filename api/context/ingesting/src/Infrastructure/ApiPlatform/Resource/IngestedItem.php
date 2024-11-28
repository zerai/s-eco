<?php declare(strict_types=1);

namespace Ingesting\Infrastructure\ApiPlatform\Resource;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Ingesting\Core\Model\IngestedItem as IngestedItemEntity;

#[ApiResource(
    shortName: 'Item',
    operations: [
        new Get(),
        new GetCollection(),
    ],
    routePrefix: '/ingesting',
    provider: CollectionProvider::class,
    stateOptions: new Options(entityClass: IngestedItemEntity::class)
)]
class IngestedItem
{
    private ?int $id = null;

    private ?string $dependantFrom = null;

    private ?string $repository = null;

    #[ApiFilter(OrderFilter::class)]
    private ?int $starredScore = null;

    private ?int $forkScore = null;

    #[ApiFilter(OrderFilter::class)]
    private ?\DateTimeImmutable $registrationDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDependantFrom(): ?string
    {
        return $this->dependantFrom;
    }

    public function setDependantFrom(?string $dependantFrom): static
    {
        $this->dependantFrom = $dependantFrom;

        return $this;
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
        return $this->forkScore;
    }

    public function setForkScore(int $forkScore): static
    {
        $this->forkScore = $forkScore;

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
