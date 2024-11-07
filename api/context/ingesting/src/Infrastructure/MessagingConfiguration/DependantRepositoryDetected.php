<?php declare(strict_types=1);

namespace Ingesting\Infrastructure\MessagingConfiguration;

final class DependantRepositoryDetected
{
    public function __construct(
        public readonly string $dependantFrom,
        public readonly string $repository,
        public readonly int $stared,
        public readonly int $fork,
    ) {

    }
}
