<?php

namespace Sveta\Mailer;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Swift_Mailer;
use Twig\Environment;

class Quote implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $mailer;
    private $twig;
    private $params;

    public function __construct(Swift_Mailer $mailer, Environment $twig)
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

        $body = $this->twig->render('email.twig', $params);
        $message = $this->mailer->createMessage()
            ->setSubject('Demande de devis sur le site')
            ->setFrom('interpretation@merlet.biz')
            ->setTo('interpretation@merlet.biz')
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}
