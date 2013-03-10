<?php

namespace Sveta\Mailer;

class Quote
{
    public function __construct($mailer, $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function send($params)
    {
        $defaults = [
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

        $params = array_merge($defaults, $params);

        $body = $this->twig->render('email.twig', $params);

        $message = \Swift_Message::newInstance()
            ->setSubject('Demande de devis sur le site')
            ->setFrom('interpretation@merlet.biz')
            ->setTo('interpretation@merlet.biz')
            ->setBody($body, 'text/html');

        // TODO: catch exception if any
        $this->mailer->send($message);
    }
}
