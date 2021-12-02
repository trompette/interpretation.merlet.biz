<?php

namespace Sveta\Mailer;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class Quote implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $mailer;
    private $twig;
    private $params;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->params = [
            'civility' => '',
            'firstName' => '',
            'lastName' => '',
            'company' => '',
            'phone' => '',
            'email' => '',
            'service' => '',
            'area' => '',
            'languages' => [],
            'details' => '',
        ];
    }

    public function send(array $params): void
    {
        $params = array_merge($this->params, $params);

        $this->logger->info('Sending message Quote()', $params);

        $message = (new Email())
            ->from('interpretation@merlet.biz')
            ->to('interpretation@merlet.biz')
            ->subject('Demande de devis sur le site')
            ->html($this->twig->render('email.twig', $params));

        $this->mailer->send($message);
    }
}
