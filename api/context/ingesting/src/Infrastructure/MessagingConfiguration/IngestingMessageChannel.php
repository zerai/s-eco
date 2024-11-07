<?php declare(strict_types=1);

namespace Ingesting\Infrastructure\MessagingConfiguration;

use Ecotone\Amqp\AmqpBackedMessageChannelBuilder;
use Ecotone\Messaging\Attribute\ServiceContext;

class IngestingMessageChannel
{
    #[ServiceContext]
    public function spidersChannel()
    {
        return AmqpBackedMessageChannelBuilder::create("async_ingesting");
    }
}
