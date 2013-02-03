<?php

namespace Sveta\Controller;

use Sveta\ApplicationAware;

class Quote extends ApplicationAware
{
    public function execute($language, $step)
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

            $this['mailer']->send($message);

            return $this->redirect($this['url_generator']->generate('quote', array('language' => $language, 'step' => 'requested')));
        }

        $template = sprintf('@%s/quote.twig', $language);

        return $this['twig']->render($template, array('language' => $language));
    }
}
