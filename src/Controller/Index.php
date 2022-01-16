<?php

namespace Sveta\Controller;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Sveta\DependencyInjection\UrlGeneratorAwareTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Index implements LoggerAwareInterface
{
    use LoggerAwareTrait;
    use UrlGeneratorAwareTrait;

    public function __invoke(string $language): RedirectResponse
    {
        $this->logger->info("Executing Index($language)");

        return new RedirectResponse($this->urlGenerator->generate('home', ['language' => $language]));
    }
}
