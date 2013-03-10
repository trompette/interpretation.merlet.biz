<?php

namespace Sveta\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Quote
{
    public function __construct($monolog, $urlGenerator, $twig, $quoteMailer)
    {
        $this->monolog = $monolog;
        $this->urlGenerator = $urlGenerator;
        $this->twig = $twig;
        $this->quoteMailer = $quoteMailer;
    }

    public function execute($language, $step, Request $request)
    {
        $this->monolog->addInfo('Executing Quote()');

        if ('form' === $step && 'POST' === $request->getMethod()) {
            $this->quoteMailer->configure($request->request->get('form'))->send();

            return new RedirectResponse($this->urlGenerator->generate('quote', ['language' => $language, 'step' => 'requested']));
        }

        return $this->twig->render('template.twig');
    }
}
