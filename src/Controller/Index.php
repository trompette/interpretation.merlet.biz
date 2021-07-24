<?php

namespace Sveta\Controller;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Index implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function execute(string $language): RedirectResponse
    {
        $this->logger->info("Executing Index($language)");

        return new RedirectResponse($this->urlGenerator->generate('home', ['language' => $language]));
    }
}
