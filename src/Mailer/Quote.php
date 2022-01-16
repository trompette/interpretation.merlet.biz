<?php

namespace Sveta\Mailer;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Sveta\DependencyInjection\MailerAwareTrait;
use Sveta\DependencyInjection\TwigAwareTrait;
use Symfony\Component\Mime\Email;

class Quote implements LoggerAwareInterface
{
    use LoggerAwareTrait;
    use MailerAwareTrait;
    use TwigAwareTrait;

    public function send(array $params): void
    {
        $defaults = [
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
        $params = array_merge($defaults, $params);

        $this->logger->info('Sending message Quote()', $params);

        $message = (new Email())
            ->from('interpretation@merlet.biz')
            ->to('interpretation@merlet.biz')
            ->subject('Demande de devis sur le site')
            ->html($this->twig->render('email.twig', $params));

        $this->mailer->send($message);
    }
}
