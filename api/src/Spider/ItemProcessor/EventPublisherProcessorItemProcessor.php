<?php declare(strict_types=1);

namespace App\Spider\ItemProcessor;

use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use RoachPHP\Support\Configurable;

final class EventPublisherProcessorItemProcessor implements ItemProcessorInterface
{
    use Configurable;

    public function processItem(ItemInterface $item): ItemInterface
    {

        return $item;
    }
}
