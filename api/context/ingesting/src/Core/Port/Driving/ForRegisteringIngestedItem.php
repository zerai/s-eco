<?php declare(strict_types=1);

namespace Ingesting\Core\Port\Driving;

interface ForRegisteringIngestedItem
{
    public function registerIngestedItem(string $dependantFrom, string $repository, int $starred, int $fork): void;
}
