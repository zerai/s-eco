<?php declare(strict_types=1);

namespace App\Spider\MessagingConfiguration;

use Ecotone\Amqp\AmqpBackedMessageChannelBuilder;
use Ecotone\Messaging\Attribute\ServiceContext;

class SpiderMessageChannel
{
    #[ServiceContext]
    public function spidersChannel()
    {
        return AmqpBackedMessageChannelBuilder::create("spiders");
    }
}
