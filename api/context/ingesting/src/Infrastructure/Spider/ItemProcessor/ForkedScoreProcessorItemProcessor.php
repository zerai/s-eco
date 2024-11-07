<?php declare(strict_types=1);

namespace Ingesting\Infrastructure\Spider\ItemProcessor;

use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use RoachPHP\Support\Configurable;

final class ForkedScoreProcessorItemProcessor implements ItemProcessorInterface
{
    use Configurable;

    public function processItem(ItemInterface $item): ItemInterface
    {
        $minForkScore = (int) $this->option('min_fork_score');
        if ($minForkScore >= (int) $item->get('fork', 0)) {
            return $item->drop(
                \sprintf('Fewer than %s fork scored', $this->option('min_fork_score'))
            );
        }

        return $item;
    }

    private function defaultOptions(): array
    {
        return [
            'min_fork_score' => 1,
        ];
    }
}
