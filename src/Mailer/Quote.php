<?php

namespace Sveta\Mailer;

use Swift_Mailer;
use Swift_SwiftException;
use Twig\Environment;

class Quote
{
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

    public function configure(array $params): self
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    public function send(): void
    {
        $body = $this->twig->render('email.twig', $this->params);

        $message = $this->mailer->createMessage()
            ->setSubject('Demande de devis sur le site')
            ->setFrom('interpretation@merlet.biz')
            ->setTo('interpretation@merlet.biz')
            ->setBody($body, 'text/html');

        try {
            $this->mailer->send($message);
        } catch (Swift_SwiftException $e) {
            // TODO: log exception message
        }
    }
}
