<?php declare(strict_types=1);

namespace App\Spider\ItemProcessor;

use App\Spider\MessagingConfiguration\DependantRepositoryDetected;
use Ecotone\Modelling\EventBus;
use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use RoachPHP\Support\Configurable;

final class EventPublisherProcessorItemProcessor implements ItemProcessorInterface
{
    use Configurable;

    public function __construct(
        private readonly EventBus $eventBus
    ) {
    }

    public function processItem(ItemInterface $item): ItemInterface
    {
        $this->eventBus->publish(
            new DependantRepositoryDetected(
                (string) $item->get('dependant-from'),
                (string) $item->get('repository'),
                (int) $item->get('starred'),
                (int) $item->get('fork')
            )
        );

        return $item;
    }
}
