<?php

namespace Sveta\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Index
{
    public function __construct(LoggerInterface $monolog, UrlGeneratorInterface $urlGenerator)
    {
        $this->monolog = $monolog;
        $this->urlGenerator = $urlGenerator;
    }

    public function execute($language)
    {
        $this->monolog->addInfo('Executing Index()');

        return new RedirectResponse($this->urlGenerator->generate('home', ['language' => $language]));
    }
}
