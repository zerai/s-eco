<?php declare(strict_types=1);

namespace App\Spider\ItemProcessor;

use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use RoachPHP\Support\Configurable;

final class StarredScoreProcessorItemProcessor implements ItemProcessorInterface
{
    use Configurable;

    public function processItem(ItemInterface $item): ItemInterface
    {
        $minStarredScore = (int) $this->option('min_starred_score');

        if ($minStarredScore >= (int) $item->get('starred', 0)) {
            return $item->drop(
                \sprintf('Fewer than %s starred scored', $this->option('min_starred_score'))
            );
        }

        return $item;
    }

    private function defaultOptions(): array
    {
        return [
            'min_starred_score' => 1,
        ];
    }
}
