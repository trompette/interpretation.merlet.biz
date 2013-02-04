<?php

namespace Sveta\Controller;

use Sveta\ApplicationAware;

class Quote extends ApplicationAware
{
    public function execute($step)
    {
        $this['monolog']->addInfo('Executing Quote()');

        $request = $this['request'];

        if ('form' === $step && 'POST' === $request->getMethod()) {
            $defaults = array(
                'civility'  => '',
                'firstName' => '',
                'lastName'  => '',
                'company'   => '',
                'phone'     => '',
                'email'     => '',
                'service'   => '',
                'area'      => '',
                'languages' => array(),
                'details'   => '',
            );

            $params = array_merge($defaults, $request->request->get('form'));

            $body = $this['twig']->render('email.twig', $params);

            $message = \Swift_Message::newInstance()
                ->setSubject('Demande de devis sur le site')
                ->setFrom('interpretation@merlet.biz')
                ->setTo('interpretation@merlet.biz')
                ->setBody($body, 'text/html');

            // TODO: catch exception if any
            $this['mailer']->send($message);

            return $this->redirect($this['url_generator']->generate('quote', array('language' => $this['language'], 'step' => 'requested')));
        }

        $template = sprintf('@%s/quote.twig', $this['language']);

        return $this['twig']->render($template, array('language' => $this['language']));
    }
}
