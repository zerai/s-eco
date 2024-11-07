<?php declare(strict_types=1);

namespace Ingesting\Infrastructure\MessagingConfiguration;

use Ecotone\Messaging\Attribute\Asynchronous;
use Ecotone\Modelling\Attribute\EventHandler;

class NotificationService
{
    #[Asynchronous("async_ingesting")]
    #[EventHandler(endpointId: "notifyAboutNewDependantRepository")]
    public function notifyAboutNewDependantRepository(DependantRepositoryDetected $event): void
    {
        echo $event->repository . "\n";
    }
}
