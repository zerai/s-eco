<?php declare(strict_types=1);

namespace App\Process;

use App\Spider\FrameworkBundleSpider;
use Luzrain\WorkermanBundle\Attribute\AsProcess;
use RoachPHP\Roach;

#[AsProcess(name: 'Spider worker', processes: 1)]
class SpiderWorker
{
    public function __invoke(): void
    {
        Roach::startSpider(FrameworkBundleSpider::class);
    }
}
