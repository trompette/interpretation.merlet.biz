<?php

namespace Sveta\Controller;

use Symfony\Component\HttpFoundation\Request;

class Quote extends ApplicationAware
{
    public function execute($language, $step, Request $request)
    {
        $this['monolog']->addInfo('Executing Quote()');

        if ('form' === $step && 'POST' === $request->getMethod()) {
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

            $params = array_merge($defaults, $request->request->get('form'));

            $body = $this['twig']->render('email.twig', $params);

            $message = \Swift_Message::newInstance()
                ->setSubject('Demande de devis sur le site')
                ->setFrom('interpretation@merlet.biz')
                ->setTo('interpretation@merlet.biz')
                ->setBody($body, 'text/html');

            // TODO: catch exception if any
            $this['mailer']->send($message);

            return $this->redirect($this['url_generator']->generate('quote', ['language' => $language, 'step' => 'requested']));
        }

        return $this['twig']->render('template.twig');
    }
}
