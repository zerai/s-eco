<?php declare(strict_types=1);

namespace Ingesting\Infrastructure\MessagingConfiguration;

use Ecotone\Messaging\Attribute\Asynchronous;
use Ecotone\Modelling\Attribute\EventHandler;
use Ingesting\Core\Port\Driving\ForRegisteringIngestedItem;

class NotificationService
{
    public function __construct(
        private readonly ForRegisteringIngestedItem $ingestionRegistry
    ) {
    }

    #[Asynchronous("async_ingesting")]
    #[EventHandler(endpointId: "notifyAboutNewDependantRepository")]
    public function notifyAboutNewDependantRepository(DependantRepositoryDetected $event): void
    {
        echo $event->repository . "\n";
    }

    #[Asynchronous("async_ingesting")]
    #[EventHandler(endpointId: "registerIngestedItem")]
    public function registerIngestedItemOn(DependantRepositoryDetected $event): void
    {
        $this->ingestionRegistry->registerIngestedItem($event->dependantFrom, $event->repository, $event->stared, $event->fork);
    }
}
