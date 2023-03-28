<?php

namespace App\RemoteEvent;

use App\Message\MarkEmailAsDeliveredMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\RemoteEvent\Attribute\AsRemoteEventConsumer;
use Symfony\Component\RemoteEvent\Event\Mailer\MailerDeliveryEvent;

#[AsRemoteEventConsumer(name: 'postmark')]
class PostmarkConsumer
{
    public function __construct(
        public readonly MessageBusInterface $bus
    ) {
    }

    public function consume(MailerDeliveryEvent $event): void
    {
        // We want to return the HTTP response as fast as possible to Postmark, so we use an async handler to process the event
        $this->bus->dispatch(new MarkEmailAsDeliveredMessage($event->getMetadata()['Message-ID']));
    }
}
