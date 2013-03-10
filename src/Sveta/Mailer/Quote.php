<?php

namespace Sveta\Mailer;

use Swift_SwiftException;

class Quote
{
    public function __construct($mailer, $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;

        $this->params = [
            'civility'  => '',
            'firstName' => '',
            'lastName'  => '',
            'company'   => '',
            'phone'     => '',
            'email'     => '',
            'service'   => '',
            'area'      => '',
            'languages' => [],
            'details'   => '',
        ];
    }

    public function configure($params)
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    public function send()
    {
        $body = $this->twig->render('email.twig', $this->params);

        $message = \Swift_Message::newInstance()
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
