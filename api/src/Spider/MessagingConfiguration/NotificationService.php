<?php declare(strict_types=1);

namespace App\Spider\MessagingConfiguration;

use Ecotone\Messaging\Attribute\Asynchronous;
use Ecotone\Modelling\Attribute\EventHandler;

class NotificationService
{
    #[Asynchronous("spiders")]
    #[EventHandler(endpointId: "notifyAboutNeworder")]
    public function notifyAboutNewOrder(DependantRepositoryDetected $event): void
    {
        echo $event->repository . "\n";
    }
}
