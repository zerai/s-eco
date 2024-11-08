<?php declare(strict_types=1);

namespace Ingesting\Infrastructure\Spider\Middleware;

use RoachPHP\Downloader\Middleware\RequestMiddlewareInterface;
use RoachPHP\Http\Request;
use RoachPHP\Support\Configurable;
use Symfony\Contracts\Cache\CacheInterface;

class RequestCursorMiddleware implements RequestMiddlewareInterface
{
    use Configurable;

    public function __construct(
        private readonly CacheInterface $spiderFrameworkBundlePool
    ) {
    }

    public function handleRequest(Request $request): Request
    {
        $httpCursor = $this->spiderFrameworkBundlePool->getItem('spider_cursor');
        $httpCursor->set($request->getUri());
        $this->spiderFrameworkBundlePool->save($httpCursor);

        return $request;
    }
}
