<?php

namespace Sveta\Controller;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Sveta\Mailer\Quote as QuoteMailer;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class Quote implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $urlGenerator;
    private $twig;
    private $quoteMailer;

    public function __construct(UrlGeneratorInterface $urlGenerator, Environment $twig, QuoteMailer $quoteMailer)
    {
        $this->urlGenerator = $urlGenerator;
        $this->twig = $twig;
        $this->quoteMailer = $quoteMailer;
    }

    public function execute($language, $step, Request $request)
    {
        $this->logger->info("Executing Quote($language, $step)");

        if ('form' === $step && 'POST' === $request->getMethod()) {
            $this->quoteMailer->configure($request->request->all('form'))->send();

            return new RedirectResponse($this->urlGenerator->generate('quote', ['language' => $language, 'step' => 'requested']));
        }

        return new Response($this->twig->render('template.twig'));
    }
}
