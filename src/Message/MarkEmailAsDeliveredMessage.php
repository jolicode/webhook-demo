<?php

namespace App\Message;

final class MarkEmailAsDeliveredMessage
{
    public function __construct(
        public string $messageId,
    ) {
    }
}
