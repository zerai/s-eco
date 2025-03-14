<?php declare(strict_types=1);

namespace Ingesting\AdapterForRegisteringIngestedItem;

use Ecotone\Messaging\Attribute\Asynchronous;
use Ecotone\Modelling\Attribute\EventHandler;
use Ingesting\Core\Port\Driving\ForRegisteringIngestedItem;

class AmqpAdapterForRegisteringIngestedItem
{
    public function __construct(
        private readonly ForRegisteringIngestedItem $ingestionRegistry
    ) {
    }

    #[Asynchronous("async_ingesting")]
    #[EventHandler(endpointId: "registerIngestedItem")]
    public function registerIngestedItemOn(DependantRepositoryDetected $event): void
    {
        $this->ingestionRegistry->registerIngestedItem($event->dependantFrom, $event->repository, $event->stared, $event->fork);
    }
}
