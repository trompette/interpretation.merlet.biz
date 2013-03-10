<?php

namespace Sveta\Controller;

class Experience
{
    public function __construct($monolog, $twig)
    {
        $this->monolog = $monolog;
        $this->twig = $twig;
    }

    public function execute($language)
    {
        $this->monolog->addInfo('Executing Experience()');

        return $this->twig->render('template.twig');
    }
}
