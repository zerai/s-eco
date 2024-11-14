<?php declare(strict_types=1);

namespace Ingesting\Core\Port\Driven;

use Ingesting\Core\Model\IngestedItem;

interface ForStoringIngestedItem
{
    public function save(IngestedItem $item): void;
}
