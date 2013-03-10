<?php

namespace Sveta\Controller;

class Home
{
    public function __construct($monolog, $twig)
    {
        $this->monolog = $monolog;
        $this->twig = $twig;
    }

    public function execute($language)
    {
        $this->monolog->addInfo('Executing Home()');

        return $this->twig->render('template.twig');
    }
}
