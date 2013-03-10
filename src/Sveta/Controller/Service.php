<?php

namespace Sveta\Controller;

class Service
{
    public function __construct($monolog, $twig)
    {
        $this->monolog = $monolog;
        $this->twig = $twig;
    }

    public function execute($language)
    {
        $this->monolog->addInfo('Executing Service()');

        return $this->twig->render('template.twig');
    }
}
