<?php declare(strict_types=1);

namespace Ingesting\Infrastructure\Spider;

use Exception;
use Ingesting\Infrastructure\Spider\ItemProcessor\EventPublisherProcessorItemProcessor;
use Ingesting\Infrastructure\Spider\ItemProcessor\ForkedScoreProcessorItemProcessor;
use Ingesting\Infrastructure\Spider\ItemProcessor\StarredScoreProcessorItemProcessor;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;
use Symfony\Component\DomCrawler\Crawler;

final class FrameworkBundleSpider extends BasicSpider
{
    public const TARGET_REPOSITORY = 'symfony/framework-bundle';

    /**
     * @var string[]
     */
    public array $startUrls = [
        #'https://github.com/symfony/framework-bundle/network/dependents?dependent_type=REPOSITORY',
        'https://github.com/symfony/framework-bundle/network/dependents?dependent_type=REPOSITORY&dependents_after=NDA0NTc5MDQzMzc',
    ];

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
    ];

    public array $spiderMiddleware = [
    ];

    public array $itemProcessors = [
        [
            StarredScoreProcessorItemProcessor::class, [
                'min_starred_score' => 2,
            ],
        ],
        [
            ForkedScoreProcessorItemProcessor::class, [
                'min_fork_score' => 2,
            ],
        ],
        EventPublisherProcessorItemProcessor::class,
    ];

    public array $extensions = [
        LoggerExtension::class,
        StatsCollectorExtension::class,
    ];

    public int $concurrency = 2;

    public int $requestDelay = 0;

    /**
     * @return \Generator<ParseResult>
     */
    public function parse(Response $response): \Generator
    {
        $items = $response
            ->filter('div.Box > div.Box-row.d-flex.flex-items-center')
            ->each(fn (Crawler $node) => [
                'dependant-from' => self::TARGET_REPOSITORY,
                'repository' => $node->filter('span.f5.color-fg-muted')->text(),
                'starred' => $node->filter('div.d-flex.flex-auto.flex-justify-end span.color-fg-muted.text-bold.pl-3')->first()->text(),
                'fork' => $node->filter('div.d-flex.flex-auto.flex-justify-end span.color-fg-muted.text-bold.pl-3')->last()->text(),
            ]);

        foreach ($items as $item) {
            yield $this->item($item);
        }

        try {
            $nextPageUrl = $response->filter('div.paginate-container')->selectLink('Next')->link()->getUri();
            yield $this->request('GET', $nextPageUrl);
        } catch (Exception) {
        }

    }
}
