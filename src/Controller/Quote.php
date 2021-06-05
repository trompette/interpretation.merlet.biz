<?php

namespace Sveta\Controller;

use Psr\Log\LoggerInterface;
use Sveta\Mailer\Quote as QuoteMailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class Quote
{
    public function __construct(LoggerInterface $monolog, UrlGeneratorInterface $urlGenerator, Environment $twig, QuoteMailer $quoteMailer)
    {
        $this->monolog = $monolog;
        $this->urlGenerator = $urlGenerator;
        $this->twig = $twig;
        $this->quoteMailer = $quoteMailer;
    }

    public function execute($language, $step, Request $request)
    {
        $this->monolog->info('Executing Quote()');

        if ('form' === $step && 'POST' === $request->getMethod()) {
            $this->quoteMailer->configure($request->request->all('form'))->send();

            return new RedirectResponse($this->urlGenerator->generate('quote', ['language' => $language, 'step' => 'requested']));
        }

        return new Response($this->twig->render('template.twig'));
    }
}
