<?php declare(strict_types=1);

namespace Ingesting\Infrastructure\Process;

use Ecotone\Messaging\Config\ConsoleCommandRunner;
use Luzrain\WorkermanBundle\Attribute\AsProcess;

#[AsProcess(name: 'Ecotone worker', processes: 1)]
class EcotoneWorker
{
    public function __construct(
        private readonly ConsoleCommandRunner $ecotoneCommandRunner
    ) {
    }

    public function __invoke(): void
    {
        $this->ecotoneCommandRunner->run([
            'consumerName' => 'spiders',
        ]);
    }
}
