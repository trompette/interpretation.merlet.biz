<?php

namespace Sveta\Controller;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Sveta\DependencyInjection\TwigAwareTrait;
use Sveta\DependencyInjection\UrlGeneratorAwareTrait;
use Sveta\Mailer\Quote as QuoteMailer;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Quote implements LoggerAwareInterface
{
    use LoggerAwareTrait;
    use TwigAwareTrait;
    use UrlGeneratorAwareTrait;

    public function __invoke(QuoteMailer $quoteMailer, string $language, string $step, Request $request): Response
    {
        $this->logger->info("Executing Quote($language, $step)");

        if ('form' === $step && 'POST' === $request->getMethod()) {
            $quoteMailer->send($request->request->all('form'));

            return new RedirectResponse($this->urlGenerator->generate('quote', ['language' => $language, 'step' => 'requested']));
        }

        return new Response($this->twig->render('template.twig'));
    }
}
