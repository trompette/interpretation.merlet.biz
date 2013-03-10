<?php

namespace Sveta\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;

class Index
{
    public function __construct($monolog, $urlGenerator)
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
