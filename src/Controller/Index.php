<?php

namespace Sveta\Controller;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Index implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function execute($language)
    {
        $this->logger->info("Executing Index($language)");

        return new RedirectResponse($this->urlGenerator->generate('home', ['language' => $language]));
    }
}
