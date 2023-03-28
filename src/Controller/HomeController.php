<?php

namespace App\Controller;

use App\Entity\TransactionalEmail;
use App\Repository\TransactionalEmailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Header\MetadataHeader;
use Symfony\Component\Mailer\Header\TagHeader;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Header\Headers;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, MailerInterface $mailer, TransactionalEmailRepository $transactionalEmailRepository): Response
    {
        if ($request->request->has('email')) {
            $emailAddress = $request->request->get('email');

            $email = (new Email())
                ->from('postmark-test@welcomattic.com')
                ->to($emailAddress)
                ->subject($subject = 'Time for Symfony Mailer!')
                ->text($content = 'Sending emails is fun again!')
                ->html('<p>See Twig integration for better HTML integration!</p>');

            $email->getHeaders()
                    ->add(new MetadataHeader('Message-ID', $messageIdentifier = md5('welcome-email-' . $emailAddress)));

            $mailer->send($email);

            $transactionalEmail = (new TransactionalEmail())
                ->setSubject($subject)
                ->setContent($content)
                ->setSentAt(new \DateTimeImmutable('now'))
                ->setMessageIdentifier($messageIdentifier)
            ;
            $transactionalEmailRepository->save($transactionalEmail, true);
        }

        return $this->render('home/index.html.twig');
    }
}
