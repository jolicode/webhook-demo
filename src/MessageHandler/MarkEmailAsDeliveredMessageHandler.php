<?php

namespace App\MessageHandler;

use App\Message\MarkEmailAsDeliveredMessage;
use App\Repository\TransactionalEmailRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class MarkEmailAsDeliveredMessageHandler implements MessageHandlerInterface
{
    public function __construct(
        public readonly TransactionalEmailRepository $transactionalEmailRepository
    ) {
    }

    public function __invoke(MarkEmailAsDeliveredMessage $message)
    {
        $transactionalEmail = $this->transactionalEmailRepository->findOneBy(['messageIdentifier' => $message->messageId]);
        $transactionalEmail->setDelivered(true);
        $this->transactionalEmailRepository->save($transactionalEmail, true);
    }
}
