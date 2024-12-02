<?php declare(strict_types=1);

namespace Ingesting\Infrastructure\Worker;

use Ingesting\Infrastructure\Spider\FrameworkBundleSpider;
use Luzrain\WorkermanBundle\Attribute\AsProcess;
use RoachPHP\Roach;
use RoachPHP\Spider\Configuration\Overrides;
use Symfony\Contracts\Cache\CacheInterface;

#[AsProcess(name: 'Spider worker', processes: 1)]
class SpiderWorker
{
    public function __construct(
        private readonly CacheInterface $spiderFrameworkBundlePool,
        private readonly bool $moduleIngestingSpiderWorkerEnabled = false,
    ) {
    }

    public function __invoke(): void
    {
        if ($this->moduleIngestingSpiderWorkerEnabled) {
            if ($this->spiderFrameworkBundlePool->hasItem('spider_cursor')) {
                $httpCursor = $this->spiderFrameworkBundlePool->getItem('spider_cursor');

                Roach::startSpider(
                    FrameworkBundleSpider::class,
                    new Overrides(startUrls: [$httpCursor->get()]),
                );
            } else {
                Roach::startSpider(FrameworkBundleSpider::class);
            }
        } else {
            sleep(60);
        }
    }
}
