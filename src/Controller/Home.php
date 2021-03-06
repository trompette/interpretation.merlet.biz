<?php

namespace Sveta\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class Home
{
    public function __construct(LoggerInterface $monolog, Environment $twig)
    {
        $this->monolog = $monolog;
        $this->twig = $twig;
    }

    public function execute($language)
    {
        $this->monolog->info('Executing Home()');

        return new Response($this->twig->render('template.twig'));
    }
}
